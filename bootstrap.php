<?php
//全局bootstrap事件

date_default_timezone_set('Asia/Shanghai');
// 载入助手函数 ，支持composer.json 属性{"autoload": "files": ["App/helper.php"]}
include_once EASYSWOOLE_ROOT . '/App/helper.php';
//注册自定义命令
\EasySwoole\Command\CommandManager::getInstance()->addCommand(new \App\Command\Test());
