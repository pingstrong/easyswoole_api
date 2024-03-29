<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\AdminController;
use App\Common\AppFunc;
use App\Service\Admin\Auth\AdminRoleService;
use App\Service\Admin\Auth\AdminRuleService;
use App\Utility\Log\Log;
use App\Utility\Message\Status;

class Role extends AdminController
{
    private $rule_role      = 'auth.role';
    private $rule_role_view = 'auth.role.view';
    private $rule_role_add  = 'auth.role.add';
    private $rule_role_set  = 'auth.role.set';
    private $rule_role_del  = 'auth.role.del';
    private $rule_role_rule = 'auth.role.rule';
    
    public function index()
    {
        if(!$this->hasRule($this->rule_role_view)) return ;

        $this->render('admin.auth.role');
    }

    public function getAll()
    {
        if(!$this->hasRule($this->rule_role_view)) return ;

        $data = $this->getPage();

        $service_result =  AdminRoleService::getInstance()->getPageList($data['page'], $data['limit']);
        list($role_data, $role_count) = $service_result['data'];
         
        $tree_data = AppFunc::arrayToTree($role_data, 'pid');
        $data      = [];
        AppFunc::treeRule($tree_data, $data);
        $data       = ['code' => Status::CODE_OK, 'data' => $data, 'count' => $role_count];
        $this->dataJson($data);
        return;
    }

    private function fieldInfo()
    {
        $request = $this->request();
        $data    = $this->getRequestParams(['name', 'detail','pid']);//$request->getRequestParam('name', 'detail','pid');

        $validate = new \EasySwoole\Validate\Validate();
        $validate->addColumn('name')->required();
        $validate->addColumn('detail')->required();
        $validate->addColumn('pid')->required();

        if (!$validate->validate($data)) {
            $this->writeJson(Status::CODE_ERR, '请勿乱操作');
            return;
        }

        return $data;
    }

    public function add()
    {
        if(!$this->hasRule($this->rule_role_add)) return ;
        $role_data = AdminRoleService::getInstance()->getAllList();
        $this->render('admin.auth.roleAdd',['role_data'=>$role_data]);
    }

    public function addData()
    {
        if(!$this->hasRule($this->rule_role_add)) return ;

        $data = $this->fieldInfo();
        if (!$data) {
            return;
        }

        if (AdminRoleService::getInstance()->add($data)) {
            $this->writeJson(Status::CODE_OK);
        } else {
            $this->writeJson(Status::CODE_ERR, '添加失败');
            Log::getInstance()->error("role--addData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "没有添加失败");
        }
    }

    public function edit()
    {
        if(!$this->hasRule($this->rule_role_set)) return ;

        $id = $this->getRequestParams('id');
        var_dump($id);
        $info = AdminRoleService::getInstance()->getById($id);
        $role_data = AdminRoleService::getInstance()->getAllList(['id', 'name'], ['id' =>[$id, '<>']]);

        $this->render('admin.auth.roleEdit', ['id' => $id, 'info' => $info, 'role_data'=>$role_data]);
    }

    public function editData()
    {
        if(!$this->hasRule($this->rule_role_set)) return ;

        $data = $this->fieldInfo();
        if (!$data) {
            return;
        }
       
        $id = $this->request_params['id'];
        if (AdminRoleService::getInstance()->setById($id, $data)) {
            $this->writeJson(Status::CODE_OK);
        } else {
            $this->writeJson(Status::CODE_ERR, '保存失败');
            Log::getInstance()->error("role--editData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "编辑保存失败");
        }
        return;
    }

    public function set()
    {
        if(!$this->hasRule($this->rule_role_set)) return ;

        $request  = $this->request();
        $data     = $this->getRequestParams(['id', 'key', 'value']);//$request->getRequestParam('id', 'key', 'value');
        $validate = new \EasySwoole\Validate\Validate();

        $validate->addColumn('key')->required()->func(function ($params, $key) {
            return $params instanceof \EasySwoole\Spl\SplArray
            && 'key' == $key && in_array($params[$key], ['name', 'detail']);
        }, '请勿乱操作');

        $validate->addColumn('id')->required();
        $validate->addColumn('value')->required();

        if (!$validate->validate($data)) {
            $this->writeJson(Status::CODE_ERR, '请勿乱操作');
            return;
        }

        $bool = AdminRoleService::getInstance()->setById($data['id'], [$data['key'] => $data['value']]);
        if ($bool) {
            $this->writeJson(Status::CODE_OK);
        } else {
            $this->writeJson(Status::CODE_ERR, '设置失败');
            Log::getInstance()->error("role--set:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "没有设置成功");
        }
    }

    public function del()
    {
        if(!$this->hasRule($this->rule_role_del)) return ;

        $request = $this->request();
        $id      = $this->request_params['id'];
        $bool    = AdminRoleService::getInstance()->delete($id);
        if ($bool) {
            $this->writeJson(Status::CODE_OK, '');
        } else {
            $this->writeJson(Status::CODE_ERR, '删除失败');
            //Log::getInstance()->error("role--del:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "没有删除失败");
        }
    }

    public function editRule()
    {
        if(!$this->hasRule($this->rule_role_view)) return ;

        $rule_data = AdminRuleService::getInstance()->getAllList(['id', 'name as title', 'name', 'pid'], ['status' => 1]);
         
        $data      = AppFunc::arrayToTree($rule_data);
        $id        = $this->request_params['id'];
       
        $role_info = AdminRoleService::getInstance()->getById($id);
        
        $this->render('admin.auth.editRule', ['id' => $id, 'data' => $data, 'checked' => explode(',', $role_info['rules_checked'])]);
    }

    public function editRuleData()
    {
        if(!$this->hasRule($this->rule_role_rule)) return ;

        $info = $this->getRequestParams(['id', 'rules_checked', 'rules']);//$this->request()->getRequestParam('id', 'rules_checked', 'rules');
         var_dump($info);
        $id = $info['id'];
        if (AdminRoleService::getInstance()->saveIdRules($id, $info['rules_checked'] ? $info['rules_checked'] : [], $info['rules'] ? $info['rules'] : [])) {
            $this->writeJson(Status::CODE_OK);
        } else {
            $this->writeJson(Status::CODE_ERR, '删除失败');
            Log::getInstance()->error("role--editRuleData:" . json_encode($info, JSON_UNESCAPED_UNICODE) . "权限变更失败");
        }
        return;
    }
}
