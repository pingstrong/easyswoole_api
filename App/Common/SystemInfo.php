<?php
/**
 *  author pingo
 */
namespace App\Common;
/**
 * 系统信息
 * 
 */
 class SystemInfo
 {
    public static $INFO = [];
    
    public static function  getAll()
    {
        
        self::$INFO['swoole_version'] = swoole_version();
        self::$INFO['cpu_num'] = swoole_cpu_num();
        self::$INFO['local_ips'] = implode(",",swoole_get_local_ip());
        self::$INFO['php_version'] = phpversion();
        self::$INFO['sys_loadavg'] = sys_getloadavg();

        $free = shell_exec('free');
        $free = (string)trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $memory_usage = $mem[2]/$mem[1]*100;
        self::$INFO['memory_useavg'] = sprintf("%.2f", $memory_usage);

        return self::$INFO;
        
        
    }
     
 }