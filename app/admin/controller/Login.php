<?php
namespace app\admin\controller;

class Login extends AdminBase
{

    public function index(){

//          halt(md5(md5('Abnerabner').'abner'));
        dump(session());
//        return View::fetch();
    }

    public function check(){
        if(!$this->request->isPost())
            return show(config('status.error'), '请求方式错误！');
        $params = $this->request->param();
        $validate = new \app\admin\validate\AdminUser();
        if(!$validate->check($params))
            return show(config('status.error'), $validate->getError());


        $result = \app\admin\business\AdminUser::login($params);
        if($result){
            return show(config('status.success'), '登录成功！');
        }else{
            return show(config('status.error'), '登录失败');
        }

    }


    public function logout(){
        session(config('admin.session_admin'),null);

        return redirect(url('login/index'));
    }










}