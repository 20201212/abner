<?php


namespace app\admin\business;


use think\Exception;

class AdminUser
{
    public static  function login($data){
            $adminUser = self::getAdminUserByUsername($data['username']);
            if(!$adminUser)
            {
                throw new Exception('账户不存在！');
            }
            halt($adminUser);
            $salf =$adminUser->salf;
            $password = md5(md5($data['password'].$salf).$salf);
            if($adminUser->password != $password)
                throw new Exception('密码错误！');

            $data  = [
                'last_login_ip'     =>request()->ip(),
                'last_login_time'   => time(),
                'update_time'       => time(),
            ];
            $adminUserObj = new \app\common\model\mysql\AdminUser();
            $res = $adminUserObj->updateById($adminUser['id'],$data);
            if(empty($res)){
                throw new Exception('登录失败！');
            }
            session(config('admin.session_admin'), $adminUser);
            return true;



    }

    /**
     * @param $username
     * @return array|false|\think\Model
     */
    public static function getAdminUserByUsername($username){
        $adminUserObj = new \app\common\model\mysql\AdminUser();
        $adminUser = $adminUserObj->getAdminUserByUsername($username);
        if(empty($adminUser))
            return false;
        return $adminUser;
    }
}