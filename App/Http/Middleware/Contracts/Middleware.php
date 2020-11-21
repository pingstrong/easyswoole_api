<?php
/**
 *  
 * @author pingo <pingstrong@163.com>
 * 
 */
namespace App\Http\Middleware\Contracts;

use App\Utility\Message\ApiFormat;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use Closure;

abstract class Middleware
{
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        
    }
    /**
     * 执行方法
     *
     * @author pingo
     * @created_at 00-00-00
     * @param [type] $request swoole 请求对象
     * @param [type] $response swoole 响应对象
     * @param Closure $next
     * @return void
     */
    public abstract function handle(): bool;
    

    protected function responseGP($redirect_uri = '/', $code = 0, $msg = 'ok', $data = [])
    {
        $server_params  = $this->request->getServerParams();
        
        switch($server_params['request_method'])
        {
            case 'GET':
                $this->response->redirect($redirect_uri);
                break;
            case 'POST':
                $res =  ApiFormat::api($code, $msg, $data);
                $this->response->write(json_encode($res, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
                $this->response->withHeader('Content-type', 'application/json;charset=utf-8');
                break;
            default:

                break;
        }
        
    }
}