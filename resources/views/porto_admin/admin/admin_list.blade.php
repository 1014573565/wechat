@extends('porto_admin.layout.master')
@section('title', '管理员管理')
@section('css')
    @parent
    <link rel="stylesheet" href="{{asset("proto/vendor/jquery-ui/jquery-ui.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/jquery-ui/jquery-ui.theme.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/bootstrap-multiselect/bootstrap-multiselect.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/morris/morris.css")}}"/>
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
                <li><span>管理员</span></li>
                <li><span>管理员管理</span></li>
            </ol>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section>
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">添加管理员</button>
            </section>
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>

                    <h2 class="card-title">管理员列表</h2>
                </header>
                <div class="card-body">
                    <table class="table table-responsive-md table-hover mb-0">
                        <thead>
                        <tr>
                            <th>用户名</th>
                            <th>手机号码</th>
                            <th>日期</th>
                            <th>操作</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->mobile}}</td>
                                <td>{{date("Y-m-d H:i:s",$user->created_at)}}</td>
                                <td class="actions-hover actions-fade">
                                    <a class="admin_modify" admin_id="{{ $user->id }}" href="#"><i class="fa fa-pencil"></i></a>
                                    <a href="#" admin_id="{{ $user->id }}"  class="delete-post"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    {{--添加管理员--}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">添加管理员</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal admin-add container-fluid">
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 pt-2 pr-0 pl-0">用户名：</label>
                            <input type="text" class="col-sm-9 col-md-10 form-control" name="name">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">手机号：</label>
                            <input type="text" class="col-sm-9 col-md-10 form-control" name="mobile">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">登录密码：</label>
                            <input type="password" class="col-sm-9 col-md-10 form-control" name="password">
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">重复密码：</label>
                            <input type="password" class="col-sm-9 col-md-10 form-control" name="password_repeat">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary float-right" value="确定">
                        </div>
                    </form>
                </div>
            </div>
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

@endsection
@section('js')
    @parent
    <script src="{{asset("proto/vendor/bootstrap-multiselect/bootstrap-multiselect.js")}}"></script>
    <script>
        $(function(){

            $(document).on("click", ".delete-post", function (){
                if(confirm("是否删除这条记录？")){
                    var _this = $(this);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/proto/admin/del",
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


            //添加管理员
            $("#myModal .admin-add").submit(function(e){
            	e.preventDefault();
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "/proto/admin/add",
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

			$("#myModal").on("hidden.bs.modal",function(){
				$("#myModal form .row input").val("");
			});

            //修改管理员
			$(".admin_modify").on("click",function(){
            	$("#modifyModal").modal("show");
            	var admin_id = $(this).attr('admin_id');
            	$("#modifyModal .modal-content").load("/proto/admin_modal/"+admin_id);
            });

            //修改提交
            $("#modifyModal").on("click",".admin_modify",function(e){
            	e.preventDefault();
            	var data = $("#modifyModal .form-admin").serialize();
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "/proto/admin/edit",
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
        })

    </script>
@endsection
