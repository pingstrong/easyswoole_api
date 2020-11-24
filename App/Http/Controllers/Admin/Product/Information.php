<?php
namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\AdminController;
/**
 * 资讯文章控制器
 *
 * @author pingo
 * @created_at 00-00-00
 */
class Information extends AdminController
{
    public function index()
    {
        return $this->render("admin.information.index");
    }
    
}