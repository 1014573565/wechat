<?php

namespace App\Http\Middleware;

use App\ConstCode;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class WechatAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!isset($request->session_id) && empty($request->session_id)){
            return response()->json(['status'=>2, 'message'=>'session id not null', 'code'=>ConstCode::SESSION_ID_NOT_EXISTS]);
        }else{
            $is_login = $this->checkLogin($request->session_id);
            if(!$is_login){
                return response()->json(['status'=>2, 'message'=>'session id expired', 'code'=>ConstCode::SESSION_ID_EXPIRED]);
            }
        }
        return $next($request);
    }

    private function checkLogin($session_id){
        $session_id = Cache::get($session_id);
        return $session_id ? true : false;
    }
}
