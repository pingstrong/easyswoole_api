<?php

namespace App\Utility\RoleGroup;
use easySwoole\Cache\Cache;
 
use App\Service\Admin\AdminRuleService;


class RoleGroup 
{
	private $role_id;
	public function __construct($role_id)
	{
		$this->role_id = $role_id;
	}
	
	public function hasRule($rule)
	{
		if(empty($rule)) {
            return true;
        }

        if(!isset($this->rules)) {
			$this->rules = AdminRuleService::getInstance()->getNodesByRoleId($this->role_id);
        }

        return in_array($rule, $this->rules);
	}
	
}