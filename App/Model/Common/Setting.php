<?php

namespace App\Model\Common;

use App\Model\BaseModel;

/**
 * 公共配置
 *
 * @author pingo
 * @created_at 00-00-00
 */
class Setting extends BaseModel
{
    protected $tableName = "common_setting";
    //类型
    protected $casts = [
        'key_value'     => 'array',
    ];
     
}
