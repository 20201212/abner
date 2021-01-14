<?php
namespace app\controller;

use app\BaseController;
use think\Request;
class Index extends BaseController
{
    public function index()
    {

        for ($i=0; $i<100; $i++) {
            echo $i.'<br/>';
        }
        echo $i;

         phpinfo();

//        return  json($data);

    }


    function test1(Request $request){


        echo "token没有错！！";

    }

    function demo(){
        return 'demo';
    }


}
