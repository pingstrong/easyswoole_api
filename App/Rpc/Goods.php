<?php
namespace App\RpcService;

use EasySwoole\Rpc\AbstractService;

class Goods extends AbstractService
{

    /**
     *  重写onRequest(比如可以对方法做ip拦截或其它前置操作)
     *
     * @param string $action
     * @return bool
     * CreateTime: 2020/6/20 下午11:12
     */
    protected function onRequest(?string $action): ?bool
    {
        return true;
    }

    public function serviceName(): string
    {
        return 'goods';
    }

    public function list()
    {
        $this->response()->setResult([
            [
                'goodsId'=>'100001',
                'goodsName'=>'商品1',
                'prices'=>1124
            ],
            [
                'goodsId'=>'100002',
                'goodsName'=>'商品2',
                'prices'=>599
            ]
        ]);
        $this->response()->setMsg('get goods list success');
    }
}