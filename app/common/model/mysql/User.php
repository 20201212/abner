<?php
/**
 *  前台登录
 * Author Abner
 * Date 2021/1/2   22:17
 */


namespace app\common\model\mysql;

class User extends BaseModel
{
    protected $autoWriteTimestamp = true;

    /**
     * Explanation：根据手机号获取用户信息
     * Author: Abner
     * Time: 2021/1/3 23:22
     * @param $phone
     * @return array|false|Model|null
     */
    public function getUserByPhone($phone){
        if(empty($phone)) return false;
        $where = [
            'phone'  => trim($phone),
            'status'    =>1,
        ];
        return $this->where($where)->find();
    }

    public function getUserById($id){
        $id = intval($id);
        if(!$id) return false;
        return $this->field('id,username,sex,status')->find($id);
    }

    /**
     * Explanation：根据用户查询用户是否存在
     * Author: Abner
     * Time: 2021/1/6 21:21
     * @param $username
     * @return array|false|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getNormalUserByUsername($username){
        $res = $this->where('username',$username)->find();
//        halt($res);
        if(empty($res)){
            return false;
        }
        return $res;
    }





}