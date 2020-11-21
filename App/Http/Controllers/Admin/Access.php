<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Model\Admin\AdminUser as AuthModel;
use App\Model\AdminRole as RoleModel;
use App\Model\Admin\AdminLoginLog as LoginLogModel;
use App\Service\Admin\AdminUserService;
use App\Service\Admin\AdminLoginLogService;
use App\Utility\Message\Status;
use EasySwoole\EasySwoole\Config;
use EasySwoole\VerifyCode\Conf as CodeConf;
use easySwoole\Cache\Cache;
use EasySwoole\Jwt\Jwt;
/**
 * 用户接入层
 * @author pingo <email@email.com>
 */
class Access extends BaseController
{
    
    /**
     * 登录首页展示
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function index()
    {
       
        $this->render('admin.access.login');
    }
    /**
     * 登录
     *
     * @return void
     */
    public function login()
    {
         
        $request = $this->request();
        $data    = $request->getRequestParam('uname', 'pwd', 'verify');
       
        $encry = Config::getInstance()->getConf('app.verify_encry');

        if (md5($encry . strtoupper($data['verify']) . $encry) != $this->request()->getCookieParams('v-idea')) {
            $this->writeJson(Status::CODE_VERIFY_ERR, '验证码有误');
            AdminLoginLogService::getInstance()->add(['uname' => $data['uname']]);
            return;
        }

        unset($data['verify']);

        $service_result = AdminUserService::getInstance()->login($data['uname'], $data['pwd']);
        //$this->writeServiceResult($service_result);
        if($service_result['flag']){
            
            $JwtObject = Jwt::getInstance()
                ->setSecretKey(config("app.jwt.secret_key")) // 秘钥
                ->publish();
            $JwtObject->setExp(time() + config("app.jwt.expire")); // 过期时间
            $JwtObject->setData($service_result['data']);
            $token = $JwtObject->__toString();
            $this->response()->setCookie('token', $token);
            $this->writeJson(Status::CODE_OK, '登录成功');
        }else{
            $this->writeServiceResult($service_result);
        }
        return;

        /* if ($bool) {
            $time  = time();
            $id    = $bool['id'];
            $token = md5($id . Config::getInstance()->getConf('app.token') . $time);

            $this->response()->setCookie('id', $id);
            $this->response()->setCookie('time', $time);
            $this->response()->setCookie('token', $token);
            $this->writeJson(Status::CODE_OK, '登录成功');
            LoginLogModel::getInstance()->add($data['uname'], 1);
            AuthModel::getInstance()->setLoginedTime($id);
            if(!Cache::has('role_' . $bool['role_id'])) {
                var_dump(Cache::get('role_' . $bool['role_id']));
                RoleModel::getInstance()->cacheRules($bool['role_id']);
            }
        } else {
            $this->writeJson(Status::CODE_ERR, '用户或密码错误');
            AdminLoginLogService::getInstance()->add($data['uname']);
        } */
        return;
    }

    /**
     * 
     *  退出登录
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function logout()
    {
        $this->response()->setCookie('token', '');
        $this->writeApi(0, "登出成功");
        return;
    }
    /**
     * 验证码
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function verify()
    {
        $CodeConf = new CodeConf(['backColor' => [243, 243, 243]]);
        $CodeConf->setCharset("012345678");
        $code   = new \EasySwoole\VerifyCode\VerifyCode($CodeConf);
        $this->response()->withHeader('Content-Type', 'image/png');
        
        $drawcode = $code->DrawCode();
        $this->response()->write($drawcode->getImageByte());
        $verify = strtoupper($drawcode->getImageCode());

        $encry = Config::getInstance()->getConf('app.verify_encry');
        $this->response()->setCookie('v-idea', md5($encry . $verify . $encry));
    }
}
