<?php
namespace app\admin\validate;
use think\Validate;

class AdminUser extends  Validate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'captcha'  =>  'require|checkCaptcha',
    ];

    protected $message = [
        'username'  => '账号不能为空',
        'passwrod'  => '密码不能为空！',
        'captcha'   => '验证码不能为空',
    ];

    protected  function checkCaptcha($value, $rule, $data=[]){
        if(!captcha_check($value))
            return '验证码错误！';
        return true;
    }


}