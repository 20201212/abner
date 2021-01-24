<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 20:54
 */

namespace app\common\business;
use think\facade\Log;
class BusBase
{
    public function add($data){
        $data['status'] = config('status.mysql.table_normal');
        try {
            $this->model->save($data);
        } catch ( \Exception $e ){
            Log::error($e->getMessage());
            return false;
        }
        return $this->model->id;
    }



}