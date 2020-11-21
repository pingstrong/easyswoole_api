<?php
return [
    'SERVER_NAME' => "EasySwoole",
    'MAIN_SERVER' => [
        'LISTEN_ADDRESS' => '0.0.0.0',
        'PORT'           => 9501,
        'SERVER_TYPE'    => EASYSWOOLE_WEB_SOCKET_SERVER, //可选为 EASYSWOOLE_SERVER  EASYSWOOLE_WEB_SERVER EASYSWOOLE_WEB_SOCKET_SERVER
        'SOCK_TYPE'      => SWOOLE_TCP,
        'RUN_MODEL'      => SWOOLE_PROCESS,
        'SETTING'   => [
            'worker_num'    => 8,
            'reload_async'  => true,
            'max_wait_time' => 3,
            'document_root' => './App/Static', // 版本小于v4.4.0时必须为绝对路径
            'enable_static_handler' => true,
        ],
        'TASK'  => [
            'workerNum'     => 4,
            'maxRunningNum' => 128,
            'timeout'       => 15
        ]
    ],
    'TEMP_DIR' => __DIR__ . '/Temp',
    'LOG_DIR' => __DIR__ . '/Log'
];