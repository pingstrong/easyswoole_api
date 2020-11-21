<?php
namespace App\Http\Middleware;

use App\Http\Middleware\Contracts\Middleware;
use Closure;

/**
 * 日记中间件
 *
 * @author pingo
 * @created_at 00-00-00
 */
class LogMiddleware extends Middleware
{
    /**
     * 执行入口
     *
     * @author pingo
     * @created_at 00-00-00
     * @param [type] $request
     * @param [type] $response
     * @param Closure $next
     * @return void
     */
    public function handle(): bool
    {
        //return $next($request);
         
        return true;
    }
}
