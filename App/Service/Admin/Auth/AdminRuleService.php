<?php
namespace App\Service\Admin\Auth;

use App\Common\AppFunc;
use App\Service\BaseService;
use App\Model\Admin\AdminRule;
use App\Model\Admin\AdminRole;
use App\Traits\Singleton;
/**
 *  
 * 
 */

class AdminRuleService extends BaseService
{
    use Singleton;
     /**
      * 根据角色ID查询授权标识路由
      *
      * @param integer $role_id
      * @return array
      */
    public function getColumnByRoleId(int $role_id, string $col = "id", int $is_super = 0): array
    {
        try{
            
            switch ($is_super) {
                case 1:
                    # code...
                    $nodes = AdminRule::create()->where('status', 1)->column($col);
                    break;
                default:
                    # code...
                    $rules = AdminRole::create()->where(['id' => $role_id])->scalar('rules');
                    if(!is_array($rules)) $rules = explode(",", $rules);
                    $nodes = AdminRule::create()->where('status', 1)->where('id', $rules, 'IN')->column($col);
                    break;
            }
            
            return empty($nodes)? [] : array_filter($nodes);

        }catch(\Throwable $e){
            
            return [];
        }
    }
    
    /**
     * 获取所有角色
     *
     * @param array $fields
     * @return array
     */
    public function getAllList(array $fields = [], array $where = []):array
    {
       $AdminRule = new AdminRule;
       $model = $AdminRule->field($fields)->where($where)->all();
       //打印最后执行的sql语句
       //var_dump($AdminRule->lastQuery()->getLastQuery());
       return $this->toArray($model);
    }
    
    /**
     * 新增
     *
     * @param array $data
     * @return void
     */
    public function add(array $data)
    {
        return AdminRule::create()->data($data)->save();
    }
    /**
     * 根据ID查询
     *
     * @param integer $id
     * @return array
     */
    public function getById(int $id):array
    {
        $Model = AdminRule::create()->get($id);
        return $this->toArray($Model);
    }

    /**
     * 根据ID修改
     *
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function setById(int $id, array $data): bool
    {
        return AdminRule::create()->update($data, ['id' => $id]);
    }
    /**
     * 删除
     *
     * @param [type] $ids
     * @return void
     */
    public function delete($ids)
    {
        return AdminRule::create()->destroy($ids);
    }
    /**
     * 根据授权路由获取菜单列表
     *
     * @author pingo
     * @created_at 00-00-00
     * @param [type] $account_route_nodes
     * @return void
     */
    public function getRulesByRouteNodes(array $account_route_nodes)
    {
        $rule_data =  $this->getAllList();
        foreach ($rule_data as $key => $rule) {
            # code...
            $rule_data[$key]['target'] = "_self";
            if(!in_array($rule['node'], $account_route_nodes) || $rule['is_menu'] == 0){
                unset($rule_data[$key]);
            } 
        }
        
        $tree_data =  AppFunc::arrayToTree($rule_data, 'pid', ['name' => 'title', 'route_uri' => 'href'], 'child');
        return AppFunc::arrayToTree($tree_data);
    }

}
