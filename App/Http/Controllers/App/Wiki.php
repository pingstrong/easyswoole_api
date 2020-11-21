<?php
namespace App\Http\Controllers\App;

use App\Http\Controllers\BaseController;
use App\Utility\Message\Status;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\EasySwoole\Task\TaskManager;
use EasySwoole\Component\Context\ContextManager;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

class Wiki extends BaseController
{

    public function version()
    {
         
       /*  $task = TaskManager::getInstance();
        $task->async(function (){
            \Swoole\Coroutine::sleep(3);
            echo "异步调用task1\n";
        });
        $data =  $task->sync(function (){
            echo "同步调用task1\n";
            return "可以返回调用结果\n";
        });
        Logger::getInstance()->console('console bbbbsdfasdfasd',Logger::LOG_LEVEL_INFO,'DEBUG');//记录info级别日志并输出到控制台
        Logger::getInstance()->error('log level error');//记录error级别日志并输出到控制台
        $author = 'pingo';
        go(function () use(&$author){
            ContextManager::getInstance()->set('key','key in parent');
            var_dump($author."22222222");
            $author = "rango";
            go(function () use(&$author){
                ContextManager::getInstance()->set('key','key in sub');
                var_dump(ContextManager::getInstance()->get('key')." in");
                var_dump($author."11111");
                \co::sleep(3);
                $author = "beego";
            });
            $author = "springcloud";
            \co::sleep(2);
            var_dump($author."3333333333");
            var_dump(ContextManager::getInstance()->get('key')." out");
        }); */
        //$data = (new \App\Model\Admin\AdminUser())->all();
        /* $QueryBuilder = new QueryBuilder();
        $QueryBuilder->raw("SELECT * FROM `admin_user` where `uname` = ? and `status` = ?", ['admin', 1]);
        $data = DbManager::getInstance()->query($QueryBuilder, true); */
        $data = \App\Model\Admin\AdminUser::create()->func(function(QueryBuilder $builder){
            $builder->raw("SELECT * FROM `admin_user` where `uname` = ? and `status` = ?", ['admin', 1]);
            return true;
        });
         
        $this->writeApi(Status::CODE_OK, "6.0.29", $data);
    
    }
}
