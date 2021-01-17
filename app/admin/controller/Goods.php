<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/10 21:48
 */

namespace app\admin\controller;
use app\common\business\Goods as GoodsBis;
class Goods extends AdminBase
{
    public function index(){
        return view();
    }

    public function add(){
        return view();
    }

    public function save(){
        if(!$this->request->isPost()){
            return show(config('status.error'), '参数不合法');
        }
        $data = input('param.');
        try {
            $res = ( new GoodsBis() )->insertData($data);
        } catch( \Exception $e ){
            return show(config('status.error'), $e->getMessage());
        }
        if(!$res) {
            return show(config('status.error'), '新增商品失败');
        }

        return show(config('status.success'), '添加成功');


    }

}