<!doctype html>
<html class="fixed">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <meta name="keywords" content="HTML5 Admin Template"/>
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">
    <!-- Mobile Metas -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- Specific Page Vendor CSS -->
@include("porto_admin.layout.css")

<!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="{{asset("proto/vendor/jquery-ui/jquery-ui.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/jquery-ui/jquery-ui.theme.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/bootstrap-multiselect/bootstrap-multiselect.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/morris/morris.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/pnotify/pnotify.custom.css")}}"/>

    @include("porto_admin.layout.theme_css")

    <style>
        .logo:hover,
        .logo:focus {
            text-decoration: none;
        }
    </style>
</head>
<body>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo float-left" style="    margin-top: 27px;">
            <img alt="Charisma Logo" src="{{ asset('img/logo1.png')}}" class="hidden-xs" style="   width: 110px;
    vertical-align: middle;
    margin-top: -23px;"/>
            <span style=" font-family: 'Shojumaru', cursive, Arial, serif; letter-spacing: 2px; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5); width: 40%; font-size: 30px;">VTS 车辆调度</span>
        </a>
        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-right">
                <h2 class="title text-uppercase font-weight-bold m-0"><i class="fa fa-user mr-1"></i> Sign In</h2>
            </div>
            <div class="card-body">
                <form method="post" class="form-login">
                    <div class="form-group mb-3">
                        <label>Mobile</label>
                        <div class="input-group input-group-icon">
                            <input name="mobile" type="text" class="form-control form-control-lg" required
                                   autocomplete='mobile'/>
                            <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="clearfix">
                            <label class="float-left">Password</label>
                            {{--<a href="pages-recover-password.html" class="float-right">Lost Password?</a>--}}
                        </div>
                        <div class="input-group input-group-icon">
                            <input name="password" type="password" class="form-control form-control-lg" required
                                   autocomplete='password'/>
                            <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="checkbox-custom checkbox-default">
                                <input id="RememberMe" name="rememberme" type="checkbox"/>
                                <label for="RememberMe">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary mt-2">登录</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2018. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->
<!-- Vendor -->
<script src="{{asset("proto/vendor/jquery/jquery.js")}}"></script>
<script src="{{asset("proto/vendor/jquery-browser-mobile/jquery.browser.mobile.js")}}"></script>
<script src="{{asset("proto/vendor/popper/umd/popper.min.js")}}"></script>
<script src="{{asset("proto/vendor/bootstrap/js/bootstrap.js")}}"></script>
<script src="{{asset("proto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js")}}"></script>
<script src="{{asset("proto/vendor/common/common.js")}}"></script>
<script src="{{asset("proto/vendor/nanoscroller/nanoscroller.js")}}"></script>
<script src="{{asset("proto/vendor/magnific-popup/jquery.magnific-popup.js")}}"></script>
<script src="{{asset("proto/vendor/jquery-placeholder/jquery-placeholder.js")}}"></script>
@include("porto_admin.layout.theme_base")
<!-- Specific Page Vendor -->
<script src="{{asset("proto/vendor/pnotify/pnotify.custom.js")}}"></script>
<script>
    (function ($) {
        'use strict';
        $(".form-login").submit(function (event) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/login',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.status != 1) {
                        new PNotify({
                            title: '登录',
                            text: data.message,
                            type: 'error',
                            shadow: false
                        });
                    } else {
                        location.href = '/';
                    }
                },
                error: function (e) {
                    if (e.readyState === 4 && e.status === 422) {
                        for (var i in e.responseJSON) {
                            new PNotify({
                                title: '登录',
                                text: e.responseJSON[i][0],
                                type: 'error',
                                shadow: false
                            });
                        }
                    }
                }
            })
        })
    }).apply(this, [jQuery]);
</script>
</body>
</html>