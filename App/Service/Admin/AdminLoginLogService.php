<?php
namespace App\Service\Admin;

use App\Service\BaseService;
use App\Model\Admin\AdminLoginLog;
use App\Traits\Singleton;
/**
 * 登录日记
 * 
 */

class AdminLoginLogService extends BaseService
{
    use Singleton;
    /**
     * 新增日记
     *
     * @param array $data
     * @return void
     */
    public function add(array $data)
    {
        return AdminLoginLog::create()->data($data)->save();
    }
    /**
     * 查询所有
     *
     * @param integer $page
     * @param integer $page_size
     * @return void
     */
    public function getPageList($page = 1, $page_size = 20)
    {
        $data = AdminLoginLog::create()
            ->limit(($page - 1) * $page_size, $page_size)
            ->all();
        $auth_count = AdminLoginLog::create()->count();
       
        return $this->returnData(true, "查询成功", [$this->toArray($data), $auth_count]);;
    }

}
