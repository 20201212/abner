<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 19:58
 */

namespace app\common\business;
use app\common\model\mysql\SpecsValue as SpecsValueModel;
use think\facade\Log;

class SpecsValue extends BusBase
{
    public $model = null;
    public function __construct()
    {
        $this->model = new SpecsValueModel();
    }




    public function getBySpecsId($specsId) {
        try {
            $result = $this->model ->getNormalBySpecsId($specsId, 'id,name');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
        return $result = $result->toArray();

    }

    public function status($id,$status){
        $result = $this->model->find($id);
        if(!$result){
            throw new \think\Exception('该条记录不存在！');
        }
        if($result['status'] == $status) {
            throw new \think\Exception('该记录已经被删除了');
        }
        $data = [
            'status'        => intval($status),
            'update_time'   => time(),
        ];
        try {
            $res = $this->model->updateById($id,$data);
        } catch (\Exception $e){
            return false;
        }
        return $res;

    }

    public function dealGoodsSkus($gids, $flagValue){
        $specsValueKeys = array_keys($gids);
        foreach ($specsValueKeys as $specsValueKey){
            $specsValueKey = explode(',', $specsValueKey);
            foreach ($specsValueKey as $k=>$v) {
                $new[$k][] = $v;
                $specsValueIds[] = $v;
            }
        }
        $specsValueIds = array_unique($specsValueIds);

        $specsValues = $this->getNormalInIds($specsValueIds);
        $flagValue = explode(',', $flagValue);
        foreach($new as $key =>$newValue){
            $newValue = array_unique($newValue);
            $list = [];
            foreach($newValue as $vv){
                $list[] = [
                    'id'    => $vv,
                    'name'  => $specsValues[$vv]['name'],
                    'flag'  => in_array($vv, $flagValue) ? 1 : 0,
                ];
            }
            $result[$key] = [
                'name'  => $specsValues[$newValue[0]]['specs_name'],
                'list' => $list,
            ];
        }

        return $result;

    }

    public function getNormalInIds($ids){
        if(!$ids) return [];
        try {
            $result = $this->model->getNormalInIds($ids);
        }catch (\Exception $e){
            return [];
        }
        $result = $result->toArray();
        if(!$result) return [];
        //规格
        $specsNames = config('specs');
        $specsNamesArrs = array_column($specsNames, 'name', 'id');
        $res = [];
        foreach ($result as $resultValue){
            $res[$resultValue['id']] = [
                'name'          => $resultValue['name'],
                'specs_name'    => $specsNamesArrs[$resultValue['specs_id']] ?? '',
            ];
        }

        return $res;
    }

}