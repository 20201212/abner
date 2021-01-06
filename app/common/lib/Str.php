<?php
/**
 * Explanation: 所有的字符串处理类
 * Author: Abner
 * Time: 2021/1/3 20:57
 */

namespace app\common\lib;
class Str
{
    public static function getLoginToken($string) {
        $str = md5(uniqid(md5(microtime(true), true)));
        $token = sha1($str.$string);
        return $token;
    }

}