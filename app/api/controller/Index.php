<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/2/13 14:52
 */

namespace app\api\controller;
use app\common\business\Goods as GoodsBis;
use app\common\lib\Show;
class Index extends ApiBase
{
    public function getRotationChart(){
        $result = (new GoodsBis())->getRotationChart();
        return Show::success($result);
    }
    public function cagegoryGoodsRecommend(){
        $categoryIds = [48,40];
        $result = (new GoodsBis())->cagegoryGoodsRecommend($categoryIds);
        return Show::success($result);
    }


}