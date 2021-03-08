<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/3/6 23:38
 */

namespace app\common\business;

use app\common\lib\Snowflake;
use app\common\model\mysql\Order as OrderModel;
class Order extends BusBase
{
    public $model = NULL;
    public function __construct(){
        $this->model = new OrderModel();
    }

    public function save($data){
        $workId = rand(1,1023);
        $orderId = Snowflake::getInstance()->setWorkId($workId)->id();
        $result = (new Cart())->lists($data['user_id'],$data['ids']);
        if(!$result){
            return false;
        }
        $newResutl = array_map(function ($v) use($orderId){
            $v['sku_id'] = $v['id'];
            unset($v['id']);
            $v['order_id'] = $orderId;
            return $v;
        },$result);
        $price = array_sum(array_column($result,'total_price'));
        $orderData = [
            'user_id'       => $data['user_id'],
            'order_id'      => $orderId,
            'total_price'   => $price,
            'address_id'    => $data['address_id'],
        ];

        $this->model->startTrans();
        try {
            $id = $this->add($orderData);
            if(!$id) {
                return 0;
            }
            $orderGoodsResult=  $this->model->saveAll($newResutl);
            $this->model->commit();
            return true;
        }catch (\Exception $e){
            $this->model->rollback();
            return false;
        }

    }
}