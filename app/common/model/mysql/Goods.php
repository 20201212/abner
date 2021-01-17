<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 22:25
 */

namespace app\common\model\mysql;
use think\Model;

class Goods extends Model
{
    protected $autoWriteTimestamp = true;

    public function updateById($id,$data){
        $data['update_time'] = time();
        return $this->where(['id'=>$id])->save($data);
    }
}