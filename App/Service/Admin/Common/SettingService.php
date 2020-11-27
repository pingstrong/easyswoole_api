<?php
namespace App\Service\Admin\Common;

use App\Model\Common\Setting;
use App\Service\BaseService;
use App\Traits\Singleton;

/**
 * 常规配置
 *
 * @author pingo
 * @created_at 00-00-00
 */
class SettingService extends BaseService
{
    use Singleton;
    /**
     * 设置
     *
     * @author pingo
     * @created_at 00-00-00
     * @param string $key
     * @param array $val
     * @return boolean
     */
    public function set(string $key, array $val = []): bool
    {
        try {
            //code...
            $SettingModel = Setting::create()->get(['key_name' => $key]);
            if($SettingModel){
                $SettingModel->key_value = $val;
                $SettingModel->update();
            }else{
                Setting::create(['key_name' => $key, 'key_value' => $val])->save();
            }
            //加入缓存
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

    }
    /**
     * 获取
     *
     * @author pingo
     * @created_at 00-00-00
     * @param string $key
     * @return array || string
     */
    public function get(string $key = null)
    {
        //缓存获取、否则查库
        $SettingObj = Setting::create()->all();
         
        if($data = $this->toArray($SettingObj) ){
            $setting_data = array_combine(array_column($data, 'key_name'), array_column($data, 'key_value'));
            if(is_null($key)) return $setting_data;
            if(FALSE !== strpos($key, ".")){
                $keys = explode(".", $key);
                foreach($keys as $key_name){
                    if(isset($setting_data[$key_name])){
                        $setting_data = $setting_data[$key_name];
                    }else{
                        return null;
                    }
                }
            }
            return $setting_data[$key]?? null;
        }
        return null;
    }



}