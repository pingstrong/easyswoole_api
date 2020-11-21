<?php
/**
 *  App路由表
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

$FastRoute->addGroup('/app/', function(RouteCollector $route){
    $route->get('wiki/version', '/App/Wiki/version');
});