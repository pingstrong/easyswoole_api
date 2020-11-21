<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Middleware\Contracts\Middleware;
use EasySwoole\Jwt\Jwt;
use App\Utility\Message\Status;

/**
 * 管理中间件
 *
 * @author pingo
 * @created_at 00-00-00
 */
class AdminMiddleware extends Middleware
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \EasySwoole\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle():bool
    {
         
		$client_token = $this->request->getCookieParams('token');
		 
		try{
			$JwtObject = Jwt::getInstance()
			->setSecretKey(config("app.jwt.secret_key")) // 秘钥
			->decode($client_token);
		}catch(\Throwable $e){
            $this->responseGP('/backdata/login',  Status::CODE_RULE_ERR, '请登录在操作！');   
			return false;
		}
		
		$status = $JwtObject->getStatus();
		switch ($status) {
			case 1:
				# 验证通过
				$this->request->jwt_data = $jwt_data = $JwtObject->getData();
				
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
                $this->responseGP('/backdata/login', Status::CODE_RULE_ERR, '请登录在操作！');
				return false;
				break;
		}
        return true; 
        //return $next($request);
    }

    

}
