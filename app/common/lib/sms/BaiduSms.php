<?php


namespace app\common\lib\sms;


class BaiduSms implements SmsBase
{
    public static function sendCode($phone,$code){
        return true;
    }
}