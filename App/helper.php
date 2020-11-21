<?php
/**
 *  公共方法
 * @author pingo <pingstrong@163.com>
 */

use EasySwoole\EasySwoole\Config;

if(!function_exists('config')){
    /**
     * 获取配置信息
     *
     * @param [type] $name
     * @param [type] $val
     * @return mixed | boolean
     */
    function config($name = null, $val = null)
    {
        if(is_null($name)){
            return Config::getInstance()->getConf();
        }
        if (is_null($val)) {
            # code...
            return Config::getInstance()->getConf($name);
        }

        return Config::getInstance()->setConf($name, $val);
    }
}


if(!function_exists("encrypt")){
    /**
     * md5加密函数
     *
     * @param [type] $string
     * @param string $salt
     * @return string
     */
    function encrypt($string, $salt = 'mqtt')
    {
        return md5($string . $salt . $string);
    }
}
 
/**
 * 随机返回字符串
 * @param number 返回字符串长度
 * @param string 从哪些字符串中随机返回，已设置默认字符串，可空
 * @param boolean 是否需要特殊字符
 * @return string 返回随机字符串
 */
function random_str($length = 8, $chars = null, $special = false) {
    static $s;
    if( empty($chars) ) $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789" . ($special ? "~!#$%^&*()_+{<>?.}": "");
    while( strlen($s) < $length) {
        $s .= substr($chars, rand(0, strlen($chars) - 1), 1);
    }
    return $s;
}
 
/**
 * 字符串替换所有特定字符
 *
 * @author pingo
 * @created_at 00-00-00
 * @param [type] $str
 * @param string $replace
 * @return void
 */
function trimall($str, $replace = ' ')
{
    return preg_replace("#{$replace}#", '', $str);
}

/**
 * 获取多语言内容
 *
 * @author pingo
 * @created_at 00-00-00
 * @param [type] $str
 * @param string $package
 * @return void
 */
function  lang($str, $package = 'zh')
{
    $lang_data = Config::getInstance()->getConf(\App\Consts::SYSTEM_LANG);
    return $lang_data[$package][$str]?? null;
}

/**解压缩
 * @param $filepath
 * @param $extractTo
 * @return bool
 */
function unzip($filepath, $extractTo = '.') {
    $zip = new ZipArchive();
    $res = $zip->open($filepath);
    if ($res === TRUE) {
        //解压缩到$extractTo指定的文件夹
        $zip->extractTo($extractTo);
        $zip->close();
        return true;
    } else {
        echo 'failed, code:' . $res;
        return false;
    }
}