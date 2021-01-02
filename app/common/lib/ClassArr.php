<?php


namespace app\common\lib;


class ClassArr
{
    public static function smsClassStat(){
        return [
            'ali'   => 'app\common\lib\sms\AliSms',
            'baidu' => 'app\common\lib\sms\BaiduSms',
        ];
    }



    public static function initClass($type, $class, $params = [],$needInstance = false ){
        if(!array_key_exists($type, $class)) {
            return false;
        }
        $className = $class[$type];
        return $needInstance == true ? (new \ReflectionClass($className)) ->newInstanceArgs($params) : $className;

    }

}