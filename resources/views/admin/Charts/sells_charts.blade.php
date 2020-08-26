<?php
 $last_Month = date('M',strtotime("-2 month"));
 $Prev_Month = date('M',strtotime("-1 month"));
 $currnet_Month = date('M');
$dataPoints = array(
    array("y" => $previous_Last_Months, "label" => $last_Month),
    array("y" => $previous_Months, "label" => $Prev_Month),
	array("y" => $current_order_month, "label" => $currnet_Month),
);

?>
@extends('layouts.adminlayout.admin_desgin')
@section('content')
<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Order Chart"
	},
	axisY: {
		title: "Number Of Orders"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## Products",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/chart/SellsChart')}}" title="Go to User" class="tip-bottom">Charts</a>
            <a href="#" class="current">Explor Sells Chart </a> </div>
        <h1>Product Sells Chart</h1>
    </div>
    <div class="container-fluid">
        <!-- Display the error masseges from AdminController -->
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <!-- Display the logout masseges from AdminController -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
            @endif
        </div>
        <hr>
        <a title="Export Excel File" class="tip-bottom" style="float: right;margin-right:20px"
        href="{{url('user/ExportUsers')}}"><button type="button"
            class="btn btn-info"  style="background: none ; border:1px solid blue;color:blue"><i class="fa fa-file-export"
                aria-hidden="true"></i>
            Export Products Sells</button></a>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Sells Chart </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

