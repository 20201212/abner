<?php
namespace app\common\model\mysql;
use think\Model;

class AdminUser extends Model
{
    public function getAdminUserByUsername($username){
        if(empty($username)) return false;

        $where = [
            'username'  => trim($username),
            'status'    =>1,
        ];

        return $this->where($where)->find();
    }

    public function updateById($uid,$data){
        return $this->where('id',$uid)->save($data);
    }
}