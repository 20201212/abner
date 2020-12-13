<?php
namespace app\controller;

use app\BaseController;
use think\Request;
class Index extends BaseController
{
    public function index()
    {
        $str = '{"cards":[{"appointmentEndTime":3,"appointmentStartTime":0,"cardNo":"8536184135366438","city":"\u5317\u4eac","companyId":72,"createDate":"2020-12-13 17:16:46","dealerName":"\u6d4b\u8bd5","equityName":"2\u5c0f\u65f6","mininumDate":1,"overHoldTime":30,"status":1,"validityDate":"2020-12-16 00:00","vipTypeName":"\u6d4b\u8bd5\u505c\u8f66\u5361"},{"appointmentEndTime":3,"appointmentStartTime":0,"cardNo":"7248399029066895","city":"\u5317\u4eac","companyId":72,"createDate":"2020-12-13 17:16:46","dealerName":"\u6d4b\u8bd5","equityName":"2\u5c0f\u65f6","mininumDate":1,"overHoldTime":30,"status":1,"validityDate":"2020-12-16 00:00","vipTypeName":"\u6d4b\u8bd5\u505c\u8f66\u5361"},{"appointmentEndTime":3,"appointmentStartTime":0,"cardNo":"5369852453562462","city":"\u5317\u4eac","companyId":72,"createDate":"2020-12-13 17:16:46","dealerName":"\u6d4b\u8bd5","equityName":"2\u5c0f\u65f6","mininumDate":1,"overHoldTime":30,"status":1,"validityDate":"2020-12-16 00:00","vipTypeName":"\u6d4b\u8bd5\u505c\u8f66\u5361"}]}';
        $str = md5($str."02f13db73c37cf34");
        echo $str;
        echo "<br/>";

    }


    function test(Request $request){
        $params = $request->param();
        $headToken = $request->header('token');
        $token = md5(json_encode($params)."02f13db73c37cf34");
        if($token !== $headToken){
            return "token 错误！！";
        }

        echo "token没有错！！";

    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
