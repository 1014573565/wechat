<?php

namespace App\Http\Controllers\Proto;

use App\Admin;
use App\Excel;
use App\Http\Controllers\Controller;
use App\PortoDatatables;
use App\Travel;
use App\UserInfo;
use DB;
use Auth;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    //

    public function index(){
        if(request()->isMethod('post')){
            return PortoDatatables::jobListSource();
        }
        return view("porto_admin.index.job_list");
    }

    function DeleteAdminUser(Request $request)
    {
        $user = Travel::where("id", $request->admin_id)->first();
        if ($user == NULL) {
            return view("errors.404");
        }
        Travel::destroy($request->admin_id);
        return response()->json(['status' => 1, 'message' => '删除成功']);
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

        $fields = ['created_at','company','group_number', 'car','number_of_people','model','license','driver','stroke','fare','wage','tip','p_t','water_fee','meal_supplement','generation_pad','remark'];

        DB::beginTransaction();
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            $data = [];
            $i = 0;
            foreach ($cellIterator as $key => $cell) {
                if($cell->getValue() != ''){
                    if($cell->getRow() != 1){
                        if($fields[$i] == 'created_at'){
                            $data[$fields[$i]] = strtotime($cell->getFormattedValue());
                        }else{
                            $data[$fields[$i]] = $cell->getValue();
                        }
                    }
                }
                $i++;
            }
            if(!empty($data)){
                try{
                    Travel::insert($data);
                }catch (\Exception $e){
                    DB::rollBack();
                    return response()->json(['status'=>2, 'message'=>'导入数据失败']);
                }
            }
        }
        DB::commit();
        return response()->json(['status'=>1, 'message'=>'导入数据成功']);
    }
}
