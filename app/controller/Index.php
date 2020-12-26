<?php
namespace app\controller;

use app\BaseController;
use think\Request;
class Index extends BaseController
{
    public function index()
    {
        echo 'ddd';

    }


    function test1(Request $request){


        echo "token没有错！！";

    }

    function demo(){
        return 'demo';
    }


}
