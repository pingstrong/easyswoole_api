<?php
namespace App\Exceptions;

use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Http\Message\Status;

/**
 * 默认异常处理器
 */
class ExceptionHandler
{
    public static function handle( \Throwable $exception, Request $request, Response $response )
    {
        $debug = config('app.debug');
         
        $response->withStatus(Status::CODE_INTERNAL_SERVER_ERROR);
        if($debug){
            $response->write(nl2br($exception->getMessage()."\n".$exception->getTraceAsString()));
        }else{
            $response->write('System Error...' . $exception->getMessage());
        }

        // echo "====================================\n";
        // var_dump($exception->getTraceAsString());
    }
}