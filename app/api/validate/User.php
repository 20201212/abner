<?php


namespace app\api\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username'      => 'require',
        'phone'         => 'require',
        'code'          => 'require|number|min:4',
        'ltype'         => ['require', 'in'=>'1,2'],
        'sex'           => ['require', 'in'=>'0,1,2'],
    ];

    protected $message = [
        'username'      => '用户名必须填写',
        'phone'         => '手机号不能为空',
        'code.require'  => '验证码不能为空',
        'code.number'   => '验证码必须为数字',
        'code.min'      => '验证码长度不能少于位',
        'ltype.require' => '类型必须是指定的类型',
        'ltype.in'      => '类型数值错误！',
        'sex.require'   => '性别必须填写',
        'sex.in'        => '性别类型错误',
    ];

    protected $scene = [
        'send_code'     => ['phone_number'],
        'login'         => ['phone', 'code','type'],
        'update_user'         => ['username', 'sex'],
    ];



























}