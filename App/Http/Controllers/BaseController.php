<?php

namespace App\Http\Controllers;

use App\Utility\Message\ApiFormat;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Template\Render;
use App\Utility\Message\Status;
use EasySwoole\EasySwoole\ServerManager;
/**
 * 基类
 *
 * @author pingo
 * @created_at 00-00-00
 */
abstract class BaseController extends Controller
{
    //中间件
    protected $middleware = [];
    //不需要验证中间件的方法
    protected $except = [];
    //仅需验证中间件的方法
    protected $only = [];
    //swoole原始http请求对象
    protected  $swoole_http_request = null;
    //当前请求参数 get+post
    protected $request_params = [];
    //当前请求Server信息
    protected $request_server = [];
    //当前请求头
    protected $request_header = [];
    //当前请求cookie
    protected $request_cookie = [];
    //请求原始数据体
    protected $request_raw = [];
    //请求Get参数
    protected $request_get = [];
    //请求post 参数
    protected $request_post = [];
    //swoole_server
    protected $swoole_server;
    protected $swoole_http_response;
    /**
     * 初始化控制器
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function initialize()
    {

    }

    public function index()
    {
        $this->actionNotFound('index');
    }

    public function render(string $template, array $data = [])
    {
        $this->response()->write(Render::getInstance()->render($template, $data));
    }

    public function show404()
    {
        $this->render('default.404');
    }

    public function writeJson($statusCode = 0, $msg = '', $data = [])
    {
        if (!$this->response()->isEndResponse()) {

            $result = ApiFormat::api($statusCode, $msg, $data);
            $this->response()->write(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            return true;
        } else {
            return false;
        }
    }
    /**
     * 处理GET/POST响应内容
     *
     * @param string $redirect_uri
     * @param integer $code
     * @param string $msg
     * @param array $data
     * @return void
     */
    public function responseGP($redirect_uri = '/', $code = 0, $msg = 'success', $data = [])
    {
        $server_params  = $this->request()->getServerParams();
        
        switch($server_params['request_method'])
        {
            case 'GET':
                $this->response()->redirect($redirect_uri);
                break;
            case 'POST':
                $this->writeJson($code, $msg, $data);
                break;
            default:

                break;
        }
        
    }
    /**
     *  返回统一的api接口数据
     *
     * @param integer $statusCode 200 201 | 301 302 | 400 401 403 | 502 505
     * @param string $msg 执行结果信息
     * @param array $data 执行结果数据
     * @param integer $error_code 错误代码 0 无错误，400 Bad Request 401 Unauthorized 403 Forbidden 404 Not Found
     * @param string $error_msg 错误信息
     * @return void
     */
    public function writeApi(int $statusCode = 200, string $msg = null, array $data = [], int $error_code = 0, string $error_msg = 'just pass')
    {
        if (!$this->response()->isEndResponse()) {
            $result = ApiFormat::apiFull($statusCode, $msg, $data, $error_code, $error_msg);
            $this->response()->write(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            return true;
        } else {
            return false;
        }
    }
    /**
     * 输出业务处理数据
     *
     * @param array $service_data
     * @return void
     */
    protected function writeServiceResult(array $service_data)
    {
        $code = $service_data['flag'] ? Status::CODE_OK : Status::CODE_ERR;
        $this->writeJson($code, $service_data['msg'], $service_data['data']);
    }
    /**
     * 生成token
     *
     * @param [type] $id
     * @param [type] $time
     * @return void
     */
    protected function makeToken($id, $time)
    {
        return md5($id . config("app.token") . $time);
    }
     /**
      * 当请求方法未找到时,自动调用该方法,可自行覆盖该方法实现自己的逻辑
      *
      * @author pingo
      * @created_at 00-00-00
      * @param string|null $action
      * @return void
      */
    protected function actionNotFound(?string $action)
    {
        
        $this->response()->withStatus(404);
        // $file = EASYSWOOLE_ROOT.'/vendor/easyswoole/easyswoole/src/Resource/Http/404.html';
        // if(!is_file($file)){
        //     $file = EASYSWOOLE_ROOT.'/src/Resource/Http/404.html';
        // }
        // $this->response()->write(file_get_contents($file));
        $data = ['action' => $action];
        $this->writeJson(Status::CODE_ERR, "请求方法出错actionNotFound！！！", $data);
        //$this->response()->write('404 not found');
    }
    
    protected function onRequest(?string $action): ?bool
	{
        //初始化参数
        $this->swoole_http_request  = $this->request()->getSwooleRequest();
        $this->request_params       = $this->request()->getRequestParam();
        $this->request_server       = $this->request()->getServerParams();
        $this->request_header       = $this->request()->getHeaders();
        $this->request_cookie       = $this->request()->getCookieParams();
        $this->request_raw          = $this->request()->getBody()->__toString();
        $this->request_get          = $this->request()->getQueryParams();
        $this->request_post         = $this->request()->getParsedBody();
        $this->swoole_server = ServerManager::getInstance()->getSwooleServer();
        $this->swoole_http_response = $this->response()->getSwooleResponse();
        //调用中间件、
        if(empty($this->middleware) || in_array($action, $this->except) || (!empty($this->only) && !in_array($action, $this->only))){
            $this->initialize();
            return true;
        };

        $request = $this->request();
        $response = $this->response();
        $result = ( new \App\Http\Middleware\Handler\CallHandler)->run($this->middleware, $request, $response);
        if($result){
            $this->initialize();
            return true;
        }
         
        return false;
    }
    /**
     * 当控制器方法执行结束之后将调用该方法,可自定义数据回收等逻辑
     *
     * @author pingo
     * @created_at 00-00-00
     * @param string|null $actionName
     * @return void
     */
    protected function afterAction(?string $actionName): void
    {
         
    }
    /**
     * 当控制器逻辑抛出异常时将调用该方法进行处理异常(框架默认已经处理了异常)
     *   可覆盖该方法,进行自定义的异常处理覆盖系统默认异常处理器
     *
     * @author pingo
     * @created_at 00-00-00
     * @param \Throwable $throwable
     * @return void
     */
    protected function onException(\Throwable $throwable): void
    {
        //直接给前端响应500并输出系统繁忙
        $this->writeJson(Status::CODE_ERR, '系统繁忙,请稍后再试 onException!!!'. $throwable->getMessage());
        //$this->response()->withStatus(404);
        //$this->response()->write('系统繁忙,请稍后再试 onException!!!');
    }
    /**
     * 控制器的afterAction 处理后执行，资源回收等
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    protected function gc()
    {
         
    }   


}
