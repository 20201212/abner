<?php
namespace app\common\business;

class User
{
    public $userObj = null;
    public function __construct()
    {
        $this->userObj = '';
    }

    public function login($data){
         $redisCodee = cache(config('redis.code_pre').$data['phone']);
         if(empty($redisCodee) || $redisCodee != $data['code']){
             throw new \think\Exception('验证码不存在！');
         }
    }
}