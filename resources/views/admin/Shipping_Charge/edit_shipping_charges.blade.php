
@extends('layouts.adminlayout.admin_desgin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/view-shippingCharge')}}" title="Go to Shipping"
                class="tip-bottom">Shipping</a> <a href="#" class="current">View Shipping</a> </div>
        <h1>View Shipping Charges</h1>
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
                        <h5>View Shipping Charges</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{url('/admin/updateCharges/'.$getShipping->id)}}"
                            name="Add_category" id="Add_category" novalidate="novalidate">
                            @csrf
                            @method('patch')
                            <div class="control-group">
                                <div class="control-group">
                                    <label class="control-label">Country Name</label>
                                    <div class="controls">
                                        <input type="text" name="country" id="country" value="{{$getShipping->country}}" disabled>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Shipping 0 up to 500KG</label>
                                    <div class="controls">
                                        <input type="text" name="shipping500kg" id="shipping500kg" value="{{$getShipping->shipping_charges0_500g}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Shipping 501 up to 1000KG</label>
                                    <div class="controls">
                                        <input type="text" name="shipping1000kg" id="shipping1000kg" value="{{$getShipping->shipping_charges501_1000g}}">
                                    </div>
                                </div> <div class="control-group">
                                    <label class="control-label">Shipping 1001 up to 2000KG</label>
                                    <div class="controls">
                                        <input type="text" name="shipping2000kg" id="shipping2000kg" value="{{$getShipping->shipping_charges1001_2000g}}">
                                    </div>
                                </div> <div class="control-group">
                                    <label class="control-label">Shipping 2001 up to 5000KG</label>
                                    <div class="controls">
                                        <input type="text" name="shipping5000kg" id="shipping5000kg" value="{{$getShipping->shipping_charges2001_5000g}}">
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary hvr-sweep-top">
                                        Edit Shipping Charge</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
