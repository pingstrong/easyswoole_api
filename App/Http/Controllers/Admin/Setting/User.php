<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Admin\AdminController;

class User extends AdminController
{
    public function index()
    {
        $this->render('admin.setting.user.index');
    }
}
