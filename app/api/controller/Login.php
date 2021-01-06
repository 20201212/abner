<?php


namespace app\api\controller;
use \app\BaseController;

class Login extends BaseController
{
    public function index(){
        $phone = $this->request->param('phone');
        $code = input('param.code', 0, 'intval');
        $type = input('param.type', 0, 'intval');
        $data = [
            'phone' => $phone,
            'code'  => $code,
            'type'  => $type,
        ];
        $validate = new \app\api\validate\User();
        if( !$validate ->scene('login')->check($data) ){
            return show(config('status.error'), $validate->getError());
        }
        $restul = (new \app\common\business\User()) -> login($data);
        if($restul){
            return show(config('status.success'), '登录成功!', $restul);
        }

        return show(config('status.error'), '登录失败');

    }
















}