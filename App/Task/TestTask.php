<?php
namespace App\Task;

use EasySwoole\Task\AbstractInterface\TaskInterface;
/**
 * test
 *
 * @author pingo
 * @created_at 00-00-00
 */
class TestTask implements TaskInterface
{
    protected $data;
    //通过构造函数,传入数据,获取该次任务的数据
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     *   执行入口
     * 
     *   投递返回值
     *  大于0 投递成功(异步任务专属,返回taskId,同步任务直接返回return值)
     *   -1 task进程繁忙,投递失败(已经到达最大运行数量maxRunningNum)
     *   -2 投递数据解包失败,当投递数据传输时数据异常时会报错,此错误为组件底层错误,一般不会出现
     *   -3 任务出错(该任务执行时出现异常错误,被组件拦截并输出错误)
     * 
     * @author pingo
     * @created_at 00-00-00
     * @param integer $taskId
     * @param integer $workerIndex
     * @return void
     */
    function run(int $taskId, int $workerIndex)
    {
        var_dump("模板任务运行");
        var_dump($this->data, $workerIndex);
        //只有同步调用才能返回数据
        return "返回值:".$this->data['name'];
        // TODO: Implement run() method.
    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        // TODO: Implement onException() method.
    }
}