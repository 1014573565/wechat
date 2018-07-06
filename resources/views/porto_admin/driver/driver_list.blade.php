@extends('porto_admin.layout.master')
@section('title', '司机列表')
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
                <li><span>司机列表</span></li>
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
                                   class="form-control porto_driver_column_filter  porto_driver_0"
                                   data-column="0">
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 form-group">
                            <input type="text" placeholder="手机"
                                   class="form-control porto_driver_column_filter  porto_driver_1"
                                   data-column="1">
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 form-group">
                            <input type="text" placeholder="驾照"
                                   class="form-control porto_driver_column_filter  porto_driver_2"
                                   data-column="2">
                        </div>

                    </div>
                </div>

            </section>
        </div>
    </div>
    <section style="margin-top:10px;">
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">添加司机</button>
        <form action="#" method="post" enctype="multipart/form-data" id="importExcelForm" style="display: inline-block;">
            <div style="position: relative;
        display: inline-block;
        width: 115px;
        vertical-align: middle;
        margin-top: -2px; ">
                <button type="button" class="btn btn-primary" style="position:absolute;">导入司机数据</button>
                <input style="opacity: 0;
        width: 100%;
        height: 38px; opacity: 0;" type="file" id="importExcel" class=" mb-2"  >
            </div>
        </form>
    </section>
    <div class="row">
        <div class="col">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>

                    <h2 class="card-title">司机列表</h2>
                </header>
                <div class="card-body ">
                    <table class="table table-bordered table-striped mb-0"
                           id="porto_driver_table"
                           width="100%"
                           data-url="{{url("/proto/driver")}}" data-role="porto_driver" style="min-height:10rem;">
                        <thead>
                        <tr>
                            <th>名字</th>
                            <th>手机号码</th>
                            <th>驾照</th>
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

    <div class="modal fade" id="modifyModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <h4 class="modal-title" id="myModalLabel">添加司机</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal admin-add container-fluid">
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 pt-2 pr-0 pl-0">司机名字：</label>
                            <input type="text" class="col-sm-9 col-md-10 form-control" name="name">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">手机号：</label>
                            <input type="text" class="col-sm-9 col-md-10 form-control" name="mobile">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">驾照：</label>
                            <input type="text" class="col-sm-9 col-md-10 form-control" name="license">
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

            var uploading = false;

            $("#importExcel").change(function (){

                var formData = new FormData();
                formData.append("file",$("#importExcel")[0].files[0]);

                if(uploading){
                    alert("文件正在上传中，请稍候");
                    return false;
                }
                $.ajax({
                    url: "/proto/driver/upload",
                    type: 'POST',
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    dataType:"json",
                    beforeSend: function(){
                        uploading = true;
                    },
                    success : function(data) {
                        $("#modifyModal1").modal("show");
                        var file_name = data.data;
                        $("#modifyModal1 .modal-content").load("/proto/driver/upload_modal/"+encodeURI(file_name));
                        uploading = false;
                    }
                });
            });

            $('#modifyModal1').on('hidden.bs.modal', function () {
                uploading = false;
            })

            //修改提交
            $("#modifyModal1").on("click",".upload_submit",function(e){
                e.preventDefault();
                var data = $("#modifyModal1 .form-admin").serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/proto/driver/upload_action",
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

            $(document).on("click", ".delete-post", function (){
                if(confirm("是否删除这条记录？")){
                    var _this = $(this);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/proto/driver/del",
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
                $("#modifyModal").modal("show");
                var admin_id = $(this).attr('admin_id');
                $("#modifyModal .modal-content").load("/proto/driver_modal/"+admin_id);
            });

            //修改提交
            $("#modifyModal").on("click",".admin_modify",function(e){
                e.preventDefault();
                var data = $("#modifyModal .form-admin").serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/proto/driver/edit",
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
                    url: "/proto/driver/add",
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


            InitDatatable("porto_driver")


        });
    </script>
@endsection
