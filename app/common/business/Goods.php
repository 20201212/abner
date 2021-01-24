<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 22:23
 */

namespace app\common\business;
use app\common\lib\Arr;
use app\common\model\mysql\Goods as GoodsModel;
use app\common\business\GoodsSku as GoodsSkuBis;


class Goods extends BusBase
{
    public $model = null;
    public function __construct()
    {
        $this->model = new GoodsModel();
    }

    public function getlists($data, $num = 5){
        $likeKeys = [];
        if(!empty($data)) $likeKeys = array_keys($data);
        try {
            $list = $this->model->getLists($likeKeys, $data, $num);
            $result = $list->toArray();
        } catch(\Exception $e){
            $result = Arr::getPaginateDefaultData($num);
        }
        return $result;
    }

    /**
     * Explanation：商品入库
     * Author: Abner
     * Time: 2021/1/24 22:32
     * @param $data
     * @return bool|null
     */
    public function insertData($data){
        $this->model->startTrans();
        try {
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
                    $stock = array_sum(array_column($res,'stock'));
                    $goodsUpdateData = [
                        'price'      => $res[0]['price'],
                        'cost_price' => $res[0]['cost_price'],
                        'stock'      => $stock,
                        'sku_id'     => $res[0]['id'],
                    ];
                    $goodsRes = $this->model->updateById($goodsId,$goodsUpdateData);
                    if(!$goodsRes){
                        throw new \Exception('goods主表更新失败');
                    }

                } else {

                    throw new \Exception('sku表新增失败');
                }

            }
            $this->model->commit();
            return true;
        }catch (\Exception $e){
            $this->model->rollback();
            return false;
        }

    }

















}