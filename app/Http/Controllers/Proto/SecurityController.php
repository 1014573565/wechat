<?php

namespace App\Http\Controllers\Proto;

use App\Admin;
use App\Http\Controllers\Controller;
use App\UserInfo;
use DB;
use Auth;

class SecurityController extends Controller
{
    //

    function SignIn()
    {
        if (\request()->isMethod("get")) {
            return view("porto_admin.security.pages-signin");
        }
        $data = Admin::Login();
        return response()->json($data);
    }

    function SignOut()
    {
        Auth::logout();
        return redirect('/login');
    }

    function Session()
    {
        return response()->json(["status" => 1]);
    }

    function UnLock()
    {
        $data = Admin::UnLock();
        return response()->json($data);
    }

    function lockScreen()
    {
        return view("porto_admin.security.lock");
    }
}
