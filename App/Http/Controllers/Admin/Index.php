<?php

namespace App\Http\Controllers\Admin;

//use App\Model\AdminLoginLog as LoginLog;
use App\Common\AppFunc;
use App\Service\Admin\AdminLoginLogService;
use App\Service\Admin\AdminRuleService;
use \EasySwoole\LinuxDash\LinuxDash;
use App\Utility\Message\Status;
use App\Common\SystemInfo;

class Index extends AdminController
{

    /**
     * 控制台
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function console()
    {

        $sysinfo = SystemInfo::getAll();
        return $this->render('admin.home.console', ['sysinfo'   => $sysinfo]);
    }
    /**
     * 统计仪表
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function dashboard()
    {
        return $this->render('admin.home.dashboard');
    }
    /**
     * 主页
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function index()
    {
        $rule_data =  AdminRuleService::getInstance()->getAllList();
        $tree_data = AppFunc::arrayToTree($rule_data, 'pid');
        $data      = AppFunc::arrayToTree($tree_data);
        
        $this->render(
            'admin.home.index',
            [
                'uname'     => $this->jwt_data['uname'], 
                'menu_list' => $data,
                
        ]);
    }

    public function indexContext()
    {
        $sysinfo = SystemInfo::getAll();
        $this->render('admin.index.indexContext', ['sysinfo'   => $sysinfo]);
    }

    // 登录日志信息
    public function loginLog()
    {
 		$data = $this->getPage();
        $service_result = AdminLoginLogService::getInstance()->getPageList($data['page'], $data['limit']);
        list($list_data, $count) = $service_result['data'];
        $data       = ['code' => Status::CODE_OK, 'count' => $count, 'data' => $list_data];
        $this->dataJson($data);
        return;
    }

    // 日志
    public function version()
    {
        $this->render('admin.home.version');
    }
}
