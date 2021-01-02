<?php


namespace app\api\controller;


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

        return show(config('status.error'), '登录失败');






    }














}