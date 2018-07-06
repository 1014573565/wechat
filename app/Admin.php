<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
use Hash;
use Auth;

class Admin extends Authenticatable
{
    use Notifiable;

    const STATUS_NORMAL = 1;
    const STATUS_FORZEN = 2;
    const STATUS_DELETE = 3;

    static $StatusDisplay = [
        0 => 'All',
        self::STATUS_NORMAL => 'Normal',
        self::STATUS_FORZEN => 'Frozen',
        self::STATUS_DELETE => 'Deleted',
    ];

    static $PAGE_SIZE = [10, 20, 50, 100];

    public $timestamps = false;


    protected $hidden = [
        'password', 'remember_token',
    ];

    static function create(Request $request)
    {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->mobile = $request->mobile;
        if(empty($request->name)){
            return $return = ['status' => 2, 'message' => '请填写名字'];
        }
        if(empty($request->mobile)){
            return $return = ['status' => 2, 'message' => '请填写手机号'];
        }
        if ($request->password != $request->password_repeat) {
            return $return = ['status' => 2, 'message' => '两次密码不一致'];
        }

        $admin->password = bcrypt($request->password);
        $admin->created_at = time();
        if (Admin::where("mobile", $request->mobile)->exists()) {
            return $return = ['status' => 2, 'message' => '手机号已存在'];
        }
        if ($admin->save()) {
            return $return = ['status' => 1, 'message' => '添加成功'];
        }
        return $return = ['status' => 2, 'message' => '添加失败'];
    }

    static function edit(Request $request)
    {
        $admin = Admin::where("id", $request->id)->first();
        if ($admin == NULL) {
            return $return = ['status' => 2, 'message' => trans("models.ManagerNotExists")];
        }

        if(empty($request->name)){
            return $return = ['status' => 2, 'message' => '请填写名字'];
        }
        if(empty($request->mobile)){
            return $return = ['status' => 2, 'message' => '请填写手机号'];
        }
        $admin->name = $request->name;
        $admin->mobile = $request->mobile;
        $admin->created_at = time();
        $admin->save();
        return $return = ['status' => 1, 'message' => '修改成功'];
    }

    static function del(Request $request)
    {
        if($request->id == Auth::id()){
            return ['status' => 2, 'message' => '不能删除当前登录管理员'];
        }
        Admin::where("id", $request->id)->delete();
        return ['status' => 1, 'message' => '删除成功'];
    }

    static function Login()
    {
        if (!request("mobile")) {
            return $return = ['status' => 2, 'message' => '请输入手机号码'];
        }
        if (!request("password")) {
            return $return = ['status' => 2, 'message' => '请输入密码'];
        }

        $admin = Admin::where('mobile', request("mobile"))->first();

        if (!$admin) {
            return $return = ['status' => 2, 'message' => '用户名不存在'];
        }

        if (Auth::attempt(['mobile' => request("mobile"), 'password' => request("password")])) {
            return $return = ['status' => 1, 'message' => "登录成功" . __LINE__];
        }
        return $return = ['status' => 2, 'message' => '密码错误'];
    }
}














