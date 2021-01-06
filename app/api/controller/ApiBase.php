<?php
/**
 * Explanation: 不登录时api基类
 * Author: Abner
 * Time: 2021/1/3 22:11
 */

namespace app\api\controller;
use app\BaseController;
use think\exception\HttpResponseException;

class ApiBase extends BaseController
{

    public function show(...$args){
        throw new HttpResponseException(show(...$args));
    }

}