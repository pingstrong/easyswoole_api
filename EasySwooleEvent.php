<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;

use App\Crontab\TaskOne;
use EasySwoole\ORM\DbManager;
use EasySwoole\ORM\Db\Connection;
use EasySwoole\ORM\Db\Config as DbConfig;

use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;

use EasySwoole\Utility\File;
use EasySwoole\EasySwoole\Config;

use App\Process\HotReload;

use App\Utility\Pool\MysqlPool;
use EasySwoole\Component\Pool\PoolManager;

use App\Utility\Template\Blade;
use EasySwoole\Template\Render;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\Component\Di;
use EasySwoole\Redis\Config\RedisConfig;
use EasySwoole\RedisPool\Redis;

use App\Exceptions\ExceptionHandler;
use App\Http\Middleware\GlobalMiddleware;
use EasySwoole\EasySwoole\Crontab\Crontab;
use EasySwoole\Socket\Dispatcher;
use App\WebSocket\WebSocketParser;
use App\WebSocket\WebSocketEvents;
use EasySwoole\Component\TableManager;
use Swoole\Table;

/**
 * 框架全局事件
 *
 * @author pingo
 * @created_at 00-00-00
 */
class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        // 加载配置项
        self::loadConf();
        //数据库连接配置
        $database_conf = config('database');
        $DbConfig = new DbConfig();
        $DbConfig->setDatabase($database_conf['database']);
        $DbConfig->setUser($database_conf['user']);
        $DbConfig->setPassword($database_conf['password']);
        $DbConfig->setHost($database_conf['host']);
        //数据库连接池配置
        $DbConfig->setGetObjectTimeout($database_conf['pool_getobj_timeout']); //设置获取连接池对象超时时间
        $DbConfig->setIntervalCheckTime($database_conf['pool_checktime']); //设置检测连接存活执行回收和创建的周期
        $DbConfig->setMaxIdleTime($database_conf['pool_idletime']); //连接池对象最大闲置时间(秒)
        $DbConfig->setMaxObjectNum($database_conf['pool_obj_maxnum']); //设置最大连接池存在连接对象数量
        $DbConfig->setMinObjectNum($database_conf['pool_obj_minnum']); //设置最小连接池存在连接对象数量
        $DbConfig->setAutoPing($database_conf['pool_auto_ping']); //设置自动ping客户端链接的间隔
        
        DbManager::getInstance()->addConnection(new Connection($DbConfig));
        //redis连接池注册
        $redis_conf = config("redis");
        $redisPoolConfig = Redis::getInstance()
        ->register(
            'redis',
            new RedisConfig([
                'host'      => $redis_conf['host'],
                'port'      => $redis_conf['port'],
                'auth'      => $redis_conf['password'],
                'serialize' => RedisConfig::SERIALIZE_NONE
        ]));
        //配置连接池连接数
        $redisPoolConfig->setMinObjectNum($redis_conf['pool_minnum']);
        $redisPoolConfig->setMaxObjectNum($redis_conf['pool_maxnum']);
        $redisPoolConfig->setAutoPing($redis_conf['auto_ping']);//设置自动ping的间隔 版本需>=2.1.2
        //Di::getInstance()->set(SysConst::ERROR_HANDLER,function (){}); // 配置错误处理回调
        //Di::getInstance()->set(SysConst::SHUTDOWN_FUNCTION,function (){}); // 配置脚本结束回调
        Di::getInstance()->set(SysConst::HTTP_CONTROLLER_NAMESPACE, 'App\\Http\\Controllers\\');// 配置控制器命名空间
        Di::getInstance()->set(SysConst::HTTP_CONTROLLER_MAX_DEPTH, 6); // 配置http控制器最大解析层级
        Di::getInstance()->set(SysConst::HTTP_EXCEPTION_HANDLER, [ExceptionHandler::class, 'handle']); // 配置http控制器异常回调
        //Di::getInstance()->set(SysConst::HTTP_CONTROLLER_POOL_MAX_NUM,15); // http控制器对象池最大数量
        //全局请求拦截
        Di::getInstance()->set(SysConst::HTTP_GLOBAL_ON_REQUEST, [GlobalMiddleware::class, 'onRequest']);
        //全局请求完成执行方法
        Di::getInstance()->set(SysConst::HTTP_GLOBAL_AFTER_REQUEST, [GlobalMiddleware::class, 'afterRequest']);
        
        //添加语言包
        self::loadLang();

    }

    

    public static function mainServerCreate(EventRegister $register)
    {
        self::loadConfig();
        self::initSwooleTable();
        self::initProcess();
        self::initTask();
        self::initCrontab();
        self::initTimer();
        self::initEvent();
        // template
        $viewDir = EASYSWOOLE_ROOT . '/App/Views';
        $cacheDir = EASYSWOOLE_ROOT . '/Temp/Template';
        Render::getInstance()->getConfig()->setRender(new Blade($viewDir,$cacheDir));
        Render::getInstance()->attachServer(ServerManager::getInstance()->getSwooleServer());
        /**
         * **************** websocket控制器 **********************
         */
        // 创建一个 Dispatcher 配置
        $SocketConf = new \EasySwoole\Socket\Config();
        // 设置 Dispatcher 为 WebSocket 模式
        $SocketConf->setType(\EasySwoole\Socket\Config::WEB_SOCKET);
        // 设置解析器对象
        $SocketConf->setParser(new WebSocketParser());
        // 创建 Dispatcher 对象 并注入 config 对象
        $dispatch = new Dispatcher($SocketConf);
        // 给server 注册相关事件 在 WebSocket 模式下  on message 事件必须注册 并且交给 Dispatcher 对象处理
        $register->set(EventRegister::onMessage, function (\swoole_websocket_server $server, \swoole_websocket_frame $frame) use ($dispatch) {
            $dispatch->dispatch($server, $frame->data, $frame);
        });
        // 注册服务事件
        $register->add(EventRegister::onOpen, [WebSocketEvents::class, 'onOpen']);
        $register->add(EventRegister::onClose, [WebSocketEvents::class, 'onClose']);
        

    }

    
    public static function onRequest(Request $request, Response $response): bool
    {
         
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
         
        // TODO: Implement afterAction() method.
    }

    public static function loadLang()
    {
        $files = File::scanDirectory(EASYSWOOLE_ROOT . '/App/Lang');
        if (is_array($files)) {
            $lang_data = [];
            foreach ($files['files'] as $file) {
                $fileNameArr = explode('.', $file);
                $fileSuffix = end($fileNameArr);
                if ($fileSuffix == 'php') {
                    $pathinfo = pathinfo($file);
                    $lang_data[$pathinfo['filename']] = require_once $file;
                }
            }
            Config::getInstance()->setConf(\App\Consts::SYSTEM_LANG, $lang_data);
        }
    }


    public static function loadConf()
    {
        $files = File::scanDirectory(EASYSWOOLE_ROOT . '/App/Config');
        if (is_array($files)) {
            foreach ($files['files'] as $file) {
                $fileNameArr = explode('.', $file);
                $fileSuffix = end($fileNameArr);
                if ($fileSuffix == 'php') {
                    $pathinfo = pathinfo($file);
                    $data = require_once $file;
                    Config::getInstance()->setConf($pathinfo['filename'], $data);
                } elseif ($fileSuffix == 'env') {
                    Config::getInstance()->loadEnv($file);
                }
            }
        }
    }

    /**
     * 加载自定义配置文件
     */
    public static function loadConfig()
    {
        /* $instance = \EasySwoole\EasySwoole\Config::getInstance();
        foreach (glob(EASYSWOOLE_ROOT.DIRECTORY_SEPARATOR.'Config/*.php') as $filePath){
            $instance->setConf(rtrim(basename($filePath),'.php'),require_once $filePath);
        } */
    }

    /**
     * 加载内存表
     */
    public static function initSwooleTable()
    {
        /* //记录流对应进程号 key=stream_key
        TableManager::getInstance()->add('stream', ['php_pid'=>['type'=>Table::TYPE_INT,'size'=>11],], 1024);
        //记录流下客户端(实现自动结束流) key=stream_key
        TableManager::getInstance()->add('watch', ['rows'=>['type'=>Table::TYPE_STRING,'size'=>4096]], 1024);
        //记录客户端对应流(实现自动结束流) key=client_id
        TableManager::getInstance()->add('client', ['stream_key'=>['type'=>Table::TYPE_STRING,'size'=>32]], 1024); */
    }

    /**
     * 初始化自定义进程
     */
    public static function initProcess()
    {
        //dump(getmypid());
        /**srs进程**/
        //ServerManager::getInstance()->addProcess(new SrsProcess(),'srs');
        /**ffmpeg进程**/
        //$processConfig = new \EasySwoole\Component\Process\Config();
        //$processConfig->setProcessName('ffmpeg');
        //$processConfig->setPipeType(SOCK_STREAM);//DGRAM出现丢包,问题仅存在于internet网络的UDP通信
        //$processConfig->setEnableCoroutine(true);
        //ServerManager::getInstance()->addProcess(new FFmpegProcess($processConfig),'ffmpeg');
        // 热更新（仅供开发环境使用，正式环境请勿开启造成逻辑异常）
        $hot_reload = (new HotReload('HotReload', ['disableInotify' => false]))->getProcess();
        ServerManager::getInstance()->getSwooleServer()->addProcess($hot_reload);
        //自定义进程
        //$testProcess = (new \App\Process\TestProcess('TestProcess'))->getProcess();
        //ServerManager::getInstance()->getSwooleServer()->addProcess($testProcess);

    }
    /**
     * 初始化任务
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public  static function initTask()
    {
        //定时任务计划
        //Crontab::getInstance()->addTask(TaskOne::class);
    }
    /**
     * 初始化定时计划
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public static function initCrontab()
    {

    }
    /**
     * 初始化事件注册
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public static function initEvent()
    {

    }
    /**
     * 初始化定时器
     */
    public static function initTimer()
    {

    }



}