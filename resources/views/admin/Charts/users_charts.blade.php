<?php
 $last_Month = date('M',strtotime("-2 month"));
 $Prev_Month = date('M',strtotime("-1 month"));
 $currnet_Month = date('M');
$userdata = array(
    array("y" => $previous_Last_Months, "label" => $last_Month),
    array("y" => $previous_Months, "label" => $Prev_Month),
	array("y" => $current_user_month, "label" => $currnet_Month),


);
$Country =
array(

	array("label"=> $userCountry[0]['country'], "y"=> $userCountry[0]['count']),
	array("label"=> $userCountry[1]['country'], "y"=> $userCountry[1]['count']),
)
?>
@extends('layouts.adminlayout.admin_desgin')
@section('content')
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("data", {
	title: {
		text: "Users Register Report"
	},
	axisY: {
		title: "Number of Users"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($userdata, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
var country = new CanvasJS.Chart("country", {
	animationEnabled: true,
	title: {
		text: "Usage Share of User Countries"
	},
	subtitles: [{
		text: "July 2020"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($Country, JSON_NUMERIC_CHECK); ?>
	}]
});
country.render();

}
</script>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/chart/UsersChart')}}" title="Go to User" class="tip-bottom">Charts</a>
            <a href="#" class="current">Explor Users Chart </a> </div>
        <h1>Explor Users Chart</h1>
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
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Users Regirster </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div id="data" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Users Countries </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div id="country" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
