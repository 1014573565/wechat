@extends('porto_admin.layout.master')
@section('title', '工作列表')
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
                <li><span>工作列表</span></li>
            </ol>
        </div>
    </header>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
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
                            <input type="email" placeholder="司机"
                                   class="form-control porto_jobs_column_filter  porto_jobs_2"
                                   data-column="2">
                        </div>


                    </div>
                </div>

            </section>
        </div>
    </div>
    <section style="margin-top:10px;">
        {{--<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">添加工作信息</button>--}}
        <form action="#" method="post" enctype="multipart/form-data" id="importExcelForm" style="display: inline-block;">
            <div style="position: relative;
        display: inline-block;
        width: 115px;
        vertical-align: middle;
        margin-top: -2px; ">
                <button type="button" class="btn btn-primary" style="position:absolute;">导入工作数据</button>
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

                    <h2 class="card-title">工作列表</h2>
                </header>
                <div class="card-body ">
                    <table class="table table-bordered table-striped mb-0"
                           id="porto_jobs_table"
                           width="100%"
                           data-url="{{url("/jobs")}}" data-role="porto_jobs" style="min-height:10rem;">
                        <thead>
                        <tr>
                            <th>日期</th>
                            <th>公司</th>
                            <th>团号</th>
                            <th>用车</th>
                            <th>人数</th>
                            <th>车型</th>
                            <th>车牌</th>
                            <th>司机</th>
                            <th>行程</th>
                            <th>车费</th>
                            <th>工资</th>
                            <th>小费</th>
                            <th>P&T</th>
                            <th>水</th>
                            <th>餐费</th>
                            <th>代垫</th>
                            <th>备注</th>
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

    {{--操作处理弹窗--}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <div class="alert tips">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <span></span>
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


            $("#importExcel").change(function (){

                var formData = new FormData();
                formData.append("file",$("#importExcel")[0].files[0]);

                $.ajax({
                    url: "/proto/jobs/upload",
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
                        $("#myModal1").modal("show");
                        var file_name = data.data;
                        $("#myModal1 .modal-content").load("/proto/driver/upload_modal/"+encodeURI(file_name));
                    }
                });
            });
            //修改提交
            $("#myModal1").on("click",".upload_submit",function(e){
                e.preventDefault();
                var data = $("#myModal1 .form-admin").serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/proto/jobs/upload_action",
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

            /*$('#myModal1').on('hidden.bs.modal', function () {
                uploading = false;
            })*/

            $(document).on("click", ".delete-post", function (){
                if(confirm("是否删除这条记录？")){
                    var _this = $(this);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/proto/jobs/del",
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




            InitDatatable("porto_jobs")


        });
    </script>
@endsection
