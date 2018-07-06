@extends('porto_admin.layout.master')
@section('title', '导游列表')
@section('css')
    @parent
    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="{{asset("proto/vendor/select2/css/select2.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/datatables/media/css/dataTables.bootstrap4.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/pnotify/pnotify.custom.css")}}"/>
    <style>
        .tips {
            display: none;
            width: 50%;
            position: fixed;
            top: 45%;
            left: 25%;
            z-index: 9999;
        }
    </style>
@endsection
@section('content')
    <header class="page-header">
        <h2>&nbsp;</h2>
        <div class="right-wrapper text-left">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>系统管理</span></li>
                <li><span>导游列表</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>
                    <h2 class="card-title">筛选</h2>
                </header>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 form-group">
                            <input type="text" placeholder="名字"
                                   class="form-control porto_guide_column_filter  porto_guide_0"
                                   data-column="0">
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 form-group">
                            <input type="text" placeholder="手机"
                                   class="form-control porto_guide_column_filter  porto_guide_1"
                                   data-column="1">
                        </div>

                    </div>
                </div>

            </section>
        </div>
    </div>
    {{--<section style="margin-top:10px;">
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">添加导游</button>
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" >导入导游数据</button>
    </section>--}}
    <div class="row">
        <div class="col">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>

                    <h2 class="card-title">导游列表</h2>
                </header>
                <div class="card-body ">
                    <table class="table table-bordered table-striped mb-0"
                           id="porto_guide_table"
                           width="100%"
                           data-url="{{url("/proto/guide")}}" data-role="porto_guide" style="min-height:10rem;">
                        <thead>
                        <tr>
                            <th>名字</th>
                            <th>手机号码</th>
                            <th>日期</th>
                            <th>操作</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    {{--管理员修改12--}}
    <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>

    {{--提示--}}
    <div class="alert tips">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <span></span>
    </div>

    {{--添加管理员--}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">添加导游</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal admin-add container-fluid">
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 pt-2 pr-0 pl-0">导游名字：</label>
                            <input type="text" class="col-sm-9 col-md-10 form-control" name="name">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">手机号：</label>
                            <input type="text" class="col-sm-9 col-md-10 form-control" name="mobile">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">登录密码：</label>
                            <input type="text" class="col-sm-9 col-md-10 form-control" name="password">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary float-right" value="确定">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @parent
    <!-- Specific Page Vendor -->
    <script src="{{asset("proto/vendor/select2/js/select2.js")}}"></script>
    <script src="{{asset("proto/vendor/datatables/media/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("proto/vendor/datatables/media/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("proto/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("proto/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js")}}"></script>
    <script src="{{asset("proto/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js")}}"></script>
    <script src="{{asset("proto/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js")}}"></script>
    <script src="{{asset("proto/vendor/datatables/extras/TableTools/JSZip-2.5.0//jszip.min.js")}}"></script>
    <script src="{{asset("proto/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js")}}"></script>
    <script src="{{asset("proto/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js")}}"></script>
    <!-- Examples -->
    <script src="{{asset("proto/js/datatable.js?v=13")}}"></script>
    <script src="{{asset("proto/vendor/pnotify/pnotify.custom.js")}}"></script>
    <script>
        $(function () {

            $(document).on("click", ".delete-post", function (){
                if(confirm("是否删除这条记录？")){
                    var _this = $(this);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/proto/guide/del",
                        type: 'POST',
                        data: {admin_id:_this.attr('admin_id')},
                        success: function (data) {
                            if (data.status != 1) {
                                $(".tips").show().addClass("alert-danger");
                                $(".tips span").html(data.message);
                                setTimeout(function () {
                                    $(".tips").hide().removeClass("alert-danger");
                                    $(".tips span").html("");
                                }, 2000);
                            } else {
                                $(".tips").show().addClass("alert-success");
                                $(".tips span").html(data.message);
                                setTimeout(function () {
                                    $(".tips").hide().removeClass("alert-success");
                                    $(".tips span").html("");
                                    location.reload();
                                }, 2000);
                            }
                        }
                    });
                }
            })

            //修改管理员
            $(document).on("click", ".admin_modify1", function(){
                console.log(1);
                $("#modifyModal").modal("show");
                var admin_id = $(this).attr('admin_id');
                $("#modifyModal .modal-content").load("/proto/guide_modal/"+admin_id);
            });

            //修改提交
            $("#modifyModal").on("click",".admin_modify",function(e){
                e.preventDefault();
                var data = $("#modifyModal .form-admin").serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/proto/guide/edit",
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        if (data.status != 1) {
                            $(".tips").show().addClass("alert-danger");
                            $(".tips span").html(data.message);
                            setTimeout(function () {
                                $(".tips").hide().removeClass("alert-danger");
                                $(".tips span").html("");
                            }, 2000);
                        } else {
                            $(".tips").show().addClass("alert-success");
                            $(".tips span").html(data.message);
                            setTimeout(function () {
                                $(".tips").hide().removeClass("alert-success");
                                $(".tips span").html("");
                                location.reload();
                            }, 2000);
                        }
                    }
                });
            });

            //添加管理员
            $("#myModal .admin-add").submit(function(e){
                e.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/proto/guide/add",
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data.status != 1) {
                            $(".tips").show().addClass("alert-danger");
                            $(".tips span").html(data.message);
                            setTimeout(function () {
                                $(".tips").hide().removeClass("alert-danger");
                                $(".tips span").html("");
                            }, 2000);
                        } else {
                            $(".tips").show().addClass("alert-success");
                            $(".tips span").html(data.message);
                            setTimeout(function () {
                                $(".tips").hide().removeClass("alert-success");
                                $(".tips span").html("");
                                location.reload();
                            }, 2000);
                        }
                    }
                });
            });


            InitDatatable("porto_guide")


        });
    </script>
@endsection
