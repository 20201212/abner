<?php

namespace app\demo\exception;


use think\exception\Handle;
use think\Response;
use Throwable;

class Http extends  Handle
{
    public  $httpStatus = 500;

     public function render($request, Throwable $e): Response
     {
         if(!env('APP.APP_DEBUG')) {

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