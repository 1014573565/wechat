<?php

namespace App\Http\Controllers\Proto;

use App\Driver;
use App\Excel;
use App\PortoDatatables;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    //
    function Admin()
    {
        if(request()->isMethod('post')){
            return PortoDatatables::driverListSource();
        }
        return view("porto_admin.driver.driver_list");
    }

    function AddAction(Request $request)
    {
        $data = Driver::create($request);
        return response()->json($data);
    }

    function EditAction(Request $request)
    {
        $data = Driver::edit($request);
        return response()->json($data);
    }

    function DeleteAdminUser(Request $request)
    {
        $user = Driver::where("id", $request->admin_id)->first();
        if ($user == NULL) {
            return view("errors.404");
        }
        Driver::destroy($request->admin_id);
        return response()->json(['status' => 1, 'message' => '删除成功']);
    }

    function adminModal($admin_id)
    {
        $user = Driver::where("id", $admin_id)->first();
        if ($user == NULL) {
            return view("errors.404");
        }

        return view("porto_admin.driver.driver_modal", compact('user'));
    }

    public function upload(Request $request){
        $file = $request->file('file');

        if($file->isValid()){
            // 获取文件相关信息
//            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            if(!in_array($ext, ['xlsx','xls','csv'])){
                return response()->json(['status'=>2, 'message'=>'文件扩展名必须是, xlsx, xls, csv']);
            }
            $file_name = $file->store('uploads');
            $file_name = explode('/', $file_name)[1];
            return response()->json(['status'=>1, 'message'=>'success', 'data'=>$file_name]);
        }else{
            return response()->json(['status'=>2, 'message'=>'请选择文件']);
        }
    }

    public function uploadModal($file_name){

        $path = config('filesystems.disks.local.root');
        $file_name1 = $path.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$file_name;
        if(!is_file($file_name1)){
            return ['status'=>2, 'message'=>'不存在'];
        }
        $html = Excel::importExcel($file_name1);
        return view("porto_admin.layout.upload_modal", compact('html','file_name'));
    }

    public function insertExcelData(){
        $file_name = request()->file_name;
        $file_name = Excel::getUploadPath($file_name);
        $worksheet = Excel::insertExcel($file_name);

        $fields = ['name','mobile', 'license','password'];
        $current = time();

        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            $data = [];
            $i = 0;
            foreach ($cellIterator as $key => $cell) {
                if($cell->getValue() != ''){
                    if($cell->getRow() != 1){
                        if($fields[$i] == 'password'){
                            $data[$fields[$i]] = bcrypt($cell->getValue());
                            continue;
                        }
                        $data[$fields[$i]] = $cell->getValue();
                    }
                }
                $i++;
            }
            if(!empty($data)){
                $data['created_at'] = $current;
                $data['role'] = Driver::DRIVER;
                Driver::insert($data);
            }
        }
        return response()->json(['status'=>1, 'message'=>'导入数据成功']);
    }

    public function removeExcel(){
        $file_name = request()->file_name;
        return view("porto_admin.layout.upload_modal", compact('html'));
    }

}
