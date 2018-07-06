@extends('porto_admin.layout.master')
@section('title', '仪表盘')
@section('css')
    @parent
    <link rel="stylesheet" href="{{asset("proto/vendor/jquery-ui/jquery-ui.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/jquery-ui/jquery-ui.theme.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/bootstrap-multiselect/bootstrap-multiselect.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/morris/morris.css")}}"/>

    <link rel="stylesheet" href="{{asset("proto/vendor/select2/css/select2.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("proto/vendor/datatables/media/css/dataTables.bootstrap4.css")}}"/>
@endsection
@section('content')
    <header class="page-header">
        <h2>仪表盘</h2>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-xl-3">
                    <section class="card card-featured-left card-featured-primary mb-3">
                        <div class="card-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-primary">
                                        <i class="fa fa-life-ring"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">司机总数</h4>
                                        <div class="info">
                                            <strong class="amount">{{ $driver_count }}</strong>
                                            {{--<span class="text-primary">(14 unread)</span>--}}
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase" href="/proto/driver"
                                           >(查看全部)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-xl-3">
                    <section class="card card-featured-left card-featured-quaternary">
                        <div class="card-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-quaternary">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">导游总数</h4>
                                        <div class="info">
                                            <strong class="amount">{{ $guide_count }}</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase" href="/proto/guide">(查看全部)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    @parent
    <!-- Specific Page Vendor -->
    <script src="{{asset("proto/vendor/jquery-ui/jquery-ui.js")}}"></script>
    <script src="{{asset("proto/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js")}}"></script>
    <script src="{{asset("proto/vendor/jquery-appear/jquery-appear.js")}}"></script>
    <script src="{{asset("proto/vendor/bootstrap-multiselect/bootstrap-multiselect.js")}}"></script>
    <script src="{{asset("proto/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js")}}"></script>
    <script src="{{asset("proto/vendor/flot/jquery.flot.js")}}"></script>
    <script src="{{asset("proto/vendor/flot.tooltip/flot.tooltip.js")}}"></script>
    <script src="{{asset("proto/vendor/flot/jquery.flot.pie.js")}}"></script>
    <script src="{{asset("proto/vendor/flot/jquery.flot.categories.js")}}"></script>
    <script src="{{asset("proto/vendor/flot/jquery.flot.resize.js")}}"></script>
    <script src="{{asset("proto/vendor/jquery-sparkline/jquery-sparkline.js")}}"></script>
    <script src="{{asset("proto/vendor/raphael/raphael.js")}}"></script>
    <script src="{{asset("proto/vendor/morris/morris.js")}}"></script>
    <script src="{{asset("proto/vendor/gauge/gauge.js")}}"></script>
    <script src="{{asset("proto/vendor/snap.svg/snap.svg.js")}}"></script>
    <script src="{{asset("proto/vendor/liquid-meter/liquid.meter.js")}}"></script>
    <script src="{{asset("proto/vendor/jqvmap/jquery.vmap.js")}}"></script>
    <script src="{{asset("proto/vendor/jqvmap/data/jquery.vmap.sampledata.js")}}"></script>
    <script src="{{asset("proto/vendor/jqvmap/maps/jquery.vmap.world.js")}}"></script>
    <script src="{{asset("proto/vendor/jqvmap/maps/continents/jquery.vmap.africa.js")}}"></script>
    <script src="{{asset("proto/vendor/jqvmap/maps/continents/jquery.vmap.asia.js")}}"></script>
    <script src="{{asset("proto/vendor/jqvmap/maps/continents/jquery.vmap.australia.js")}}"></script>
    <script src="{{asset("proto/vendor/jqvmap/maps/continents/jquery.vmap.europe.js")}}"></script>
    <script src="{{asset("proto/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js")}}"></script>
    <script src="{{asset("proto/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js")}}"></script>


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
    <script src="{{asset("proto/js/examples/examples.datatables.default.js")}}"></script>
    <script src="{{asset("proto/js/examples/examples.datatables.row.with.details.js")}}"></script>
    <script src="{{asset("proto/js/examples/examples.datatables.tabletools.js")}}"></script>

@endsection
