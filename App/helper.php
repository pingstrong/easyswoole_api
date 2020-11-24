<?php
/**
 *  公共方法
 * @author pingo <pingstrong@163.com>
 */
use EasySwoole\Component\Di;
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
function  lang($str, $package = '')
{
    $lang_data = Config::getInstance()->getConf(\App\Consts::SYSTEM_LANG);
    if (empty($package)) {
        # code...
        $package = Config::getInstance()->getConf(\App\Consts::SYSTEM_DEFAULT_LANG);
    }
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

if (!function_exists('app')) {
    /**
     * 获取Di容器
     * @param null $abstract
     * @return Di|null
     * @throws Throwable
     */
    function app($abstract = null)
    {
        if (is_null($abstract)) {
            return Di::getInstance();
        }
        return Di::getInstance()->get($abstract);
    }
}

if (!function_exists('dd')) {
    /**
     * @param $data
     */
    function dd($data)
    {
        echo '--------------------调试输出-------------------------' . PHP_EOL;
        print_r($data);
        echo '----------------------------------------------------' . PHP_EOL;
    }
}

if (!function_exists('xmlToArray')) {
    /**
     * xml转array
     * @param $xml
     * @return mixed
     */
    function xmlToArray($xml)
    {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;
    }
}

if (!function_exists('arrayToXml')) {
    /**
     * array转xml
     * @param array $arr 数组
     * @return string   $xml     xml字符串
     */
    function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }
}

if (!function_exists('object_array')) {
    /**
     * 对象转数组
     * @param $array
     * @return array
     */
    function object_array($array)
    {
        if (is_object($array)) {
            $array = (array)$array;
        }
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $array[$key] = object_array($value);
            }
        }
        return $array;
    }
}


if (!function_exists('array_object')) {
    /**
     * 数组转对象
     * @param $array
     * @return StdClass
     */
    function array_object($array)
    {
        if (is_array($array)) {
            $obj = new StdClass();
            foreach ($array as $key => $val) {
                $obj->$key = $val;
            }
        } else {
            $obj = $array;
        }
        return $obj;
    }
}