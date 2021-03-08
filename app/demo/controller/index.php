<?php


namespace app\demo\controller;


use app\BaseController;
use app\common\lib\Snowflake;

class index extends BaseController
{
    function  index(){
        $node_id = rand(1, 1023);//随机数
        $id = Snowflake::getInstance()->setWorkId($node_id)->nextId();
        echo $id;
    }
}