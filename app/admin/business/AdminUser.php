<?php


namespace app\admin\business;


use think\Exception;

class AdminUser
{
    public static  function login($data){

        try {
            $adminUser = self::getAdminUserByUsername($data['username']);
            if(empty($adminUser))
                throw new Exception('账户不存在！');

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

        }catch(\Exception $e){
            $errorData = [
                'msg'=>$e->getMessage(),
                'line'=>$e->getLine(),
                'file'=>$e->getFile(),
                'code'=>$e->getCode()
            ];
            $errorData = json_encode($errorData);
            \think\facade\Log::info("异常日志:{$errorData}");
            throw new Exception('内部异常');
        }

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