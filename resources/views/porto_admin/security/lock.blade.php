<!doctype html>
<html class="fixed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    @include("porto_admin.layout.css")

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset("proto/css/theme.css")}}" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset("proto/css/skins/default.css")}}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset("proto/css/custom.css")}}">


</head>
<body>
<!-- start: page -->
<section class="body-sign body-locked">
    <div class="center-sign">
        <div class="panel card-sign">
            <div class="card-body">
                <form id="lock">
                    <div class="current-user text-center">
                        <img src="img/!logged-user.jpg" alt="" class="rounded-circle user-image" />
                        <h2 class="user-name text-dark m-0">xihongwei</h2>
                        <p class="user-email m-0">xihongwei@okler.com</p>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-icon">
                            <input id="pwd" type="password" class="form-control form-control-lg" name="password" placeholder="Password" />
                            <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <p class="mt-1 mb-3">
                                {{--<a href="#">Not John Doe?</a>--}}
                            </p>
                        </div>
                        <div class="col-6">
                            <input type="submit" class="btn btn-primary pull-right" value="解屏">
                        </div>
                        <div class="tips col-12 text-center"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include("porto_admin.layout.js")
	<script src="{{asset("proto/vendor/modernizr/modernizr.js")}}"></script>
<script>
    $(function(){
        $("#lock").submit(function(e){
        	e.preventDefault();
        	console.log('ssss');
            $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
                type: "POST",
                url: "/proto/lock",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data){
					if( data.status != 1 ){
						$(".tips").html("开屏密码不正确！").css({color: "#F00"});
						setTimeout(function(){
							$("tips").html("");
                        },2000);
                    }else{
						$(".tips").html(data.message).css({color:"#28a745"});
						//跳转回锁屏之前页面
                    }
                }
            });
        });

        //禁用浏览器返回
		jQuery(document).ready(function () {
			if (window.history && window.history.pushState) {
				$(window).on('popstate', function () {
					/// 当点击浏览器的 后退和前进按钮 时才会被触发，
					window.history.pushState('forward', null, '');
					window.history.forward(1);
				});
			}
			// IE中禁用
			window.history.pushState('forward', null, '');  //在IE中必须得有这两行
			window.history.forward(1);
		});
    })
</script>
</body>
</html>