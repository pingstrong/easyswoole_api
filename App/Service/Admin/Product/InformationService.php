<?php
namespace App\Service\Admin\Product;

use App\Service\BaseService;
use App\Traits\Singleton;
use App\Utility\Message\Status;

/**
 * 资讯文章
 *
 * @author pingo
 * @created_at 00-00-00
 */
class InformationService extends BaseService
{
        use Singleton;
        /**
         * 获取查询分页数据列表
         *
         * @author pingo
         * @created_at 00-00-00
         * @param array $search
         * @param integer $page
         * @param integer $limit
         * @param string $orderBy
         * @return $this
         */
        public function all(array $search = [], int $page = 1, int $limit = 10, string $orderBy = null)
        {
            $this->code = Status::CODE_OK;
            $this->msg  = lang("request_success");
            $list = [
                [
                    "id"=> 10000,
                    "username"=> "user-0",
                    "sex"=> "女",
                    "city"=> "城市-0",
                    "sign"=> "签名-0",
                    "experience"=> 255,
                    "logins"=> 24,
                    "wealth"=> 82830700,
                    "classify"=> "作家",
                    "score"=> 57,
                    "status1" => 1,
                    "status2" => 0,
                ],
                  [
                    "id"=> 10001,
                    "username"=> "user-1",
                    "sex"=> "男",
                    "city"=> "城市-1",
                    "sign"=> "签名-1",
                    "experience"=> 884,
                    "logins"=> 58,
                    "wealth"=> 64928690,
                    "classify"=> "词人",
                    "score"=> 27,
                    "status1" => 0,
                    "status2" => 1,
                  ],
            ];
            $total = count($list);
            $data = ['list' => $list, 'total' => $total];
            $this->data = $data;
            return $this;
        }
        /**
         * 根据条件查询
         *
         * @author pingo
         * @created_at 00-00-00
         * @param array $field
         * @return array
         */
        public function findBy(array $field  = []): array
        {
            return [];
        }
        /**
         * 查询某一项
         *
         * @author pingo
         * @created_at 00-00-00
         * @param array $field
         * @return void
         */
        public function getItemBy(array $field = []): array 
        {
            return [];
        }
        /**
         * 修改数据
         *
         * @author pingo
         * @created_at 00-00-00
         * @param array $field
         * @param array $where
         * @return boolean
         */
        public function modify(array $field, array $where): bool
        {
            return true;
        }
        /**
         * 根据条件删除数据
         *
         * @author pingo
         * @created_at 00-00-00  
         * @param [type] $where
         * @return boolean
         */
        public function destroy($where): bool
        {

            return true;
        }

}