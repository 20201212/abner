<?php


namespace app\common\lib;


class Num
{
    public static function getCode($len=4){
        $code = rand(1000,9999);
        if($len == 6){
            $code = rand(100000,999999);
        }

        return $code;
    }
}