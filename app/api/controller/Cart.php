<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/2/17 20:13
 */

namespace app\api\controller;

use app\common\lib\Show;
use app\common\business\Cart as CartBis;
class Cart extends AuthBase
{
    public function add(){
//        if(!$this->request->isPost()){
//            return Show::error([],'请求方式错误');
//        }
        $id = input('param.id', 0, 'intval');
        $num = input('param.num', 0, 'intval');
        if(!$id || !$num){
            return Show::error([], '参数不合法');
        }
        $res = (new CartBis())->insertRedis($this->userId,$id,$num);
        if($res === false){
            return Show::error();
        }
        return Show::success();
    }

    public function lists(){
        $res = (new CartBis())->lists($this->userId);

        if($res == FALSE){
            return Show::error();
        }
        return Show::success($res);
    }

    public function delete(){
        if(!$this->request->isPost()){
//            return Show::error();
        }
        $id = input('param.id', 0, 'intval');
        if(!$id) {
            return Show::error([],'参数不合法');
        }
        $res = (new CartBis())->deleteRedis($this->userId,$id);
        if($res == FAlSE) {
            return Show::error();
        }
        return Show::success($res);
    }

    public function update(){
        if(!$this->request->isPost()){
//            return Show::error();
        }

        $id = input('param.id', 0, 'intval');
        $num = input('param.num', 0, 'intval');
        if(!$id || !$num ){
            return Show::error([],'参数不合法!');
        }

        try{
            $res = (new CartBis()) ->updateRedis($this->userId, $id, $num);
        }catch (\think\Exception $e) {
            return Show::error([], $e->getMessage());
        }
        if($res === FALSE ){
            return Show::error();
        }
        return Show::success($res);
    }










}