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
                'specs_value_ids'                   => $value['propvalnames']['propvalids'],
                'price'                             => $value['propvalnames']['skuSellPrice'],
                'cost_price'                        => $value['propvalnames']['skuMarketPrice'],
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

    public function getNormalSkuAndGoods($id){
        $result = $this->model->with('goods')->find($id);
        if(!$result)
        {
            return [];
        }
        $result = $result->toArray();
        if($result['status'] != config('status.mysql.table_normal'));
        return $result;

    }
    public function getSkusByGoodsId($goodsId = 0){
        if(!$goodsId){
            return [];
        }
        try {
            $skus = $this->model->getNormalByGoodsId($goodsId);
        }catch (\Exception $e){
            return [];
        }
        return $skus->toArray();
    }




}