<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Log;
use DB;

class Travel extends Model
{
    public $timestamps = false;

    public $dateFormat = 'U';

    const TOURIST_GUIDE = 1;
    const DRIVER = 2;

    static $roleArr = [
        self::TOURIST_GUIDE => '导游',
        self::DRIVER => '司机',
    ];

    public static function touristGuide($user_info){
        $request = request();
        if(!isset($request->group_number) && empty($request->group_number)){
            return ["status" => 2, "message" => '请输入要查询的内容！'];
        }
        if(!isset($request->date) && empty($request->date)){
            return ["status" => 2, "message" => '请输入要查询的内容！'];
        }
        $start_date = strtotime($request->date);
        $end_date = mktime(23,59,59,date("m",$start_date),date("d",$start_date),date("Y",$start_date));
        $lists = self::where('group_number', $request->group_number)->whereBetween('created_at', [$start_date, $end_date])->get();
        foreach($lists as &$value){
            $value->mobile = DB::table('users')->where('name', $value->driver)->value('mobile');
        }
        return ['status'=>1, 'message'=>'success', 'data'=>$lists];
    }

    public static function touristGuideQuery($id){
        return self::where('id', $id)->first();
    }

    public static function Driver($user_info)
    {
        $request = request();
        if(!isset($request->date) && empty($request->date)){
            return ["status" => 2, "message" => '请输入要查询的内容！'];
        }
        $start_date = strtotime($request->date);
        $end_date = mktime(23,59,59,date("m",$start_date),date("d",$start_date),date("Y",$start_date));
        $info = self::where('driver', $user_info->name)->whereBetween('created_at', [$start_date, $end_date])->get();
        $date_arr = explode('-',$request->date);
        $total_salary = 0;
        if(isset($date_arr[1])){
            $total_salary = self::where('driver', $user_info->name)->whereBetween('created_at', [strtotime(date('Y-m', $start_date)), strtotime(date('Y-m-t', $start_date))])->sum('wage');
        }
        return ['status'=>1, 'message'=>'success', 'data'=>['lists'=>$info, 'total_salary'=>$total_salary]];

    }

    public function getCreatedAtAttribute($value){
        return $this->created_at = date('Y-m-d', $value);
    }


}
