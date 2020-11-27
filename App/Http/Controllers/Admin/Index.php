<?php

namespace App\Http\Controllers\Admin;

//use App\Model\AdminLoginLog as LoginLog;
use App\Common\AppFunc;
use App\Service\Admin\Auth\AdminLoginLogService;
use App\Service\Admin\Auth\AdminRuleService;
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
        $this->render(
            'admin.home.index',
            [
                'uname'     => $this->jwt_data['uname'], 
        ]);
    }

    /**
     * 清除缓存
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function clearCache()
    {
        
        $this->writeJson(Status::CODE_OK, lang("request_success"));
    }
    /**
     * 获取菜单
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function initMenu()
    {
        //后台菜单
        $menuInfo =  AdminRuleService::getInstance()->getRulesByRouteNodes($this->account_rule_nodes);
        $menu = [
            "homeInfo" => [
                "title" => "首页",
                "href"  => "/backdata/console"
              ],
              "logoInfo" => [
                    "title" => "控制台",
                    "image" => "/img/logo.png",
                    "href"  => ""
              ],
              "menuInfo" => $menuInfo
        ];
      
        $this->writeJson(Status::CODE_OK, lang("request_success"), $menu);
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
    /**
     * default page
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function defaultPage()
    {
        $page_no = [403, 404, 502];
        $page = in_array($this->request_params['id'], $page_no) ? $this->request_params['id'] : $page_no[1];
        return $this->render("default.{$page}");
    }
    // 日志
    public function version()
    {
        
        $this->render('admin.home.version');
    }
}
