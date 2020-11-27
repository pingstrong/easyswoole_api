<?php
namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Admin\AdminController;
use App\Service\Admin\Common\SettingService;
use App\Utility\Message\Status;

/**
 * 常规设置
 *
 * @author pingo
 * @created_at 00-00-00
 */
class CustomSetting extends AdminController
{
    /**
     * 数据展示
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function index()
    {
        //搜索字段条件
        $data = SettingService::getInstance()->get();
        var_dump($data['web']);
        return $this->render("admin.setting.custom_setting.index", ['setting' => $data]);
    }
    /**
     * 添加
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function add()
    {

    }
    /**
     * 修改
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function edit()
    {
        $result = SettingService::getInstance()->set($this->request_post['key'], $this->request_post);
        $this->writeJson(Status::CODE_OK, lang($result ? "request_success" : "request_fail"));
    }
    /**
     * 删除
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function del()
    {

    }
}