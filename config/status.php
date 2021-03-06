<?php
/**
 * 业务状态码
 */
return [
    'success'       =>200,//请求成功
    'error'         =>500,//通用错误状态码
    'badRequest'    =>400,//客户端错误
    'unauthorized'  =>401,//未认证
    'forbidden'     =>403,//服务器已经理解请求，但是拒绝执行它
    'notFound'      => 404,// 请求的不存在


    'mysql'=>[
        'table_normal'  => 1,
        'table_delete'  => 99,
    ],
    'not_login' => 201,//登录失败


];