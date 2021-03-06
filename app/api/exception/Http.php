<?php
/**
 * Explanation: 捕获异常
 * Author: Abner
 * Time: 2021/1/2 23:46
 */


namespace app\api\exception;
use think\exception\Handle;
use think\Response;
use Throwable;

class Http extends  Handle
{
    public  $httpStatus = 500;

    public function render($request, Throwable $e): Response
    {

        if(!env('APP.APP_DEBUG')) {
            if($e instanceof \think\Exception){

                return show($e->getCode(), $e->getMessage());
            }

            if($e instanceof \think\exception\HttpResponseException){
                return parent::render($request,$e);
            }

            if(method_exists($e, "getStatusCode")){

                $httpStatus = $e->getStatusCode();
            }else{
                $httpStatus = $this->httpStatus;
            }

            return show(config('status.error'), $e->getMessage(), [], $httpStatus);
        }else{
            return parent::render($request, $e);
        }

    }

}