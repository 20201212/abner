<?php
/**
 * Explanation:记住登录失效时间
 * Author: Abner
 * Time: 2021/1/3 21:24
 */

namespace app\common\lib;
class Time
{
    public static function userLoginExpiresTime($type = 2) {
        $type = !in_array($type, [1,2]) ? 2 : $type;
        if($type = 1) {
            $day = $type * 7;
        } elseif($type == 2) {
            $day = $type * 30;
        }
        return $day * 24 * 3600;
    }
}