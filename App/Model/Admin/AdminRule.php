<?php

namespace App\Model\Admin;

use App\Model\BaseModel;

class AdminRule extends BaseModel
{
    protected $tableName = "admin_rule";

    public function getCreatedAtAttr($val, $data)
    {
        return date("Y-m-d H:i:s", $val);
    }
}
