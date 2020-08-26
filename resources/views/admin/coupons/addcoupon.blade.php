@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('admin/viewCoupons')}}" title="Go to Coupon" class="tip-bottom">Coupons</a>
            <a href="#" class="current">Create New Coupon</a> </div>
        <h1>Create New Coupon</h1>
    </div>

    <div class="container-fluid">
        <hr>
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
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Create New Coupon</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post"
                            action="{{url('admin/coupon/create')}}" name="Add_copon" id="Add_copon"
                            >
                            @csrf

                            <div class="control-group" style="width:50%">
                                <label class="control-label"> Coupon Code </label>
                                <div class="controls">
                                    <input type="text" name="cop_code" id="cop_code" minlength="5" maxlength="10" required autocomplete="off">
                                </div>
                            </div>
                            <div class="control-group" style="width:41%">
                                <label class="control-label"> Coupon Amount Type </label>
                                <div class="controls">
                                    <select name="cop_type" id="cop_type" required>
                                        <option value="Precentage">Precentage</option>
                                        <option value="Fixed">Fixed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group" style="width:50%">
                                <label class="control-label">Coupon Amount</label>
                                <div class="controls">
                                    <input type="number" name="cop_amount" id="cop_amount" required min="0" autocomplete="off">
                                </div>
                            </div>

                            <div class="control-group" style="width:50%">
                                <label class="control-label">Coupon Expiry</label>
                                <div class="controls">
                                    <input type="date" name="cop_exp" id="cop_exp" required>
                                </div>
                            </div>
                             <div class="control-group" style="width:50%">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="1">
                                </div>
                            </div>
                            <div class="form-actions">
<button type="submit" class="btn btn-primary hvr-sweep-top">
                                    Add New Coupon</button>                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
