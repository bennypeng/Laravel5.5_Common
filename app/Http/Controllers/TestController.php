<?php

namespace App\Http\Controllers;
use App\Contracts\HelperContract;
use App\Events\TestEvent;
use App\Tasks\TestTask;
use Hhxsv5\LaravelS\Swoole\Task\Event;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    protected $helper;

    //  依赖注入
    public function __construct(HelperContract $helper)
    {
        $this->helper = $helper;
    }

    public function test1() {
        return $this->helper->getNextFifteenTs();
    }

    //  绑定在单例上
    public function test2() {
        $helper = App::make('helper');
        return $helper->getNextFifteenTs();
    }

    //  异步处理事件
    public function test3() {
        $success = Event::fire(new TestEvent('event test data'));
        return $success ? "ok" : "fail";
    }

    //  投放任务
    public function test4() {
        $task = new TestTask("task 1 data");
        $ret = Task::deliver($task);
        return json_encode($ret);
    }

    public function test5() {
        $swoole = app('swoole');
        return json_encode($swoole->stats());
    }

    public function test6() {
        $a = DB::select("select * from users where id=1");
        return response()->json($a);
    }

}
