<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/3 22:15
 */

namespace app\api\controller;
use app\common\business\User as UserBis;
class User extends AuthBase
{
    public function index(){
        $user = (new UserBis()) ->getNormalUserById($this->userId);
        return show(config('status.succes'), 'OK', $user);
    }

    public function update() {
        $username = input('param.username', '', 'trim');
        $sex = input('param.sex', 0, 'intval');
        $data = [
            'username'  => $username,
            'sex'       => $sex,
        ];

        $validate = ( new \app\api\validate\User() ) -> scene('update_user');
        if(!$validate -> check($data)) {
            return show(config('status.error'), $validate->getError() );
        }
        $userBisObj = new UserBis();
        $user = $userBisObj->update($this->userId,$data);
        if(!$user) {
            return show(config('status.error'), '更新失败');
        }
        return show('status.success','ok');


    }

}