<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 22:23
 */

namespace app\common\business;
use app\common\lib\Arr;
use app\common\lib\Show;
use app\common\model\mysql\Goods as GoodsModel;
use app\common\business\GoodsSku as GoodsSkuBis;
use app\common\business\SpecsValue as SpecsValueBis;
use think\facade\Cache;


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



    public function getRotationChart(){
        $data = [
            'is_index_recommend'    => 1,
        ];
        $field = 'sku_id as id ,title, big_image as image';
        try {
            $result = $this->model->getNormalGoodsByCondition($data,$field);
        }catch (\Exception $e) {
            return [];
        }
        return $result ->toArray();
    }

    public function cagegoryGoodsRecommend($categoryIds){
        if(!$categoryIds) return [];
        $result = [];
        foreach($categoryIds as $key=>$categoryId){
            $result[$key]['goods'] = $this->getNoramlGoodsFindInSetCategroyId($categoryId);
        }
        return $result;
    }

    public function getNoramlGoodsFindInSetCategroyId($categoryId){
        $field = 'sku_id as id, title, price, recommend_image as image';
        try {
            $result = $this->model->getNoramlGoodsFindInSetCategroyId($categoryId,$field);
        } catch (\Exception $e){
            return [];
        }
        return $result->toArray();

    }

    public function getNormalLists($data,$num=5,$order){
        try {
            $field = 'sku_id as id, title, recommend_image as image, price';
            $list = $this->model->getNormalLists($data, $num, $field,$order);
            $res = $list->toArray();
            $result = [
                'total_page_num'    => isset($res['last_page']) ? $res['last_page'] : 0,
                'count'             => isset($res['total']) ? $res['total'] : 0,
                'page'              => isset($res['current_page'])  ? $res['current_page'] : 0,
                'page_size'         => $num,
                'list'              => isset($res['data']) ? $res['data'] : [],
            ];
        }catch (\Exception $e) {
            echo $e->getMessage();exit;
            $result = [];
        }
        return $result;
    }

    public function getGoodsDetailBySkuId($skuId){
        //sku_Id sku表 => goods_id goods表=>title image description
        $skuBisObj = new GoodsSkuBis();
        //获取当前的sku的信息以及商品信息
        $goodsSku = $skuBisObj->getNormalSkuAndGoods($skuId);
        if(!$goodsSku) return [];
        if(empty($goodsSku['goods'])) return  [];
        $goods = $goodsSku['goods'];
        //根据商品id号获取该商品所有的sku的信息
        $skus = $skuBisObj->getSkusByGoodsId($goods['id']);
        if(!$skus) return [];
        $flagValue = '';
        //标识选中当前的sku的数据
        foreach ($skus as $sv){
            if($sv['id']  == $skuId) {
                $flagValue = $sv['specs_value_ids'];
            }
        }
        $gids = array_column($skus,'id','specs_value_ids');
        if($goods['goods_specs_type'] == 1){
            $sku = [];
        }else{
            $sku = (new SpecsValueBis())->dealGoodsSkus($gids, $flagValue);
        }


        $result = [
            'title'         => $goods['title'],
            'price'         => $goodsSku['price'],
            'cost_price'    => $goodsSku['cost_price'],
            'sales_count'   => 0,
            'stock'         => $goodsSku['stock'],
            'gids'          => $gids,
            'image'         => $goods['carousel_image'],
            'sku'           => $sku,
            'detail'        => [
                'd1'    => [
                        '商品编码'  => $goodsSku['id'],
                        '上架时间'  => $goods['create_time'],
                ],
                'd2'    => preg_replace('/(<img.+?src=")(.*?)/', '$1'.request()->domain().'$2', $goods['description']),

            ],
        ];
        Cache::inc('mall_pv_'.$goods['id']);
        return $result;
    }











}