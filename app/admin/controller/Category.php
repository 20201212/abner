<?php
/**
 * Explanation: 分类控制器
 * Author: Abner
 * Time: 2021/1/7 20:11
 */

namespace app\admin\controller;
use app\admin\validate\AdminUser;
use app\Request;
use app\common\business\Category as CategoryBus;

class Category extends AdminUser
{
    function index(){
        $pid = input('param.pid', 0, 'intval');
        $data = [
            'pid' =>$pid,
        ];
        $categorys = (new CategoryBus()) -> getLists($data, 5);

        if(!$categorys){
            return $categorys=[];
        }
//        halt($categorys);
        return view('',['lists' => $categorys]);

    }

    public function add(){
        try {
            $categorys = (new CategoryBus()) -> getNormalCategorys();
        } catch (\Exception $e){
            $categorys = [];
        }
        $categorys = (new CategoryBus()) -> getNormalCategorys();
        $categorys = json_encode($categorys,true);

        return view('',['categorys'=>$categorys]);
    }

    public function save(Request $request){
        $params = $request->param();
        $validate = new \app\admin\validate\Category();
        if(!$validate ->scene('save')->check($params)) {
            return show(config('status.error'), $validate->getError());
        }


        try {
            $request = (new CategoryBus() ) ->add($params);
        } catch (\Exception $e) {
            return show(config('status.error'), $e->getMessage());
        }

        return show(config('status.success'), 'OK');

    }

    /**
     * Explanation：更新分类排序
     * Author: Abner
     * Time: 2021/1/10 1:06
     * @return \think\response\Json
     * @throws \think\Exception
     */
    public function listorder(){
        $id = input('param.id', '', 'intval');
        $listorder = input('param.listorder', 0, 'intval');
        $data = [
            'id' =>$id,
        ];

        $validate = new \app\admin\validate\Category();
        if(!$validate->scene('listorder')->check($data)){
            return show(config('status.error'), $validate->getError());
        }
        $res = (new CategoryBus())->listorder($id,$listorder);

        try{
            $res = (new CategoryBus())->listorder($id,$listorder);
        }catch (\Exception $e){
            return show(config('status.error'), '排序失败！');
        }
        if(!$res){
            return show(config('status.succes'), '排序成功！');
        } else{
            return show(config('status.error'), '排序失败！');
        }
    }

    public function status(){
        $stauts = input('param.status',0, 'intval');
        $id = input('param.id', '', 'intval');
        $data = [
            'status' =>$stauts,
            'id'     => $id,
        ];

        $validate = new \app\admin\validate\Category();
        if(!$validate ->scene('status')->check($data)){
            return show(config('status.error'),$validate->getError());
        }
        try {
            $res = (new CategoryBus())->status($id,$stauts);
        }catch (\Exception $e){
            return show(config('status.error'), $e->getMessage());
        }
        if($res){
            return show(config('status.success'), '更新成功');
        }else{
            return show(config('status.error'), '更新失败');
        }

    }

    public function dialog(){
        $categorys = (new CategoryBus())->getNormalByPid();
        return show(config('status.success'), 'ok', $categorys);
    }

    public function getByPid(){
        $pid  = input('param.pid', 0, 'intval');
        $categorys = (new CategoryBus()) ->getNormalByPid($pid);
        return show(config('status.success'), 'ok', $categorys);
    }

}