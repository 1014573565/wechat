<!doctype html>
<html class="fixed">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>Bclould System - @yield('title')</title>
    <meta name="keywords" content="HTML5 Admin Template"/>
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    @include("porto_admin.layout.css")
    @section('css')

    @show
    @include("porto_admin.layout.theme_css")
    <style>
        #menu li.active{background:#CCC;}
        #menu li.active a{color:#333;background:transparent !important;}
        @media ( max-width:767px ){
            .header{height:60px;}
            .header .toggle-sidebar-left{left:15px;right:unset;}
            .header .logo{margin:10px 0 0 60px;}
            .userbox:after{width:0;}
            .header .header-right{width:auto;float:unset !important;margin-right:15px;margin-top:5px;background:none;position:fixed;right:15px;top:0;z-index:999;}
            .userbox.show .dropdown-menu{padding:0;top:35px !important;left:-15px !important;}
        }
        .logo:hover,
        .logo:focus {
            text-decoration: none;
        }
        .header .logo {     margin: 17px 0 0 15px;}
    </style>
</head>
<body>
<section class="body">

    <!-- start: header -->
    <header class="header">
        <div class="logo-container">
            <a href="/" class="logo">
                <img alt="Charisma Logo" src="{{ asset('img/logo1.png')}}" class="hidden-xs" style="       width: 110px;
    vertical-align: middle;
    margin-top: -10px;"/>
                <span style="    font-family: 'Shojumaru', cursive, Arial, serif; letter-spacing: 2px; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5); width: 40%; font-size: 20px;    margin-left: 9px;">VTS 车辆调度</span>
{{--                <img src="{{asset("proto/img/logo.png")}}" width="75" height="35" alt="Porto Admin"/>--}}
            </a>
            <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
                 data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">

            <span class="separator"></span>

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    {{--<figure class="profile-picture">
                        <img src="{{asset("/proto/img/!logged-user.jpg")}}" alt="Joseph Doe" class="rounded-circle"
                             data-lock-picture="img/!logged-user.jpg"/>
                    </figure>--}}
                    <div class="profile-info" data-lock-name="{{Auth::user()->name}}"
                         data-lock-email="{{Auth::user()->email}}">
                        <span class="name">{{Auth::user()->name}}</span>
                        <span class="role">administrator</span>
                    </div>

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled mb-2">
                        <li class="divider"></li>
                        {{--<li>
                            <a role="menuitem" tabindex="-1" href="/pages-user-profile"><i class="fa fa-user"></i>
                                设置</a>
                        </li>--}}
                        {{--<li>
                            <a role="menuitem" tabindex="-1" href="/proto/lock" ><i class="fa fa-lock"></i>
                                锁屏</a>
                        </li>--}}
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{ url('/loginOut') }}"><i class="fa fa-power-off"></i>
                                退出</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    </header>
    <!-- end: header -->
    <div class="inner-wrapper">
        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">

            <div class="sidebar-header">
                <div class="sidebar-title">
                    菜单
                </div>
                <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
                     data-fire-event="sidebar-left-toggle">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">
                        <ul class="nav nav-main">
                            <li class="nav-active">
                                <a class="nav-link" href="{{url("/")}}">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    <span>仪表盘</span>
                                </a>
                            </li>
                            @foreach( \App\Menu::GetPortoMenu() as $Menu)
                                <li class="nav-parent">
                                    <a class="nav-link" href="#">
                                        <i class="{{$Menu["icon"]}}" aria-hidden="true"></i>
                                        <span>{{$Menu["header"]}}</span>
                                    </a>

                                    @if(count($Menu["menu"]))
                                        <ul class="nav nav-children">
                                            @foreach($Menu["menu"] as $data)
                                                @if(count($data["submenus"]))
                                                    <li class="nav-parent">
                                                        <a class="nav-link" href="{{$data["link"]}}">
                                                            {{$data["name"]}}
                                                        </a>
                                                        <ul class="nav nav-children">
                                                            @foreach($data["submenus"] as $submenu)
                                                                <li>
                                                                    <a class="nav-link" href="{{$submenu["link"]}}">
                                                                        {{$submenu["name"]}}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="nav-link" href="{{$data["link"]}}">
                                                            {{$data["name"]}}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <script>
                    // Maintain Scroll Position
                    if (typeof localStorage !== 'undefined') {
                        if (localStorage.getItem('sidebar-left-position') !== null) {
                            var initialPosition = localStorage.getItem('sidebar-left-position'),
                                sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                            sidebarLeft.scrollTop = initialPosition;
                        }
                    }
                </script>
            </div>
        </aside>

        <section role="main" class="content-body">
            @yield('content')
        </section>
    </div>
</section>

<!-- Vendor -->
@include("porto_admin.layout.js")
@section('js')
@show
@include("porto_admin.layout.theme_base")
<script>
    $(function(){
    	$("#menu .nav-main li a").on("click",function(){
    		var main_index,child_index,index;
    		main_index = $(this).parent().parent().parent().index();
    		index = $(this).parent().index();
    		if( $(this).parent().parent().parent().parent().hasClass("nav-main") ){
				main_index = $(this).parent().parent().parent().index();
				child_index = "";
            }else{
				child_index = $(this).parent().parent().parent().index();
				main_index = $(this).parent().parent().parent().parent().parent().index();
            }
    		var info = {
    			main_index: main_index,
                child_index: child_index,
                index: index
            };
			localStorage.setItem('key', JSON.stringify(info));
        });
    	//获取session值
		var data = JSON.parse(localStorage.getItem('key'));  //获取localStorage保存的二级菜单id
		$("#menu .nav-main > li").eq(data.main_index).addClass('nav-expanded');
		if( data.child_index != "" ){
			$("#menu .nav-main > li").eq(data.main_index).find(" > ul > li").eq(data.child_index).addClass('nav-expanded');
			$("#menu .nav-main > li").eq(data.main_index).find(" > ul > li").eq(data.child_index).find(" > ul > li ").eq(data.index).addClass("active");
        }else{
			$("#menu .nav-main > li").eq(data.main_index).find(" > ul > li").eq(data.index).addClass("active");
        }
	})
</script>
</body>
</html>