<?php


namespace app\common\lib\sms;


interface SmsBase
{
    public static function sendCode($phone,$code);

}