<?php
/**
 * Explanation: 登录集成的pai
 * Author: Abner
 * Time: 2021/1/3 22:13
 */

namespace app\api\controller;
class AuthBase extends ApiBase
{
    public $accessToken = '';
    public $userId = 0;
    public $username = '';
    public function initialize()
    {
        parent::initialize();
        $this->accessToken = $this->request->header('access-token');
        if( !$this->accessToken || !$this->isLogin() ){

           return  $this->show('status.not_login', '请先登录！');

        }

    }

    public function isLogin(){
        $userInfo = cache(config('redis.token_pre').$this->accessToken);
        if(!$userInfo) return false;
        if(!empty($userInfo['id']) && !empty($userInfo['username'])) {
            $this->userId = $userInfo['id'];
            $this->username = $userInfo['username'];
            return true;
        }
        return false;

    }

}