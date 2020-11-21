<?php
namespace App\WebSocket\Controller;

use App\Utility\Message\ApiFormat;
use App\Utility\Message\Status;
use EasySwoole\Socket\AbstractInterface\Controller;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Swoole\Task\TaskManager;
use EasySwoole\FastCache\Cache;

/**
 * 基类
 *
 * @author pingo
 * @created_at 00-00-00
 */
class Base extends Controller
{
    //当前用户连接句柄ID
    protected  $fd = null;
    //原始数据
    protected $raw_params = [];
    //当前请求参数
    protected  $params = [];
    //swoole_server对象
    protected $swoole_server = null;   
    //reactorId
    protected $reactor_id = null;
    /**
     * 发消息
     *
     * @author pingo
     * @created_at 00-00-00
     * @param [type] $code
     * @param [type] $msg
     * @param array $data
     * @return void
     */
    public function  send(int $code, string $msg, $data = [])
    {
        $result = ApiFormat::webSocket($code, $msg, $data);
        $this->response()->setMessage(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
    /**
     * 方法不存在执行
     *
     * @author pingo
     * @created_at 00-00-00
     * @param string|null $actionName
     * @return void
     */
    protected function actionNotFound(?string $actionName)
    {
        $this->send(Status::CODE_ERR, "方法不存在！", $this->params);
    }
    /**
     * 后执行
     *
     * @author pingo
     * @created_at 00-00-00
     * @param string|null $actionName
     * @return void
     */
    protected function afterAction(?string $actionName)
    {
        
    }
    /**
     * 请求路由URI出错
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function uriNotFound()
    {
        $this->send(Status::CODE_ERR, "请求URI出错！！！", $this->params);
    }
    /*
     * 返回false的时候为拦截
     */
    protected function onRequest(?string $actionName):bool
    {
        $this->params        = $this->caller()->getArgs();
        $this->swoole_server = ServerManager::getInstance()->getSwooleServer();
        $this->fd            = $this->caller()->getClient()->getFd();
        $this->reactor_id    = $this->caller()->getClient()->getReactorId();
        $this->raw_params    = $this->caller()->getClient()->getData();
        
        return true;
    }


}