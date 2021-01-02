<?php
namespace app\common\lib\sms;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use think\facade\Log;

class AliSms implements SmsBase
{
    /**
     * 阿里云发送短信验证码
     * @param $phone
     * @param $code
     * @return false
     * @throws ClientException
     */
    public static  function sendCode($phone, $code){
        if(empty($phone) && empty($code))
            return false;

        $templateparam = ['code'=>$code];

        AlibabaCloud::accessKeyClient(config('aliyun.access_key_id'), config('aliyun.access_secret'))
            ->regionId(config('aliyun.region_id'))
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host(config('aliyun.host'))
                ->options([
                    'query' => [
                        'RegionId'          => config('aliyun.region_id'),
                        'PhoneNumbers'      => $phone,
                        'SignName'          => config('aliyun.sign_name'),
                        'TemplateCode'      => config('aliyun.template_code'),
                        'TemplateParam'     => json_encode($templateparam),
                    ],
                ])
                ->request();
          $res = $result->toArray();
            if($res['Code'] !== 'OK') {
                Log::info("aliyun-endCode-{$phone}-result".json_encode($result->toArray(),JSON_UNESCAPED_UNICODE));
                return false;
            }

        } catch (ClientException $e) {
            Log::error("aliyun-sendCode-{$phone}-ClientException".$e->getErrorMessage());
            return false;
//            echo $e->getErrorMessage();
        } catch (ServerException $e) {
            Log::error("aliyun-sendCode-{$phone}-ServerException".$e->getErrorMessage());
            return false;
//            echo $e->getErrorMessage();
        }

        return true;

    }



}