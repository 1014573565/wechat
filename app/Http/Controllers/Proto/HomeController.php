<?php

namespace App\Http\Controllers\Proto;


use App\Driver;
use App\Excel;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HomeController extends Controller
{
    //
    function Index(Request $request)
    {
        $driver_count = Driver::where('role', Driver::DRIVER)->count();
        $guide_count = Driver::where('role', Driver::TOURIST_GUIDE)->count();
        return view("porto_admin.index.dashboard", compact('guide_count', 'driver_count'));
    }

    public function removeExcel(){
        $file_name = request()->file_name;
        $file_name = Excel::getUploadPath($file_name);
        return ['status'=>1,'message'=>'success','data'=>$file_name];
        Excel::removeExcel($file_name);
    }



}













