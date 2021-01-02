<?php


namespace app\common\business;
use app\common\lib\ClassArr;
use app\common\lib\Num;

class Sms
{
    public static function sendCode($phone,$leg, $type='ali'){
        $code = Num::getCode($leg);
        $classStats = ClassArr::smsClassStat();
        $classObj = ClassArr::initClass($type, $classStats);
        $sms =  $classObj::sendCode($phone, $code);
//        if($sms['Code'] === 'OK'){
        if($sms){
            cache(config('redis.code_pre').$phone, $code, config('redis.code_expire'));
            return true;
        }
        return false;
    }
}