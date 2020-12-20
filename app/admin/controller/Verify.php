<?php


namespace app\admin\controller;
use app\BaseController;
use think\captcha\facade\Captcha;

class Verify extends BaseController
{
    public function index(){

        return Captcha::create();
    }
}