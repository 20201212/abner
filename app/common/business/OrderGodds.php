<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/3/7 14:27
 */

namespace app\common\business;
use app\common\model\mysql\OrderGoods as OrderGoodsModel;

class OrderGodds extends BusBase
{
    public $model = NULL;
    public function __construct(){
        $this->model = new OrderGoodsModel();
    }


}