<?php
namespace  App\Service\Common;

use App\Model\Common\UploadFile as UploadFileModel;
use App\Service\Admin\Common\SettingService;
use App\Service\BaseService;
use App\Traits\Singleton;
use EasySwoole\EasySwoole\ServerManager;

/**
 * 文件上传
 *
 * @author pingo
 * @created_at 00-00-00
 */
class UploadFileService extends  BaseService
{
    use Singleton;

    /**
     * 入库记录资源
     *
     * @author pingo
     * @created_at 00-00-00
     * @param string $path
     * @param string $type
     * @param integer $size
     * @param string $name
     * @return void
     */
    public  function store(string $path, string $type, int $size, string $name)
    {
        
        try {
            //code...
            $base_url = SettingService::getInstance()->get('web.base_url');
            $url    = $base_url . $path;
            $pic_type = ['jpg', 'jpeg', 'png', 'gif', 'webmp'];
            $data['storage'] = 'local';
            $data['type']    = in_array($type, $pic_type) ? 'image' : 'file';
            $data['name']    = $name;
            $data['ext']     = $type;
            $data['size']    = $size;
            $data['path']    = $path;
            $data['url']     = $url;
            $insert_id = UploadFileModel::create()->data($data)->save();
            if(!empty($insert_id)){
                return ['url' => $url, 'file_id' => $insert_id];
            }
        } catch (\Throwable $th) {
            //throw $th;
            return  false;
        }

        return false;
       /*  //获取配置存储位置
        //本地存储
        //七牛云
        go(function (){

            $auth = new \EasySwoole\Oss\QiNiu\Auth(QINIU_ACCESS_KEY,QINIU_SECRET_KEY);
        
            $key = 'formPutFileTest';
            $token = $auth->uploadToken('tioncico', $key);
            $upManager = new \EasySwoole\Oss\QiNiu\Storage\UploadManager();
            list($ret, $error) = $upManager->putFile($token, $key, __file__, null, 'text/plain', null);
            var_dump($ret,$error);
        });
        //阿里云
        go(function (){

            $config = new \EasySwoole\Oss\AliYun\Config([
                'accessKeyId'     => ACCESS_KEY_ID,
                'accessKeySecret' => ACCESS_KEY_SECRET,
                'endpoint'        => END_POINT,
            ]);
            $client = new \EasySwoole\Oss\AliYun\OssClient($config);
            $data = $client->putObject('tioncicoxyz','test',__FILE__);
            var_dump($data);
        });
        //腾讯云
        go(function (){
        //config配置
            $config = new \EasySwoole\Oss\Tencent\Config([
                'appId'     => TX_APP_ID,
                'secretId'  => TX_SECRETID,
                'secretKey' => TX_SECRETKEY,
                'region'    => TX_REGION,
                'bucket'    => TX_BUCKET,
            ]);
            //new客户端
            $cosClient = new \EasySwoole\Oss\Tencent\OssClient($config);
        
            $key = '你好111.txt';
            //生成一个文件数据
            $body = generateRandomString(2 * 1024  + 1023);
            //上传
            $cosClient->upload($bucket = TX_BUCKET,
                $key = $key,
                $body = $body,
                $options = ['PartSize' => 1024 + 1]
            );
            //获取文件内容
            $rt = $cosClient->getObject(['Bucket' => TX_BUCKET, 'Key' => $key]);
            var_dump($rt['Body']->__toString());
        });

         */
        
        
    }
}