@extends('porto_admin.layout.master')
@section('title', '错误')
@section('css')
    @parent
    <link rel="stylesheet" href="{{asset("proto/vendor/jquery-ui/jquery-ui.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/jquery-ui/jquery-ui.theme.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/bootstrap-multiselect/bootstrap-multiselect.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/morris/morris.css")}}"/>
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
                <li><span>Pages</span></li>
                <li><span>错误</span></li>
            </ol>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <a href="#" onclick=history.back()>{{$message}}</a>
    </div>
@endsection
@section('js')
    @parent
@endsection
