<?php

namespace App\Http\Controllers\Admin;

use App\Service\Admin\Auth\AdminLogService;
use App\Http\Controllers\BaseController;
use App\Service\Admin\Auth\AdminRuleService;
use easySwoole\Cache\Cache;
use App\Utility\Message\Status;
use EasySwoole\Template\Render;
use App\Common\AppFunc;

/**
 * 后台控制器基类
 */
class AdminController extends BaseController
{
	protected $auth;   // 保存了登录用户的信息
	protected $jwt_data = [];
	protected $middleware = [
		\App\Http\Middleware\AdminMiddleware::class,
		\App\Http\Middleware\LogMiddleware::class,
	];
	//当前账号授权请求权限
	protected $account_rule_nodes = []; 
	/**
	 * 架构方法
	 *
	 * @author pingo
	 * @created_at 00-00-00
	 * @return void
	 */
	 public function initialize()
	 {
		$this->account_rule_nodes = $this->request()->account_rule_nodes;
		$this->jwt_data = $this->auth = $this->request()->jwt_data;
		if(isset($this->request_header['content-type'])){
			//application/x-www-form-urlencoded	 
			//multipart/form-data 
			//text/xml
			//application/json application/octet-stream
			//兼容payload方式请求
			
			$payload_type = 'application/json';
			foreach($this->request_header['content-type'] as $type){
				if(FALSE !== strpos($type, $payload_type)){
					$request_raw = json_decode($this->request_raw, true) ?? [];
					$this->request_post = array_merge($this->request_post, $request_raw);
					$this->request_params = array_merge($this->request_params, $request_raw);  
				}
			}
			
		}
	 }
	 /**
	  * 获取请求参数
	  *
	  * @author pingo
	  * @created_at 00-00-00
	  * @param [type] $keys
	  * @return void
	  */
	 protected function getRequestParams($keys = null)
	 {
			if(is_null($keys)) return $this->request_params;
			if(is_string($keys)){
				if(isset($this->request_params[$keys])){
					return $this->request_params[$keys];
				}
				return null;
			}
			//array
			$data = [];
			foreach($keys as $param){
				if(array_key_exists($param, $this->request_params)){
					$data[$param] = $this->request_params[$param];
				}
			}
			return $data;
	 }
	/**
	 * 渲染数据
	 *
	 * @author pingo
	 * @created_at 00-00-00
	 * @param string $template
	 * @param array $data
	 * @return void
	 */
	public function render(string $template, array $data = [])
    {
		 
    	$data = array_merge(['account_rule_nodes' => $this->account_rule_nodes, 'is_super' => $this->jwt_data['is_super']], $data);
        $this->response()->write(Render::getInstance()->render($template, $data));
    }

	// 操作记录
	protected function Record()
	{
		$data = [
			'url'  => $this->request()->getUri()->getPath(),
			'data' => json_encode($this->request()->getRequestParam()),
			'uid'  => $this->auth['id']
		];
		AdminLogService::getInstance()->add($data);
		return true;
	}
	/**
	 * 检查权限
	 *
	 * @author pingo
	 * @created_at 00-00-00
	 * @param [type] $rule
	 * @return boolean
	 */
	public function hasRule($rule)
	{
		if(!in_array($rule, $this->account_rule_nodes) ){
			$this->responseGP('/backdata/403', Status::CODE_RULE_ERR, '权限不足');
			return false;
		}
		return true;
	}
 
	public function dataJson($data)
	{
        if (!$this->response()->isEndResponse()) {
            $this->response()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            return true;
        } else {
            return false;
        }
	}

	// 获取 page limit 信息
	public function getPage()
	{
		$request = $this->request();
		$data = $request->getRequestParam('page','limit');
		$data['page'] =  $data['page']?:1;
		$data['limit'] =  $data['limit']?:10;
		return $data;
	}

	//方法不存在报错 404页面
    protected function actionNotFound(?string $action)
    {
        $this->response()->withStatus(404);
        // $file = EASYSWOOLE_ROOT.'/vendor/easyswoole/easyswoole/src/Resource/Http/404.html';
        // if(!is_file($file)){
        //     $file = EASYSWOOLE_ROOT.'/src/Resource/Http/404.html';
        // }
        // $this->response()->write(file_get_contents($file));
        
        $this->response()->write('404 not found');
	}
	

}