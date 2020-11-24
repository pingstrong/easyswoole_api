<?php
namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Admin\AdminController;
use App\Utility\Message\Status;

/**
 * 文件上传
 *
 * @author pingo
 * @created_at 00-00-00
 */
class UploadFile extends AdminController
{
    //允许上传文件类型
    protected static $FILE_ALLOW_MIME = [
        'image/gif'     => '.gif',
        'image/jpeg'    => '.jpeg',
        'image/png'     => '.png',
        'image/webp'    => '.webp',
        'video/mpeg'    => '.mpeg',
        'video/x-msvideo' => '.mp3',
        'text/plain'    => '.txt',
        'text/rtf'      => '.rtf',
        'application/vnd.ms-excel' => '.xls', //xls
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => '.xlsx', //xlsx
        'application/mspowerpoint' => '.ppt', //ppt
        'application/pdf'   => '.pdf', //pdf 
        'application/msword' => '.doc', ///doc
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx', //docx
        
    ];
    /**
     * 上传单个多个文件
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function upload()
    {
            $Files = $this->request()->getUploadedFiles();
            $data = [];
            foreach ($Files as $key => $File) {
                # code...
                try {
                    //code...
                    if(in_array($File->getClientMediaType(), array_keys(self::$FILE_ALLOW_MIME))){
                        $base_path = '/uploads/admin/' . md5($File->getTempName() . time()) . self::$FILE_ALLOW_MIME[$File->getClientMediaType()];
                        $targefile = WEB_STATIC_PATH .  $base_path ;
                        if(false === $File->moveTo($targefile)){
                            $this->writeJson(Status::CODE_ERR, lang("request_error"));
                            break;
                        }
                        $data[] = ['id' => time(), 'url' => $base_path];
                    }else{
                        $this->writeJson(Status::CODE_UPLOAD_EXT_FAIL, lang("request_upload_ext_fail"));
                        break;
                        return;
                    }
                //     file_put_contents(UPLOAD_FILE_PATH . $File->getClientFilename() . ".jpg", $File->getStream());
                   //$result = $File->moveTo(UPLOAD_FILE_PATH . ".jpg");
                    
                //    var_dump($result, $File->getError(), UPLOAD_FILE_PATH);
                } catch (\Throwable $th) {
                    //throw $th;
                    $this->writeJson(Status::CODE_SYS_ERR, lang("request_error"));
                    return;
                    break;
                }
                //file_put_contents("./" . $File->getClientFilename() . ".jpg", $File->getStream());
                //var_dump($File->getTempName(),$File->getError(), $File->getSize(), $File->getClientFilename(), $File->getClientMediaType());
            }

            $this->writeJson(Status::CODE_OK, lang("request_success"), $data);
    }
}