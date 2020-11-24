<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/24
 * Time: 下午3:20
 */

namespace App\Utility\Message;
/**
 * 响应状态码
 *
 * @author pingo
 * @created_at 00-00-00
 */
class Status
{
                                // Informational 1xx
    const CODE_OK               = 0;  // 成功
    const CODE_ERR              = -1; // 失败
    const CODE_VERIFY_ERR       = -2; // 验证码错误
    const CODE_RULE_ERR         = -3; // 权限不足
    const CODE_SYS_ERR          = -4; // 服务器异常 
    const CODE_NOT_FOUND        = -5; //请求资源不存在
    const CODE_PARAMS_FAIL      = -6; //请求参数出错
    const CODE_REQUEST_BUSY     = -7; //请求频繁
    const CODE_REQUEST_NOT_SAFE = -8; //请求有安全隐患
    const CODE_LOGIN_NEED       = -9; //请登录在操作
    const CODE_UPLOAD_TOO_BIG   = -10; //文件上传过大
    const CODE_UPLOAD_EXT_FAIL  = -11; //文件格式错误
    const CODE_SUBMIT_REPEAT    = -12; //重复提交表单
    
}
