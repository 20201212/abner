<?php
/**
 * Explanation: api前端分类
 * Author: Abner
 * Time: 2021/1/10 17:09
 */

namespace app\api\controller;
use app\common\business\Category as CategoryBis;
class Category extends  ApiBase
{
    public function index(){
        try {
            $categoryBusObj = new CategoryBis();
            $categorys = $categoryBusObj->getNormalAllCategorys();
        } catch (\Exception $e ){
            return show(config('status.success'), 'ok');
        }


        $result = \app\common\lib\Arr::getTree($categorys);
        $result = \app\common\lib\Arr::sliceTreeArr($result,1,3,3);
        halt($data);



    }
}