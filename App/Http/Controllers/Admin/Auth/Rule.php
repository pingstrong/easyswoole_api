<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\AdminController;
use App\Common\AppFunc;
use App\Utility\Log\Log;
use App\Service\Admin\AdminRuleService;
use App\Utility\Message\Status;

class Rule extends AdminController
{
    private $rule_rule      = 'auth.rule';
    private $rule_rule_view = 'auth.rule.view';
    private $rule_rule_add  = 'auth.rule.add';
    private $rule_rule_set  = 'auth.rule.set';
    private $rule_rule_del  = 'auth.rule.del';
    public function index()
    {
        if(!$this->hasRuleForGet($this->rule_rule_view)) return ;

        $this->render('admin.auth.rule');
    }

    public function getAll()
    {
        if(!$this->hasRuleForPost($this->rule_rule_view)) return ;

        $rule_data =  AdminRuleService::getInstance()->getAllList();

        $tree_data = AppFunc::arrayToTree($rule_data, 'pid');
        $data      = [];
        AppFunc::treeRule($tree_data, $data);
         
        $data = ['code' => Status::CODE_OK, 'data' => $data];
        $this->dataJson($data);
    }

    // 获取修改 和 添加的数据 并判断是否完整
    private function fieldInfo()
    {
        $request = $this->request();
        $data    = $request->getRequestParam('name', 'node', 'status', 'route_uri', 'route_handler');

        $validate = new \EasySwoole\Validate\Validate();
        $validate->addColumn('name')->required();
        $validate->addColumn('node')->required();
        $validate->addColumn('status')->required();
        //$validate->addColumn('route_uri')->required();
        //$validate->addColumn('route_handler')->required();
        if (!$validate->validate($data)) {
            $this->writeJson(Status::CODE_ERR, '请勿乱操作');
            return;
        }

        return $data;
    }

    public function add()
    {
        if(!$this->hasRuleForGet($this->rule_rule_add)) return ;

        $this->render('admin.auth.ruleAdd');
    }

    public function addData()
    {
        if(!$this->hasRuleForPost($this->rule_rule_add)) return ;

        $data = $this->fieldInfo();
        if (!$data) {
            return;
        }
        if (AdminRuleService::getInstance()->add($data)) {
            $this->writeJson(Status::CODE_OK);
        } else {
            $this->writeJson(Status::CODE_ERR, '添加失败');
            Log::getInstance()->error("rule--addData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "添加失败");
        }
    }

    public function addChild()
    {

        if(!$this->hasRuleForGet($this->rule_rule_add)) return ;

        $id = $this->request()->getRequestParam('id');
        $info = AdminRuleService::getInstance()->getById($id);
        if (!$info) {
            $this->show404();
            return;
        }
        $this->render('admin.auth.ruleAdd', ['id' => $id,'info'=>$info]);
    }

    public function addChildData()
    {
        if(!$this->hasRuleForPost($this->rule_rule_add)) return ;

        $data = $this->fieldInfo();
        if (!$data) {
            return;
        }

        $data['pid'] = $this->request()->getRequestParam('id');

        if (AdminRuleService::getInstance()->add($data)) {
            $this->writeJson(Status::CODE_OK);
        } else {
            $this->writeJson(Status::CODE_ERR, '添加失败');
            Log::getInstance()->error("rule--addChildData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "添加失败");
        }
    }

    // 修改数据的页面
    public function edit()
    {
        if(!$this->hasRuleForGet($this->rule_rule_set)) return ;

        $id = $this->request()->getRequestParam('id');

        if (!$id) {
            $this->show404();
            return;
        }

        $info = AdminRuleService::getInstance()->getById($id);
        if (!$info) {
            $this->show404();
            return;
        }

        $data = AdminRuleService::getInstance()->getAllList([], ['pid' => 0]);
        $this->render('admin.auth.ruleEdit', ['data' => $data, 'info' => $info]);
    }

    // 修改数据
    public function editData()
    {
        if(!$this->hasRuleForPost($this->rule_rule_set)) return ;

        $data = $this->fieldInfo();
        if (!$data) {
            return;
        }

        $id = $this->request()->getRequestParam('id');

        if (AdminRuleService::getInstance()->setById($id, $data)) {
            $this->writeJson(Status::CODE_OK);
        } else {
            $this->writeJson(Status::CODE_ERR, '保存失败');
            Log::getInstance()->error("rule--addData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "编辑保存失败");
        }
    }

    // 单字段修改
    public function set()
    {
        if(!$this->hasRuleForPost($this->rule_rule_set)) return ;

        $request  = $this->request();
        $data     = $request->getRequestParam('id', 'key', 'value');
        $validate = new \EasySwoole\Validate\Validate();

        $validate->addColumn('key')->required()->func(function ($params, $key) {
            return $params instanceof \EasySwoole\Spl\SplArray
            && 'key' == $key && in_array($params[$key], ['status', 'node']);
        }, '请勿乱操作');

        $validate->addColumn('id')->required();
        $validate->addColumn('value')->required();

        if (!$validate->validate($data)) {
            $this->writeJson(Status::CODE_ERR, '请勿乱操作');
            return;
        }

        $bool = AdminRuleService::getInstance()->setById($data['id'], [$data['key'] => $data['value']]);

        if ($bool) {
            $this->writeJson(Status::CODE_OK);
        } else {
            $this->writeJson(Status::CODE_ERR, '设置失败');
            Log::getInstance()->error("rule--set:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "没有设置成功");
        }
    }

    public function del()
    {
        if(!$this->hasRuleForPost($this->rule_rule_del)) return ;

        $request = $this->request();
        $id      = $request->getRequestParam('id');
        $bool    = AdminRuleService::getInstance()->delete($id);
        if ($bool) {
            $this->writeJson(Status::CODE_OK, '');
        } else {
            $this->writeJson(Status::CODE_ERR, '删除失败');
            Log::getInstance()->error("rule--del:" . $id . "没有删除失败");
        }
    }

}
