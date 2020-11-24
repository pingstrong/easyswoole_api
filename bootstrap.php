<?php
//全局bootstrap事件

date_default_timezone_set('Asia/Shanghai');
defined('WEB_STATIC_PATH') or define('WEB_STATIC_PATH', EASYSWOOLE_ROOT . "/Static");
defined('WEB_UPLOAD_PATH') or define( 'WEB_UPLOAD_PATH', WEB_STATIC_PATH . "/uploads");
// 载入助手函数 ，支持composer.json 属性{"autoload": "files": ["App/helper.php"]}
include_once EASYSWOOLE_ROOT . '/App/helper.php';
//注册自定义命令
\EasySwoole\Command\CommandManager::getInstance()->addCommand(new \App\Command\Test());
