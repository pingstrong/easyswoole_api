<?php
namespace App\Http\Middleware\Handler;

use App\Http\Middleware\Contracts\Middleware;
use Closure;

/**
 * 中间件调度器
 *
 * @author pingo
 * @created_at 00-00-00
 */
class CallHandler
{
     
    /**
     * 批量处理中间件
     *
     * @author pingo
     * @created_at 00-00-00
     * @param array $middlewares
     * @param [type] $request
     * @param [type] $response
     * @return boolean
     */
    public function run(array $middlewares, $request, $response): bool
    {
        foreach (array_reverse($middlewares) as $key => $middleware) {
            # code...
            if(class_exists($middleware)){
                $is_pass = (new $middleware($request, $response))->handle();
                if(false === $is_pass) return false;
            }
        }
        return true;
    }
}