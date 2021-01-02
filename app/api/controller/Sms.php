<?php
namespace app\api\controller;
use app\BaseController;
use think\exception\ValidateException;
use app\common\business\Sms as SmsBus;

class Sms extends BaseController
{
    public function code(){
        $phoneNumber = input('param.phone_number');
        $data = [
            'phone_number'  => $phoneNumber,
        ];
        try {
            validate(\app\api\validate\User::class)->scene('send_code')->check($data);
        } catch (ValidateException $e){
            return show(config('status.error'), $e->getError());
        }

        if(SmsBus::sendCode( $phoneNumber,6)) {
            return show(config('status.success'), '发送验证码成功');
        }
        return show(config('status.error'), '发送验证码失败');
    }




















}