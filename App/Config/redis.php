<?php
/**
 * redis连接配置
 */
return [
    'host'      => 'redis', //服务器地址
    'port'      => 6379,    //端口
    'password'  => '',  //密码
    
    'pool_minnum' => 10,
    'pool_maxnum' => 30,
    'auto_ping'   => 10
];
