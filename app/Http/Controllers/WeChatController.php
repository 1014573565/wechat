<?php

namespace App\Http\Controllers;

use App\ConstCode;
use App\Travel;
use App\WeChat;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use DB;

class WeChatController extends Controller
{

    /*public function __construct()
    {
        WeChat::setApp();
    }*/
    //
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        WeChat::$app->server->push(function ($message) {
            switch ($message['MsgType']) {
                case 'event':
                    if ($message['Event'] == 'subscribe') {
                        return '欢迎来到习红卫的公众号';
                    }else if ($message['Event'] == 'unsubscribe') {
                        return '我很忧伤';
                    }
                    return '收到事件消息';
                    break;
                case 'text':


                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }

            // ...
        });

        return WeChat::$app->server->serve();
    }


    public function login1(){
        exit;

        return Travel::touristGuide();
    }

    //登录
    public function login(Request $request){

        //参数验证
        $validator = Validator::make($request->all(), [
            'code' => 'bail|required',
            'mobile' => 'bail|required',
            'password' => 'bail|required',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                return response()->json(["status" => 2, "message" => $message]);
            }
        }

        $rs = WeChat::checkCode(request()->code);
        $user = DB::table('users')->where('mobile', $request->mobile)->first();
        if(!$user){
            return response()->json(["status" => 2, "message" => '手机号不存在','code'=>ConstCode::MOBILE_NOT_EXISTS]);
        }
        if(!Hash::check($request->password, $user->password)){
            return response()->json(["status" => 2, "message" => '密码不正确','code'=>ConstCode::INCORRECT_PASSWORD]);
        }


        $session_id = self::RandomToken();
        Cache::put($session_id, $rs['session_key'].'@'.$rs['openid'], 30);
        Cache::put('travel_user_id', $user->id, 30);

        return response()->json(['status'=>1, 'message'=>'success', 'data'=>['session_id'=>$session_id, 'role'=>$user->role]]);

    }

    //注册
    public function register(Request $request){

        //参数验证
        $validator = Validator::make($request->all(), [
            'code' => 'bail|required',
            'name' => 'bail|required',
            'mobile' => 'bail|required',
            'password' => 'bail|required',
            'confirm_password' => 'bail|required',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                return response()->json(["status" => 2, "message" => $message]);
            }
        }

        $session_code = WeChat::checkCode(request()->code);
        $user = DB::table('users')->where('mobile', $request->mobile)->first();
        if($user){
            return response()->json(["status" => 2, "message" => '手机号已被注册','code'=>ConstCode::MOBILE_EXISTS]);
        }
        if($request->password != $request->confirm_password){
            return response()->json(["status" => 2, "message" => '两次密码不一样','code'=>ConstCode::TWO_PASSWORDS_ARE_DIFFERENT]);
        }
        $id = DB::table('users')->insertGetId([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'role' => Travel::TOURIST_GUIDE,
            'created_at' => time(),
        ]);
        if($id){
            $session_id = self::RandomToken();
            Cache::put($session_id, $session_code['session_key'].'@'.$session_code['openid'], 30);
            Cache::put('travel_user_id', $id, 30);

            return response()->json(['status'=>1, 'message'=>'success', 'data'=>['session_id'=>$session_id, 'role'=>Travel::TOURIST_GUIDE]]);
        }else{
            return response()->json(['status'=>2, 'message'=>'注册失败，请稍后重试', 'code'=>ConstCode::REGISTER_FAIL]);
        }

    }



    //生成session id
    static function RandomToken($length = 32){
        if(!isset($length) || intval($length) <= 8 ){
            $length = 32;
        }
        if (function_exists('random_bytes')) {
            $random = bin2hex(random_bytes($length));
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            $random = bin2hex(openssl_random_pseudo_bytes($length));
        }
        return substr(strtr(base64_encode(hex2bin($random)), '+', '.'), 0, 44);
    }

    //检测session id 是否正确
    public function checkSessionID(){
        $id = Cache::get('travel_user_id');
        $user_info = DB::table('users')->where('id', $id)->select('role','name','mobile')->first();
        return response()->json(['status'=>1, 'message'=>'success', 'data'=>$user_info]);
    }

    //导游
    public function query(){
        $id = Cache::get('travel_user_id');
        $user_info = DB::table('users')->where('id', $id)->first();
        if($user_info->role == Travel::TOURIST_GUIDE){
            return response()->json(Travel::touristGuide($user_info));
        }else{
            return response()->json(Travel::Driver($user_info));
        }

    }

    public function modifyPassword(Request $request){
        //参数验证
        $validator = Validator::make($request->all(), [
            'mobile' => 'bail|required',
            'old_password' => 'bail|required',
            'new_password' => 'bail|required',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                return response()->json(["status" => 2, "message" => $message]);
            }
        }
        $user = DB::table('users')->where('mobile', $request->mobile)->first();
        if(!$user){
            return response()->json(["status" => 2, "message" => '手机号不存在','code'=>ConstCode::MOBILE_NOT_EXISTS]);
        }
        if(!Hash::check($request->old_password, $user->password)){
            return response()->json(["status" => 2, "message" => '原始密码不正确','code'=>ConstCode::INCORRECT_PASSWORD]);
        }
        DB::table('users')->where('mobile', $request->mobile)->update(['password'=>bcrypt($request->new_password)]);
        return ['status'=>1, 'message'=>'success'];
    }

    public function templateMessage(){
        $request = request();
        $session_id = $request->session_id;
        if(!isset($request->formId) && empty($request->formId)){
            return response()->json(['status'=>2, 'message'=>'参数异常']);
        }
        if(!isset($request->date) && empty($request->date)){
            return response()->json(['status'=>2, 'message'=>'参数异常']);
        }
        $form_id = $request->formId;
        $date = $request->date;

        if(strtotime($date) > time()+86400*7){
            return response()->json(['status'=>2, 'message'=>'最多预定七天后的行程通知']);
        }
        if(strtotime($date) < time()+86400){
            return response()->json(['status'=>2, 'message'=>'需要预定未来的行程通知']);
        }

        $cache_session_id = Cache::get($session_id);
        $openid = explode('@',$cache_session_id)[1];

        $items = [
            'form_id'=>$form_id,
            'date'=>$date,
            'id'=>$form_id,
            'open_id'=>$openid,
        ];
        Log::info(json_encode($items));
//        Redis::lpush('itinerary_notice', $items);

        /*$app = Factory::miniProgram(WeChat::getMiniProgramConfig());
        $cache_session_id = Cache::get($session_id);
        $openid = explode('@',$cache_session_id)[1];

        $rs = $app->template_message->send([
            'touser' => $openid,
            'template_id' => 'WPl7fqwp6QmQJuhplJeAA74wPYqjT0-9jWd_oJpAsAU',
            'page' => 'page/index/index',
            'form_id' => $form_id,
            'data' => [
                'keyword1' => '次日行程安排',
                'keyword2' => date('Y-m-d',strtotime('+1 day')),
                'keyword3' => 'CSA南航',
                'keyword4' => '22',
                'keyword5' => '无',
            ],
        ]);
        return response()->json(['status'=>1, 'message'=>'success']);*/
        return response()->json(['status'=>1, 'message'=>'success']);
    }



    /*public function upload(){
        $image = public_path('image/psb.jpg');
        p(WeChat::material_uploadImage($image));
    }



    public function rsList(){
        p(WeChat::list('image', 0, 10));
    }

    public function rsStats(){
        p(WeChat::material_stats());
    }

    public function rsDel($mediaId){
        p(WeChat::resourceDel($mediaId));
    }

    public function createMenu(){
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        p(WeChat::menu_create($buttons));
    }*/

    

}














