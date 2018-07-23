<?php

namespace App\Http\Controllers;
use App\Contracts\HelperContract;

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

}
