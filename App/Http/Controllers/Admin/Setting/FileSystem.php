<?php
namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Admin\AdminController;

class FileSystem extends AdminController
{
    
    public function index()
    {
        return $this->render("admin.setting.custom_setting.index");
    }
}