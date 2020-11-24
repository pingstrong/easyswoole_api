<?php
namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\AdminController;

class Statistics extends AdminController
{

    public function index()
    {
        return $this->render("admin.product.statistics.index", []);
    }
}