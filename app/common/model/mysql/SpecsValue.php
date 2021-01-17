<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 20:04
 */

namespace app\common\model\mysql;
use think\Model;

class SpecsValue extends  Model
{
    public function getNormalBySpecsId($specsId, $field){
        $where = [
            'specs_id'      => $specsId,
            'status'        => config('status.mysql.table_normal'),
        ];
        $res = $this->where($where)
            ->field($field)
//            ->fetchSql()
            ->select();
        return $res;

    }

}