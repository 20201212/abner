<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 22:23
 */

namespace app\common\business;
use app\common\model\mysql\Goods as GoodsModel;
use app\common\business\GoodsSku as GoodsSkuBis;
use think\Exception;

class Goods extends BusBase
{
    public $model = null;
    public function __construct()
    {
        $this->model = new GoodsModel();
    }

    public function insertData($data){
        $goodsId  = $this->add($data);
        if(!$goodsId){
            return $goodsId;
        }
        if($data['goods_specs_type'] == 1) {
            $goodsSkuData = [
                'goods_id' => $goodsId,
            ];
            return true;
        }else if($data['goods_specs_type']  == 2 ) {
            $goodsSkuBisObj = new GoodsSkuBis();
            $data['goods_id'] = $goodsId;
            $res = $goodsSkuBisObj -> saveAll($data);
            if (!empty($res)) {
                $stock = array_sum(array_column($res), 'stock');
                $goodsUpdateData = [
                    'pirce'      => $res[0]['price'],
                    'cost_price' => $res[0]['cost_price'],
                    'stock'      => $stock,
                    'sku_id'     => $res[0]['id'],
                ];
                $goodsRes = $this->model->updateById($goodsId,$goodsUpdateData);
                if(!$goodsRes){
                    throw new Exception('goods主表更新失败');
                }

            } else {
                throw new Exception('sku表新增失败');
            }

        }
        return true;
    }

















}