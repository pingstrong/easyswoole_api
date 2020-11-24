<?php
namespace App\Utility\Message;

/**
 * 传输数据统一格式
 *
 * @author pingo
 * @created_at 00-00-00
 */
class ApiFormat
{

     
    /**
     * api
     *
     * @author pingo
     * @created_at 00-00-00
     * @param integer $code
     * @param string $msg
     * @param array $data
     * @return array
     */
    public static function api(int $code = Status::CODE_OK, string $msg = 'ok',  $data = []): array
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }
    /**
     * api full
     *
     * @author pingo
     * @created_at 00-00-00
     * @param integer $code
     * @param string $msg
     * @param array $data
     * @param integer $error_code
     * @param string $error_msg
     * @return array
     */
    public static function apiFull(int $code = Status::CODE_OK, string $msg = 'ok', array $data = [], int $error_code = 0, string $error_msg = ''): array
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data, 'error_code' => $error_code, 'error_msg' => $error_msg];
    }
    
    /**
     * admin
     *
     * @author pingo
     * @created_at 00-00-00
     * @param integer $code
     * @param string $msg
     * @param array $data
     * @return array
     */
    public static function admin(int $code = Status::CODE_OK, string $msg = 'ok', array $data = []): array
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }
    /**
     * webSocket
     *
     * @author pingo
     * @created_at 00-00-00
     * @param integer $code
     * @param string $msg
     * @param array $data
     * @return array
     */
    public static function webSocket(int $code = Status::CODE_OK, string $msg = 'ok', array $data = []): array
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }

    public function __call($name, $arguments)
    {
        
    }


}