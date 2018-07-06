<?php

namespace App\Http\Controllers\Proto;

use App\Admin;
use App\PortoDatatables;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    function Admin()
    {
        $admins = Admin::all();
        return view("porto_admin.admin.admin_list", compact('admins'));
    }

    function AddAction(Request $request)
    {
        $data = Admin::create($request);
        return response()->json($data);
    }

    function EditAction(Request $request)
    {
        $data = Admin::edit($request);
        return response()->json($data);
    }

    function DeleteAdminUser(Request $request)
    {
        $user = Admin::where("id", $request->admin_id)->first();
        if ($user == NULL) {
            return view("errors.404");
        }
        Admin::destroy($request->admin_id);
        return response()->json(['status' => 1, 'message' => '删除成功']);
    }

    function adminModal($admin_id)
    {
        $user = Admin::where("id", $admin_id)->first();
        if ($user == NULL) {
            return view("errors.404");
        }

        return view("porto_admin.admin.admin_modal", compact('user'));
    }


    //操作日志
    public function optRecord(){
        if(request()->isMethod('post')){
            $data = PortoDatatables::optRecord();
            return response()->json($data);
        }else{
            return view('porto_admin.admin.log');
        }
    }

}
