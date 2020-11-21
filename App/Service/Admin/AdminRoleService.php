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

class AdminRoleService extends BaseService
{
    use Singleton;
    
    /**
     * Undocumented function
     *
     * @param integer $page
     * @param integer $page_size
     * @return void
     */
    public function getPageList($page = 1, $page_size = 20)
    {
        $data = AdminRole::create()
            ->limit(($page - 1) * $page_size, $page_size)
            ->all();
        $auth_count = AdminRole::create()->count();
       
        return $this->returnData(true, "查询成功", [$this->toArray($data), $auth_count]);;
    }
    /**
     * 获取所有角色
     *
     * @param array $fields
     * @return array
     */
    public function getAllList(array $fields = [], array $where = []):array
    {
       $model = AdminRole::create()->field($fields)->where($where)->all();
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
        return AdminRole::create()->data($data)->save();
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
        return AdminRole::create()->update($data, ['id' => $id]);
    }
    /**
     * 根据ID查询
     *
     * @param integer $id
     * @return array
     */
    public function getById(int $id):array
    {
        $Model = AdminRole::create()->get($id);
        return $this->toArray($Model);
    }
    /**
     * 删除
     *
     * @param [type] $ids
     * @return void
     */
    public function delete($ids)
    {
        return AdminRole::create()->destroy($ids);
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param [type] $rules_checked
     * @param [type] $rules
     * @return void
     */
    public function saveIdRules(int $id, $rules_checked, $rules)
    {
        if ($this->setById($id, ['rules_checked' => $rules_checked, 'rules' =>  $rules])) {
            // $this->cacheRules($id);
            return true;
        } else {
            return false;
        }
    }

}
