<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 17:12
 */

namespace app\admin\controller;
use app\common\business\SpecsValue as SpecsValueBis;
class SpecsValue extends AdminBase
{
    public function save(){
        $specsId = input('param.specs_id', 0, 'intval');
        $name = input('param.name', '', 'trim');
        $data = [
            'specs_id' => $specsId,
            'name'     => $name,
        ];
        $id = ( new SpecsValueBis() ) ->add($data);
        if(!$id) {
            return show(config('status.error'), '新增失败');
        }
        return show(config('status.success'),'OK', ['id'=>$id]);

    }

    /**
     * Explanation：根据规格id获取规格的值
     * Author: Abner
     * Time: 2021/1/16 20:38
     * @return \think\response\Json
     */
    public function getBySpecsId(){
        $specsId = input('param.specs_id', 0, 'intval');
        if(!$specsId) {
            return show(config('status.success'), '没有数据');
        }
        $result = ( new SpecsValueBis() ) -> getBySpecsId($specsId);
        return show(config('status.success'), 'OK', $result);

    }

    public function status(){
        $stauts = input('param.status',0, 'intval');
        $specsId = input('param.specs_id', '', 'intval');
        if(!$specsId) {
            return show(config('status.success'), '没有数据');
        }
        try {
            $res = ( new SpecsValueBis() )->status($specsId,$stauts);
        }catch (\Exception $e){
            return show(config('status.error'), $e->getMessage());
        }
        if($res){
            return show(config('status.success'), '删除成功');
        }else{
            return show(config('status.error'), '删除失败');
        }

    }
}