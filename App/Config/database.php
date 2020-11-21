<?php

return [
    
    //数据库配置
    'host'                 => 'mariadb',//数据库连接ip  docker用mysql 
    'user'                 => 'root',//数据库用户名
    'password'             => 'Think1688...',//数据库密码
    'database'             => 'easyswoole',//数据库
    'port'                 => '3306',//端口
    'timeout'              => '30',//超时时间
    'connect_timeout'      => '5',//连接超时时间
    'charset'              => 'utf8',//字符编码
    'strict_type'          => false, //开启严格模式，返回的字段将自动转为数字类型
    'fetch_mode'           => false,//开启fetch模式, 可与pdo一样使用fetch/fetchAll逐行或获取全部结果集(4.0版本以上)
    'alias'                => '',//子查询别名
    'isSubQuery'           => false,//是否为子查询
    'max_reconnect_times ' => '3',//最大重连次数

    'pool_getobj_timeout'  => 3, //设置获取连接池对象超时时间
    'pool_checktime'       => 30*1000, //设置检测连接存活执行回收和创建的周期
    'pool_idletime'        => 15, //连接池对象最大闲置时间(秒)
    'pool_obj_minnum'        => 10, //设置最小连接池存在连接对象数量
    'pool_obj_maxnum'        => 100, //设置最大连接池存在连接对象数量
    'pool_auto_ping'        => 15, //设置自动ping客户端链接的间隔
];
