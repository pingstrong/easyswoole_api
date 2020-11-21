<?php
namespace App\Http\Middleware;

use App\Http\Middleware\Contracts\Middleware;
use Closure;
use EasySwoole\RedisPool\Redis;

/**
 *  全局请求中间件拦截
 *
 * @author pingo
 * @created_at 00-00-00
 */
class GlobalMiddleware
{
    /**
     * 执行入口
     *
     * @author pingo
     * @created_at 00-00-00
     * @param [type] $request
     * @param [type] $response
     * @param Closure $next
     * @return bool 返回false 终止整个请求
     */
    public static function onRequest($request, $response)
    {
        //return $next($request);
        /* $RedisPool = Redis::getInstance()->get("redis");
        $Redis = $RedisPool->getObj();
        $Redis->set("xx", 'xxxxxbbb');
        $RedisPool->recycleObj($Redis); */
        return true;
    }
    /**
     * 请求处理最后执行方法
     *
     * @author pingo
     * @created_at 00-00-00
     * @param [type] $request
     * @param [type] $response
     * @return void
     */
    public static function afterRequest($request, $response)
    {
         
    }

}
