<?php
namespace App\Service;


/**
 * 核心服务类
 */
abstract class BaseService
{
   
    /**
     * 返回业务处理数据
     *
     * @param boolean $flag
     * @param string $msg
     * @param array $data
     * @return array
     */
    public function returnData(bool $flag = true,  string $msg = "success", array $data = []): array
    {
        return [
            'flag' => $flag,
            'data' => $data,
            'msg'  => $msg
        ];
    }
    /**
     * 模型对象转数组
     *
     * @param [type] $ModelObject
     * @return array
     */
    public function toArray($ModelObject, bool $raw = false): array
    {
        
        if(empty($ModelObject)) return [];
         
        //单个对象
        if(is_object($ModelObject)) return $ModelObject->toArray();
        $data = [];
        foreach ($ModelObject as $key => $object) {
            # code...
            $data[] = $raw ? $object->toRawArray(false, false) : $object->toArray(false, false);
        }
        
        return $data;
    }

}
