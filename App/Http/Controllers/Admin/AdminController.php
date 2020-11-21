<?php

namespace App\Http\Controllers\Admin;

use App\Service\Admin\AdminLogService;
use App\Http\Controllers\BaseController;
use easySwoole\Cache\Cache;
use App\Utility\Message\Status;
use EasySwoole\Template\Render;
use App\Utility\Log\Log;
use EasySwoole\Jwt\Jwt;

/**
 * 后台控制器基类
 */
class AdminController extends BaseController
{
	protected $auth;   // 保存了登录用户的信息
	protected $role_group;
	protected $jwt_data = [];
	protected $middleware = [
		\App\Http\Middleware\AdminMiddleware::class,
		\App\Http\Middleware\LogMiddleware::class,
	];

	 public function initialize()
	 {
		 $jwt_data = $this->jwt_data = $this->request()->jwt_data;
		 // 如果 用户组类 被删除的话则使用,则使用 根用户组(RoleGroup)
		 try {
			$role_group = 'RoleGroup' . $jwt_data['role_id'];
			$class ="\\App\\Utility\\RoleGroup\\{$role_group}";
			$this->role_group = new $class($jwt_data['role_id']);
		} catch (\Exception $e) {
			// 如果没有存在的 组类 则又可能有问题
			Log::getInstance()->error("admin--checkToken:" . json_encode(['id'=>$jwt_data['id']], JSON_UNESCAPED_UNICODE) . "检查到 对应角色组类不存在");
			$this->responseGP("/backdata/login", Status::CODE_RULE_ERR, '请登录在操作！');
			return false;
		}
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
		//var_dump($template, $data);
    	$data = array_merge(['role_group' => $this->role_group], $data);
        $this->response()->write(Render::getInstance()->render($template, $data));
    }

	// 检查token 是否合法
	private function checkToken()
	{
		$r = $this->request();
		$client_token = $r->getCookieParams('token');
		 
		try{
			$JwtObject = Jwt::getInstance()
			->setSecretKey(config("app.jwt.secret_key")) // 秘钥
			->decode($client_token);
		}catch(\Throwable $e){
			$this->responseGP("/backdata/login", Status::CODE_RULE_ERR, '请登录在操作！');
			return false;
		}
		
		$status = $JwtObject->getStatus();
		switch ($status) {
			case 1:
				# 验证通过
				$this->auth = $jwt_data = $JwtObject->getData();
				// 如果 用户组类 被删除的话则使用,则使用 根用户组(RoleGroup)
				try {
					$role_group = 'RoleGroup' . $jwt_data['role_id'];
					$class ="\\App\\Utility\\RoleGroup\\{$role_group}";
					$this->role_group = new $class($jwt_data['role_id']);
				} catch (\Exception $e) {
					// 如果没有存在的 组类 则又可能有问题
					Log::getInstance()->error("admin--checkToken:" . json_encode(['id'=>$jwt_data['id']], JSON_UNESCAPED_UNICODE) . "检查到 对应角色组类不存在");
					$this->responseGP("/backdata/login", Status::CODE_RULE_ERR, '请登录在操作！');
				}
				return true;
				break;
			/* case -1:
				//无效
				break;
			case -2:
				//token过期
				break; */
			default:
				# code...
				$this->responseGP("/backdata/login", Status::CODE_RULE_ERR, '请登录在操作！');
				return false;
				break;
		}
		 
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

	// get 请求是否有权限访问
	public function  hasRuleForGet($rule)
	{
		if(!$this->role_group->hasRule($rule)) {
			$this->show404();
			return false;
		}

		return true;
	}

	// post 请求是否有权限访问
	public function  hasRuleForPost($rule)
	{
		if(!$this->role_group->hasRule($rule)) {
			$this->writeJson(Status::CODE_RULE_ERR,'权限不足');
			return false;
		}
		return true;
	}


	/* public function onRequest(?string $action): ?bool
	{
		//调用中间件、
		return $this->checkToken() && $this->Record();
	}
 */
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