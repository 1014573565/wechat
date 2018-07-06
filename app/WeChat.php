<?php

namespace App;

use EasyWeChat\Factory;
use Illuminate\Database\Eloquent\Model;

class WeChat extends Model
{

    public static $app;

    public static function setApp(){
        self::$app = Factory::officialAccount(WeChat::getConfig());
    }

    public static function getConfig(){
        return [
            'app_id' => 'wxbfd21fb572f613a0',         // AppID
            'secret' => 'b6a872f672f39d9517f4452d6bcbdee5',    // AppSecret
            'token' => 'xihongwei',           // Token
            'aes_key' => '',                 // EncodingAESKey
        ];
    }

    public static function __callStatic($method, $parameters)
    {
        $function = '';
        if(strpos($method, '_') !== false){
            list($class_, $method_) = explode('_', $method);
            $function = [self::$app->$class_, $method_];
        }
        if(!$function){
            return '';
        }
        return call_user_func_array($function, $parameters);
    }


    public static function checkCode($code){
        $app1 = Factory::miniProgram(self::getMiniProgramConfig());
        $rs = $app1->auth->session($code);
        if(isset($rs['errcode'])){
            return response()->json(["status" => 2, "message" => '认证失败','code'=>ConstCode::AUTHENTICATION_FAILED]);
        }

        return $rs;
    }

    public static function getMiniProgramConfig(){
        return [
            'app_id' => env('WECHAT_MINIPROGRAM_APPID'),
            'secret' => env('WECHAT_MINIPROGRAM_SECRET'),

            // 下面为可选项
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            'log' => [
                'level' => 'debug',
                'file' => storage_path('logs/wechat.log'),
            ],
        ];
    }













}
