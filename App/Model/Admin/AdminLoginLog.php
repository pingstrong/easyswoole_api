<?php

namespace App\Model\Admin;

use App\Model\BaseModel;

// 登录日志记录
class AdminLoginLog extends BaseModel
{
    protected $tableName = "admin_login_log";

    public function getCreatedAtAttr($val, $data)
    {
        return date("Y-m-d H:i:s", $val);
    }
}
