<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 22:28
 */

namespace app\common\business;
use app\common\model\mysql\GoodsSku as GoodsSkuModel;
use think\facade\Log;

class GoodsSku extends  BusBase
{
    public $model = null;
    public function __construct()
    {
        $this->model = new GoodsSkuModel();
    }
    public function saveAll($data){
        if(!$data['skus']) return false;
        foreach($data['skus'] as $value ) {
            $insertData[] = [
                'goods_id'                          => $data['goods_id'],
                'specs_values_ids'   => $value['provalnames']['propvalids'],
                'price'                             => $value['propvalnames']['skuSellPrice'],
                'stock'                             => $value['propvalnames']['skuStock'],
            ];
        }
        try {
            $result = $this->model->saveAll($insertData);
            return $result->toArray();
        } catch(\Exception $e ){
            Log::error($e->getMessage());
            return false;
        }

        return true;
    }






}