<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/6 22:03
 */

namespace app\api\controller;
class logout extends AuthBase
{
    public function index(){
        $res = cache(config('redis.token_pre').$this->accessToken, null);
        if($res){
            return show(config('status.success'), '退出成功!');
        }
        return show(config('status.error'),'退出登录失败!');
    }
}