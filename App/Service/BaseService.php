<?php
namespace App\Service;

use App\Utility\Message\ApiFormat;
use App\Utility\Message\Status;

/**
 * 核心服务类
 */
abstract class BaseService
{
    //请求返回状态码
    protected $code = Status::CODE_OK;
    //请求返回消息
    protected $msg  = "";
    //请求返回数据体
    protected $data = null;

    /**
     * 返回状态码
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * 返回标题信息
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function getMsg()
    {
        return $this->msg;
    }
    /**
     * 返回数据
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function getData()
    {
        return $this->data;
    }
    /**
     * 返回api结果
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function getResult()
    {
        return ApiFormat::api($this->code, $this->msg, $this->data);
    }
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
