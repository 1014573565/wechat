<?php

namespace App\Http\Controllers\Proto;

use App\Guide;
use App\PortoDatatables;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    //
    function Admin()
    {
        if(request()->isMethod('post')){
            return PortoDatatables::guideListSource();
        }
        return view("porto_admin.guide.guide_list");
    }

    function AddAction(Request $request)
    {
        $data = Guide::create($request);
        return response()->json($data);
    }

    function EditAction(Request $request)
    {
        $data = Guide::edit($request);
        return response()->json($data);
    }

    function DeleteAdminUser(Request $request)
    {
        $user = Guide::where("id", $request->admin_id)->first();
        if ($user == NULL) {
            return view("errors.404");
        }
        Guide::destroy($request->admin_id);
        return response()->json(['status' => 1, 'message' => '删除成功']);
    }

    function adminModal($admin_id)
    {
        $user = Guide::where("id", $admin_id)->first();
        if ($user == NULL) {
            return view("errors.404");
        }

        return view("porto_admin.guide.guide_modal", compact('user'));
    }


}
