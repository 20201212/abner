<?php
/**
 * 错误控制器
 */

namespace app\controller;

class Error
{
    public function __call($name, $arguments)
    {

        return show(config('status.notFound'),"该控{$name}制器不存在!");
    }

}