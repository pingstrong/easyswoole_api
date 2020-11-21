<?php
namespace App\Service\Admin;

use App\Service\BaseService;
use App\Model\Admin\AdminLog;
use App\Traits\Singleton;
/**
 * 登录日记
 * 
 */

class AdminLogService extends BaseService
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
        return AdminLog::create()->data($data)->save();
    }
}
