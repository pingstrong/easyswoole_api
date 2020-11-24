<?php

namespace App\Model;

use App\Utility\Pool\MysqlPool;
use App\Utility\Pool\MysqlObject;
use EasySwoole\Component\Pool\PoolManager;

use EasySwoole\ORM\AbstractModel;


class BaseModel extends AbstractModel
{
	// 都是非必选的，默认值看文档下面说明
    protected $autoTimeStamp = true;
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    //protected $connectionName = 'read'; //数据库连接池配置 读写
    //表全名称
    protected $tableName;
    //预定义属性，存取转换
    /* protected $casts = [
        'age'           => 'int',
        'id'            => 'float',
        'addTime'       => 'timestamp',
        'state'         => 'bool',
        // 在join中自定义的
        'test_json'     => 'json',
        'test_array'    => 'array',
        'test_date'     => 'date',
        'test_datetime' => 'datetime',
        'test_string'   => 'string',
    ]; */

	 
	 

}