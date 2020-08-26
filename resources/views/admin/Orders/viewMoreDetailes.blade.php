@extends('layouts.adminlayout.admin_desgin')
@section('content')
<!--main-container-part-->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a
                href="{{url('admin/order/orderview')}}" title="Go to order" class="tip-bottom">Orders</a>
            <a href="#" class="current">View More Detailes</a></div>
        <h1>Order #{{ $MoreDetailes->id}}</h1>
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
        </div>
        @endif
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                        <h5>Order Detailes </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td class="taskDesc"><i class="icon-info-sign"></i> Order Date</td>
                                    <td class="taskStatus"><span
                                            class="in-progress">{{ $MoreDetailes->created_at}}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc"><i class="icon-info-sign"></i> Order Status</td>
                                    <td class="taskStatus"><span class="done">{{ $MoreDetailes->order_status}}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="accordion" id="collapse-group">
                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne"
                                    data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                                    <h5>Billing Detailes</h5>
                                </a> </div>
                        </div>
                        <div class="collapse in accordion-body" id="collapseGOne">
                            <div class="widget-content">
                                <i class="fa fa-user"></i> <strong>Name : </strong>{{ $userDetailes->name}}<br>
                                <i class="fa fa-address-book"></i> <strong>Address :
                                </strong>{{ $userDetailes->address}}<br>
                                <i class="fa fa-building"></i> <strong>City : </strong> {{ $userDetailes->city}}<br>
                                <i class="fa fa-building"></i> <strong>State : </strong>{{ $userDetailes->state}}<br>
                                <i class="fa fa-building"></i> <strong>Country : </strong>
                                {{ $userDetailes->country}}<br>
                                <i class="fa fa-building"></i> <strong>Zip : </strong>{{ $userDetailes->postcode}}<br>
                                <i class="fa fa-phone"></i> <strong>Phone Number :
                                </strong>{{ $userDetailes->phonenumber}}<br>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGTwo"
                                    data-toggle="collapse"> <span class="icon"><i
                                            class="icon-circle-arrow-right"></i></span>
                                    <h5>Update Order Status</h5>
                                </a> </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGTwo">
                            <div class="widget-content">
                                <div class="widget-content nopadding">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Status</th>
                                                <th>Opts</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center" class="taskDesc">#{{ $MoreDetailes->id}}
                                                </td>
                                                <form action="{{url('admin/updateOrderStatus')}}" method="post">
                                                    @csrf
                                                    <!-- add hidden id to send it wth the form -->
                                                    <input type="hidden" name="id" value="{{$MoreDetailes->id}}">
                                                    <td class="taskStatus">
                                                        <span class="in-progress">
                                                            <select name="Select_status" id="select_status">
                                                                <option value="New" @if ($MoreDetailes->order_status ==
                                                                    'New')
                                                                    selected
                                                                    @endif>New</option>
                                                                <option value="Pending" @if ($MoreDetailes->order_status
                                                                    == 'Pending')
                                                                    selected
                                                                    @endif>Pending</option>
                                                                <option value="Approve" @if ($MoreDetailes->order_status
                                                                    == 'Approve')
                                                                    selected
                                                                    @endif>Approve</option>
                                                                <option value="In Process" @if ($MoreDetailes->
                                                                    order_status == 'In Process')
                                                                    selected
                                                                    @endif>In Process</option>
                                                                <option value="Delivered" @if ($MoreDetailes->
                                                                    order_status == 'Delivered')
                                                                    selected
                                                                    @endif>Delivered</option>
                                                                    <option value="Paid" @if ($MoreDetailes->
                                                                    order_status == 'Paid')
                                                                    selected
                                                                    @endif>Paid</option>
                                                                <option value="Cancelled" @if ($MoreDetailes->
                                                                    order_status == 'Cancelled')
                                                                    selected
                                                                    @endif>Cancelled</option>
                                                            </select>
                                                        </span>
                                                    </td>
                                                    <td class="taskOptions"><a href="#" class="tip-top"
                                                            data-original-title="Update"><button type="submit"
                                                                class="btn btn-success hvr-sweep-top"><i
                                                                    class="icon-ok"></i></button></a> </td>
                                                </form>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                        <h5>Customer Detailes </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td class="taskDesc"><i class="icon-info-sign"></i> Customer Name</td>
                                    <td class="taskStatus"><span class="in-progress">{{ $MoreDetailes->name}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="taskDesc"><i class="icon-info-sign"></i> Customer Email</td>
                                    <td class="taskStatus"><span class="done">{{ $MoreDetailes->user_email}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="accordion" id="collapse-group">
                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title"> <a data-parent="#collapse" href="#Second" data-toggle="collapse">
                                    <span class="icon"><i class="icon-ok"></i></span>
                                    <h5>Shipping Detailes</h5>
                                </a> </div>
                        </div>
                        <div class="collapse in accordion-body" id="Second">
                            <div class="widget-content">
                                <i class="fa fa-user"></i> <strong>Name : </strong>{{ $MoreDetailes->name}}<br>
                                <i class="fa fa-address-book"></i> <strong>Address :
                                </strong>{{ $MoreDetailes->address}}<br>
                                <i class="fa fa-building"></i> <strong>City : </strong> {{ $MoreDetailes->city}}<br>
                                <i class="fa fa-building"></i> <strong>State : </strong>{{ $MoreDetailes->state}}<br>
                                <i class="fa fa-building"></i> <strong>Country : </strong>
                                {{ $MoreDetailes->country}}<br>
                                <i class="fa fa-building"></i> <strong>Zip : </strong>{{ $MoreDetailes->postcode}}<br>
                                <i class="fa fa-phone"></i> <strong>Phone Number :
                                </strong>{{ $MoreDetailes->phonenumber}}<br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                    <h5>Product Detailes </h5>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Code</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Size</th>
                            <th scope="col">Product Color</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Product Quantity</th>

                        </tr>
                    </thead>
                    <tbody style="text-align: center">
                        @foreach ($MoreDetailes->orders as $product)
                        <tr>
                            <td style="text-align: center">{{$product->product_id}}</td>
                            <td style="text-align: center">{{$product->product_code}}</td>
                            <td style="text-align: center">{{$product->product_name}}</td>
                            <td style="text-align: center">{{$product->product_size}}</td>
                            <td style="text-align: center">{{$product->product_color}}</td>
                            <td style="text-align: center">{{$product->product_price}}</td>
                            <td style="text-align: center">{{$product->product_quantity}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--main-container-part-->
@endsection
