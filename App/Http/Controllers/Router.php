<?php
namespace App\Http\Controllers;

use EasySwoole\Http\AbstractInterface\AbstractRouter;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\template\Render;
use FastRoute\RouteCollector;
use App\Service\Admin\AdminRuleService;
use EasySwoole\Utility\File;

class Router extends AbstractRouter
{
    
     
    public function initialize(RouteCollector $FastRoute)
    {
        
        $this->setPathInfoMode(false);
        //$this->setGlobalMode(true);
        // 未找到路由对应的方法
        $this->setMethodNotAllowCallBack(function (Request $request, Response $response) {
            var_dump('未找到路由对应的方法-----------');
            var_dump($request->getUri()->getPath());
            $response->write(Render::getInstance()->render('default.404'));
            $response->withStatus(404);
            return false; //结束此次响应
        });

        // 未找到路由匹配
        $this->setRouterNotFoundCallBack(function (Request $request, Response $response) {
            var_dump('未找到路由匹配+++++++++++');
            var_dump($request->getUri()->getPath());
            $response->write(Render::getInstance()->render('default.404'));
            $response->withStatus(404);
            
            return false; //结束此次响应
        });
        
        //添加前端路由表
        $files = File::scanDirectory(EASYSWOOLE_ROOT . '/App/Routes');
        if (is_array($files)) {
            foreach ($files['files'] as $file) {
                $fileNameArr = explode('.', $file);
                $fileSuffix = end($fileNameArr);
                if ($fileSuffix == 'php') {
                    require_once $file;
                }
            }
        }

    }
      

}
