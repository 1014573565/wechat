<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PortoDatatables extends Model
{


    //获取新闻记录的列表
    static public function jobListSource()
    {
        $return = [];
        //过滤查询条件
        // 1.获取参数
        $return['draw'] = intval(request('draw', 1));
        $from = request()->columns[0]['search']['value'];
        $to = request()->columns[1]['search']['value'];
        $driver = request()->columns[2]['search']['value'];
        $type = request()->columns[3]['search']['value'];
        $title = request()->columns[4]['search']['value'];

        $pageNum = request('length', 10);# 每页显示数量
        $start = request('start', 0); # 页码
        $return['data'] = []; # 币种
        // 2.筛选数据
        // 过滤前数量
        $result = DB::table("travels");
        $return['recordsTotal'] = $result->count();
        //过滤
        /*$begin = 0;
        $end = time();
        if ($from != "") {
            $begin = strtotime($from);
        }
        if ($to != "") {
            $end = strtotime($to) + 3600 * 24;
        }
        $result = $result->whereBetween("created_at", [$begin, $end]);*/
        if ($driver) {
            $result = $result->where('driver', $driver);
        }

        // 过滤后数量
        $return['recordsFiltered'] = $result->count();
        $pageNum = $pageNum < 0 ? $return['recordsFiltered'] : $pageNum;
        // 显示数量
        $datas = $result->skip($start)->take($pageNum)->orderByDesc("created_at")->get();

        foreach ($datas as $data) {
            $action1 = <<<EOF
             <!--<a class="admin_modify1" admin_id="$data->id" href="#"><i class="fa fa-pencil"></i></a>-->
             <!--&nbsp;&nbsp;-->
            <a href="#" admin_id="$data->id"  class="delete-post"><i class="fa fa-trash-o"></i></a>
EOF;
            $return['data'][] = [
                date('Y-m-d', $data->created_at),
                $data->company,
                $data->group_number,
                $data->car,
                $data->number_of_people,
                $data->model,
                $data->license,
                $data->driver,
                $data->stroke,
                $data->fare,
                $data->wage,
                $data->tip,
                $data->p_t,
                $data->water_fee,
                $data->meal_supplement,
                $data->generation_pad,
                $data->remark,
                $action1
            ];
        }
        return $return;
    }

    public static function driverListSource()
    {
        $return = [];
        //过滤查询条件
        // 1.获取参数
        $return['draw'] = intval(request('draw', 1));
        $name = request()->columns[0]['search']['value'];
        $mobile = request()->columns[1]['search']['value'];
        $license = request()->columns[2]['search']['value'];

        $pageNum = request('length', 10);# 每页显示数量
        $start = request('start', 0); # 页码
        $return['data'] = []; # 币种
        // 2.筛选数据
        // 过滤前数量
        $result = DB::table("users")->where('role', Travel::DRIVER);
        $return['recordsTotal'] = $result->count();
        //过滤
        if ($name) {
            $result = $result->where('name', $name);
        }
        if ($mobile) {
            $result = $result->where('mobile', $mobile);
        }
        if ($license) {
            $result = $result->where('license', $license);
        }
        // 过滤后数量
        $return['recordsFiltered'] = $result->count();
        $pageNum = $pageNum < 0 ? $return['recordsFiltered'] : $pageNum;
        // 显示数量
        $datas = $result->skip($start)->take($pageNum)->orderByDesc("created_at")->get();

        foreach ($datas as $data) {


            $action1 = <<<EOF
             <a class="admin_modify1" admin_id="$data->id" href="#"><i class="fa fa-pencil"></i></a>
             &nbsp;&nbsp;
            <a href="#" admin_id="$data->id"  class="delete-post"><i class="fa fa-trash-o"></i></a>
EOF;

            $return['data'][] = [

                $data->name,
                $data->mobile,
                $data->license,
                date('Y-m-d', $data->created_at),
                $action1

            ];
        }
        return $return;
    }

    public static function guideListSource()
    {
        $return = [];
        //过滤查询条件
        // 1.获取参数
        $return['draw'] = intval(request('draw', 1));
        $name = request()->columns[0]['search']['value'];
        $mobile = request()->columns[1]['search']['value'];

        $pageNum = request('length', 10);# 每页显示数量
        $start = request('start', 0); # 页码
        $return['data'] = []; # 币种
        // 2.筛选数据
        // 过滤前数量
        $result = DB::table("users")->where('role', Travel::TOURIST_GUIDE);
        $return['recordsTotal'] = $result->count();

        if ($name) {
            $result = $result->where('name', $name);
        }
        if ($mobile) {
            $result = $result->where('mobile', $mobile);
        }

        // 过滤后数量
        $return['recordsFiltered'] = $result->count();
        $pageNum = $pageNum < 0 ? $return['recordsFiltered'] : $pageNum;
        // 显示数量
        $datas = $result->skip($start)->take($pageNum)->orderByDesc("created_at")->get();

        foreach ($datas as $data) {


            $action1 = <<<EOF
             <a class="admin_modify1" admin_id="$data->id" href="#"><i class="fa fa-pencil"></i></a>
             &nbsp;&nbsp;
            <a href="#" admin_id="$data->id"  class="delete-post"><i class="fa fa-trash-o"></i></a>
EOF;

            $return['data'][] = [
                $data->name,
                $data->mobile,
                date('Y-m-d', $data->created_at),
                $action1
            ];
        }
        return $return;
    }


}
