<?php
namespace app\controller;

use app\BaseController;
use think\Request;
class Index extends BaseController
{
    public function index()
    {
        halt(config('cache.default'));
        $data['code'] = '2345';
//        return  json($data);

    }


    function test1(Request $request){


        echo "token没有错！！";

    }

    function demo(){
        return 'demo';
    }


}
