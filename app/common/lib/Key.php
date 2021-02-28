<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/2/28 14:31
 */

namespace app\common\lib;
class Key
{
    public static function userCart($userId){
        return config('redis.cart_pre').$userId;
    }
}