<?php
namespace App\Service\Admin;

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
    public function getNodesByRoleId(int $role_id): array
    {
        try{
            $rules = AdminRole::create()->where(['id' => $role_id])->scalar('rules');
            if(!is_array($rules)) $rules = explode(",", $rules);
            $nodes = AdminRule::create()->where('status', 1)->where('id', $rules, 'IN')->column('node');
            
            return empty($nodes)? [] : $nodes;

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
}
