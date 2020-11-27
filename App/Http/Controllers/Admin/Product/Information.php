<?php
namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\AdminController;
use App\Service\Admin\Product\InformationService;
use App\Utility\Message\Status;

/**
 * 资讯文章控制器
 *
 * @author pingo
 * @created_at 00-00-00
 */
class Information extends AdminController
{
    /**
     * 展示页面
     *
     * @author pingo
     * @created_at 00-00-00
     * @return void
     */
    public function index()
    {
        return $this->render("admin.information.index");
    }

    public function query()
    {
        $searchParams = json_decode($this->request_get['searchParams'], true)?? [];
        $page = $this->request_get['page'] ?? 1;
        $limit = $this->request_get['limit'] ?? 10;

        $Service = InformationService::getInstance()->all($searchParams, $page, $limit,  "id");
        $this->writeJson($Service->getCode(), $Service->getMsg(), $Service->getData());
    }
    public function add()
    {

    }

    public function edit()
    {

    }
    public function setField()
    {
        
    }
    public function del()
    {
        
    }

}