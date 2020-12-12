<?php
// 应用公共文件
/**
 * 用于信息提示
 * @param $status
 * @param string $message
 * @param array $data
 * @param int $httpStatus
 * @return \think\response\Json
 */
function show($status, $message="error", $data = [], $httpStatus = 200){

    $result = [
        'status' => $status,
        'msg'    => $message,
        'result' => $data,
        'time'   => date('Y-m-d H:i:s', time()),
    ];

    return json($result);

}