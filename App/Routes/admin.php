<?php
/**
 *  后台路由表
 * 
 * 请使用 Fast-route $FastRoute对象操作
 * 
 *  例子
 *   $FastRoute->addRoute('GET', '/api/v1/user/getinfo', '/Api/V1/User/getinfo')
 *   $FastRoute->addRoute('POST', '/api/v1/goods/detail-{id:\d+}', '/Api/V1/Goods/detail')
 *   $FastRoute->addRoute("GET", '/api/hello', function($request, $response){
 *        $response->write("hello world");
 *    });
 * 
 *   $FastRoute->addGroup('/api', function(RouteCollector $r){
 *      $r->addRoute('GET', '/do-something', 'handler');
 *      $r->addRoute('PUT', '/do-something', 'handler');
 *      $r->addRoute('HEAD', '/do-something', 'handler');
 *   })
 * 
 * @author pingo
 * @created_at 00-00-00
 */
use FastRoute\RouteCollector;
use App\Service\Admin\Auth\AdminRuleService;
use EasySwoole\EasySwoole\ServerManager;

//常规路由
$FastRoute->addGroup('/backdata', function (RouteCollector $route) {
    $route->get('/', '/Admin/Index');
    $route->get('/main', '/Admin/Index');
    $route->get('/index_context', '/Admin/Index/indexContext');
    $route->get('/login', '/Admin/Access');
    $route->get('/logout', '/Admin/Access/logout');
    $route->post('/login', '/Admin/Access/login');
    $route->get('/verify', '/Admin/Access/verify');
    $route->post('/login_log', '/Admin/Index/loginLog');
    $route->get('/version', '/Admin/Index/version');
    $route->get('/console', '/Admin/Index/console');
    $route->get('/dashboard', '/Admin/Index/dashboard');
    $route->get('/clearCache', '/Admin/Index/clearCache');
    $route->get('/initMenu', '/Admin/Index/initMenu');
    $route->get('/{id:\d+}', '/Admin/Index/defaultPage');
    
});

//获取后台路由配置
$rule_data =  AdminRuleService::getInstance()->getAllList();
foreach($rule_data as $rule){
    if(!empty($rule['route_uri']) && !empty($rule['route_handler'])){
        $route_uri_data = explode("&&", $rule['route_uri']);
        $route_handler_data = explode("&&", $rule['route_handler']);
        foreach ($route_uri_data as $key => $route_uri) {
            # code...
            $route_handler = $route_handler_data[$key]?? $route_handler_data[0];
            $FastRoute->addRoute('GET', trimall($route_uri), trimall($route_handler));
            $FastRoute->addRoute('POST', trimall($route_uri), trimall($route_handler));
        }
        
    }
}
 