<?php
namespace App\Service\Admin;

use App\Service\BaseService;
use App\Model\Admin\AdminUser;
use App\Traits\Singleton;
/**
 * 管理员服务类
 * 
 */

class AdminUserService extends BaseService
{
    use Singleton;
    /**
     * 登录
     *
     * @param string $username
     * @param string $password
     * @return array
     */
    public function login(string $username, string $password): array
    {
        try {
            //code...
            $where['deleted'] = 0;
            $where['uname'] = $username;
             
            $AdminUser = AdminUser::create()->get($where);
            if(is_null($AdminUser) ) return  $this->returnData(false, "账号或密码不正确！！！");
            
            if($AdminUser->pwd !== encrypt($password, $AdminUser->encry)) return $this->returnData(false, "账号或密码错误！！");
            return $this->returnData(true, "登录成功。", $AdminUser->toArray());
        } catch (\Throwable $th) {
            //throw $th;
            return $this->returnData(false, $th->getMessage());
        }
         
    }
    /**
     * Undocumented function
     *
     * @param array $where
     * @param integer $page
     * @param integer $page_size
     * @return void
     */
    public function getPageList($page = 1, $page_size = 20)
    {
        $data = AdminUser::create()->where('deleted', 0, '=')
            ->join('admin_role', 'admin_user.role_id = admin_role.id')
            ->where('admin_user.deleted', 0, '=')
            ->order('admin_user.id', 'DESC')
            ->field("admin_user.id,uname,display_name,admin_user.created_at,logined_at,status,admin_role.name as role_name")
            ->limit(($page - 1) * $page_size, $page_size)
            ->all();
        $auth_count = AdminUser::create()->where('deleted', 0, '=')->count();
       
        return $this->returnData(true, "查询成功", [$this->toArray($data), $auth_count]);;
    }

    /**
     * 更新
     *
     * @param array $where
     * @param array $data
     * @return void
     */
    public function modify(array $where, array $data)
    {
        return  AdminUser::create()->update($data, $where);
    }
    /**
     * 根据ID查询
     *
     * @param integer $id
     * @return array
     */
    public function getUserById(int $id):array
    {
        $Model = AdminUser::create()->get($id);
        return $this->toArray($Model);
    }
    /**
     * 根据ID修改
     *
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function setUserById(int $id, array $data): bool
    {
        return AdminUser::create()->update($data, ['id' => $id]);
    }
    /**
     * 新增
     *
     * @param array $data
     * @return void
     */
    public function add(array $data)
    {
        $salt = random_str(6, false, true);
        $data['pwd'] = encrypt($data['pwd'], $salt);
        $data['encry'] = $salt;
        return AdminUser::create()->data($data)->save();
    }
    
}
