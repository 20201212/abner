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
        $data = [];
        $title = input('param.title', '', 'trim');
        $time = input('param.time', '', 'trim');
        if(!empty($title)) $data['title'] = $title;
        if(!empty($time)) $data['time'] = explode(' - ', $time);
        $goods = ( new GoodsBis )->getlistS($data,5);
        return view('', ['goods'=>$goods]);
    }

    public function add(){
        return view();
    }

    public function save(){
        if(!$this->request->isPost()){
            return show(config('status.error'), '参数不合法');
        }
        $data = input('param.');
        $check = $this->request->checkToken('__token__');
//        if(!$check) {
//            return show(config('status.error'), '非法请求');
//        }
        $data['category_path_id'] = $data['category_id'];
        $result = explode(',', $data['category_path_id']);
        $data['category_id'] = end($result);

        $res = ( new GoodsBis() )->insertData($data);
        if(!$res) {
            return show(config('status.error'), '新增商品失败');
        }
        return show(config('status.success'), '添加成功');


    }

}