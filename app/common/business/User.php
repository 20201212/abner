<?php
namespace app\common\business;

use app\common\lib\Str;
use app\common\lib\Time;
use app\common\model\mysql\User as UserModel;

class User
{
    public $userObj = null;
    public function __construct()
    {
        $this->userObj = new UserModel();
    }

    public function login($data){
         $redisCodee = cache(config('redis.code_pre').$data['phone']);
         if(empty($redisCodee) || $redisCodee != $data['code']){
//             throw new \think\Exception('验证码不存在！', config('status.notFound'));
         }
         $user = $this->userObj->getUserByPhone($data['phone']);


         if(!$user){
             $username = 'Abner-'.$data['phone'];
             $userData = [
                 'username' => $username,
                 'phone'    => $data['phone'],
                 'ltype'     => $data['type'],
                 'status'   => config('status.mysql.table_normal')
             ];
             try {
                 $this->userObj->save($userData);
                 $userId = $this->userObj->id;
             } catch ( \Exception $e ) {
                 throw new \think\Exception('数据库内容部错误！');
             }

         }  else {
             $user->last_time = time();
             $res = $user->save();
             $userId = $user->id;
             $username = $user->username;

         }
         $token = Str::getLoginToken($data['phone']);
         $redisData = [
             'id'       => $userId,
             'username' => $username,
         ];
         $res = cache( config('redis.token_pre').$token, $redisData, Time::userLoginExpiresTime($data['type']));
         return $res ? ['token'=>$token,'username'=>$username] : false;
    }

    public function getNormalUserById($id){
        $user = $this->userObj->getUserById($id);
        if(!$user || $user->status != config('status.mysql.table_normal')) {
            return [];
        }
        return $user->toArray();
    }

    public function update($id, $data){
        //检测用户是否存在
        $user =  $this->userObj->getUserById($id);
        if(!$user){
            throw new \think\Exception('该用户不存在！');
        }

        //检测用户名是否存在
        $userResult = $this->userObj->getNormalUserByUsername($data['username']);
        if($userResult && $userResult['id'] != $id){
            throw new \think\Exception('用户名已经存在！');

        }
        return $this->userObj->updateById($id,$data);

    }


}