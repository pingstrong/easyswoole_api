<?php
namespace App\WebSocket\Controller;

use App\Task\TestTask;
use EasySwoole\EasySwoole\Task\TaskManager;

/**
 * 接入层
 *
 * @author pingo
 * @created_at 00-00-00
 */
class Access extends Base
{

    public function login()
    {
        TaskManager::getInstance()->async(new TestTask(['name' => "pingo"]));
        $this->send(0, "okk");
    }

}