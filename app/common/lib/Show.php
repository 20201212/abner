<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/2/13 16:11
 */

namespace app\common\lib;
class Show
{
    public static function success($data=[], $message= 'OK'){

        $result = [
            'status'    => config('status.success'),
            'msg'   => $message,
            'result'    => $data,
        ];
        return json($result);
    }

    public static function error($message= 'error', $status = 0,$data=[]){
        $result = [
            'status'    => $status,
            'msg'   => $message,
            'result'    => $data,
        ];
        return json($result);
    }

}