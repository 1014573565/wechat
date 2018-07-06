<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Hash;

class Guide extends Model
{
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

    public $table = 'users';

    const TOURIST_GUIDE = 1;
    const DRIVER = 2;

    static $roleArr = [
        self::TOURIST_GUIDE => '导游',
        self::DRIVER => '司机',
    ];

    static function create(Request $request)
    {
        $admin = new Driver();
        $admin->name = $request->name;
        $admin->mobile = $request->mobile;
        $admin->role = Travel::TOURIST_GUIDE;
        if(empty($request->name)){
            return $return = ['status' => 2, 'message' => '请填写名字'];
        }
        if(empty($request->mobile)){
            return $return = ['status' => 2, 'message' => '请填写手机号'];
        }
        if(empty($request->password)){
            return $return = ['status' => 2, 'message' => '请填写密码'];
        }

        $admin->password = bcrypt($request->password);
        $admin->created_at = time();
        if (Driver::where("mobile", $request->mobile)->where('role',Travel::DRIVER)->exists()) {
            return $return = ['status' => 2, 'message' => '手机号已存在'];
        }
        if ($admin->save()) {
            return $return = ['status' => 1, 'message' => '添加成功'];
        }
        return $return = ['status' => 2, 'message' => '添加失败'];
    }

    static function edit(Request $request)
    {
        $admin = Driver::where("id", $request->id)->first();
        if ($admin == NULL) {
            return $return = ['status' => 2, 'message' => trans("models.ManagerNotExists")];
        }

        if(empty($request->name)){
            return $return = ['status' => 2, 'message' => '请填写名字'];
        }
        if(empty($request->mobile)){
            return $return = ['status' => 2, 'message' => '请填写手机号'];
        }
        /*if(empty($request->password)){
            return $return = ['status' => 2, 'message' => '请填写密码'];
        }*/


        $admin->name = $request->name;
        $admin->mobile = $request->mobile;
//        $admin->password = bcrypt($request->password);
        $admin->created_at = time();
        $admin->save();
        return $return = ['status' => 1, 'message' => '修改成功'];
    }

}














