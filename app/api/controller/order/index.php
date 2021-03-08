<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/3/6 23:34
 */

namespace app\api\controller\order;
use app\api\controller\AuthBase;
use app\common\lib\Show;
use app\common\business\Order;


class index extends AuthBase
{
    public function save(){
        $addressId = input('param.address_id', 0, 'intval');
        $ids = input('param.ids', '', 'trim');
        if(!$addressId || !$ids){
            return Show::error('参数错误！');
        }
        $data = [
            'ids'           => $ids,
            'address_id'    => $addressId,
            'user_id'       => $this->userId,
        ];
        try {
            $result = (new Order())->save($data);
        }catch(\Exception $e){
            return Show::error('提交订单失败，请稍后重试！');
        }
        return Show::success($result);

    }














}