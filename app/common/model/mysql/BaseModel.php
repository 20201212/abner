<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/24 20:09
 */

namespace app\common\model\mysql;
use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;

    public function updateById($id,$data){
        $id = intval($id);
        if(empty($id) || empty($data)){
            return false;
        }
        return $this->where(['id'=>$id])->save($data);
    }

}