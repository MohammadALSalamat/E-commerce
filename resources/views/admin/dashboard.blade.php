@extends('layouts.adminlayout.admin_desgin')
@section('content')

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="quick-actions_homepage">
            <ul class="quick-actions">
                <li class="bg_lb"> <a href="index.html"> <i class="icon-dashboard"></i> <span
                            class="label label-important">20</span> My Dashboard </a> </li>
                <li class="bg_lg span3"> <a href="charts.html"> <i class="icon-signal"></i> Charts</a> </li>
                <li class="bg_ly"> <a href="widgets.html"> <i class="icon-inbox"></i><span
                            class="label label-success">101</span> Widgets </a> </li>
                <li class="bg_lo"> <a href="tables.html"> <i class="icon-th"></i> Tables</a> </li>
                <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li>
                <li class="bg_lo span3"> <a href="form-common.html"> <i class="icon-th-list"></i> Forms</a> </li>
                <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
                <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
                <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
                <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li>

            </ul>
        </div>
        <!--End-Action boxes-->
        <div id="">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load("current", {
                    packages: ["corechart"]
                });
                google.charts.setOnLoadCallback(drawChartuser);

                function drawChartuser() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'total members'],
                        ['Admins', {{$AdminDetailes}}],
                        ['Markting', {{$Markting}}]
                    ]);
                    var options = {
                        title: 'View The Admins',
                        is3D: true,
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                }

                google.charts.load("current", {
                    packages: ["corechart"]
                });
                google.charts.setOnLoadCallback(drawChartcat);

                function drawChartcat() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'total Users'],

                        ['Subscribers', {{$subscribeUsers}}],
                        ['All Users', {{$usersCount }}]
                    ]);
                    var options = {
                        title: 'View The Users',
                        is3D: true,
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('chart_category'));
                    chart.draw(data, options);
                }
                google.charts.load("current", {
                    packages: ["corechart"]
                });
                google.charts.setOnLoadCallback(drawChartpro);

                function drawChartpro() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'total product'],
                        ['Products', {{$Products}}],

                    ]);
                    var options = {
                        title:'View The Number OF Products',
                        is3D: true,

                    };
                    var chart = new google.visualization.PieChart(document.getElementById('chart_Product'));
                    chart.draw(data, options);
                }
                google.charts.load('current', {packages: ['corechart', 'line']});
                google.charts.setOnLoadCallback(drawBasic);

                function drawBasic() {

                    var data = new google.visualization.DataTable();
                    data.addColumn('number', 'X');
                    data.addColumn('number', 'Sells');

                    data.addRows([
                        [1,10],
                        [2,100],
                        [3,450],
                        [4,1000],
                        [5,1600],
                        [6,{{$ordersForJuan}}],
                        [7,900],
                        [8,1200],
                        [10,5900],
                        [11,9000],
                        [12,10000],
                    ]);

                    var options = {
                        hAxis: {
                        title: 'Time'
                        },
                        vAxis: {
                        title: 'Sells Of 2020'
                        }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

                    chart.draw(data, options);
                    }
            </script>
        </div>
        <!--Chart-box-->
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                    <h5>Site Analytics</h5>
                </div>
                <div class="widget-content ">
                    <div class="row-fluid" style="margin-top: 0">
                        <div class="span9">
                            <div class="chart new-informayion">
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="Admin">
                                        <div class="col-sm-12">
                                            <div id="piechart_3d" style="width: 900px; height: 300px;"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="user">
                                        <div class="col-sm-12">
                                            <div id="chart_category" style="width: 900px; height: 300px;"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Product">
                                        <div class="col-sm-12">
                                            <div id="chart_Product" style="width:  900px; height: 300px;"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Sells">
                                        <div class="col-sm-12">
                                            <div id="chart_div" style="width:  900px; height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span3 Left-list">
                            <ul class="site-stats " id="counter">
                                <li class="bg_lh" class="active"><a href="#Admin" data-toggle="tab"><i
                                            class="icon-user"></i>
                                        <strong class="counter" data-count="<?= $usersCount ?>">0</strong>
                                        <small>Total Users</small></a>
                                </li>
                                <li class="bg_lh"><a href="#user" data-toggle="tab"><i class="icon-plus"></i> <strong
                                            class="counter" data-count="{{$AdminDetailes}}">0</strong> <small>New Users
                                        </small></a></li>
                                <li class="bg_lh"><a href="#Product" data-toggle="tab"><i
                                            class="icon-shopping-cart"></i> <strong class="counter"
                                            data-count="<?= $Products ?>">0</strong> <small>Total
                                            Products</small></a></li>
                                <li class="bg_lh"><a href="#Sells" data-toggle="tab"><i class="icon-tag"></i> <strong
                                            class="counter" data-count="<?= $order ?>">0</strong> <small>Total
                                            Orders</small></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End-Chart-box-->
    </div>
</div>
@endsection
