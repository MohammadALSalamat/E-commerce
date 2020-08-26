@extends('layouts.adminlayout.admin_desgin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('admin/coupon/viewCoupons')}}" title="Go to Coupon" class="tip-bottom">Coupons</a>
            <a href="#" class="current">View New viewCoupons</a> </div>
        <h1>View New Coupon</h1>
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
                        <h5>View Coupons </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th>Coupon Code </th>
                                    <th>Amount Type</th>
                                    <th>Coupon Amount</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewCoupon as $view)
                                <tr class="gradeX" style=" text-align: center">
                                    <td style="line-height: 80px;text-align: center">{{$view-> id}}</td>
                                    <td style="line-height: 80px;text-align: center">{{$view-> coupon_code}}</td>
                                    <td style="line-height: 80px;text-align: center">{{$view-> amount_type}}</td>
                                    <td style="line-height: 80px;text-align: center">{{$view-> coupon_amount}}
                                        @if($view->amount_type == 'Precentage') % @else $ @endif </td>
                                    <td style="line-height: 80px;text-align: center">{{$view-> expiry_date}}</td>
                                    <td style="line-height: 80px;text-align: center">@if($view->status == 1) Active @else not Active @endif</td>
                                    <td style="line-height: 80px;width:25%;text-align: center">
                                        <a title="Edit The view" class="tip-bottom"
                                            href="{{url('admin/coupon/'. $view-> id .'/edit')}}"><button class="btn btn-success hvr-sweep-left"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i>
                                                Edit</button></a>
                                        <a title="Delete The view" class="tip-bottom"
                                            <?php /*href="{{url('admin/coupon/'. $view-> id)}}"*/?>
                                            href="javascript:"><button rel="{{$view-> id}}" rel1="couponDelete" class="btn btn-danger hvr-sweep-right deleteRecord"><i
                                                    class="fa fa-window-close" aria-hidden="true"></i>
                                                Delete</button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
