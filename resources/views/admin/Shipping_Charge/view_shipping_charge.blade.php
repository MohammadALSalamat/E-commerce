@extends('layouts.adminlayout.admin_desgin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/view-shippingCharge')}}" title="Go to Shipping"
                class="tip-bottom">Shipping</a> <a href="#" class="current">Edit Shipping</a> </div>
        <h1>Edit Shipping Charges</h1>
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
                        <h5>Edit Shipping Charges</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th>Country Name</th>
                                    <th>Shipping 0 up to 500KG</th>
                                    <th>Shipping 5001 up to 1000KG</th>
                                    <th>Shipping 1001 up to 2000KG</th>
                                    <th>Shipping 2001 up to 5000KG</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shippingCharge as $shipping)
                                <tr class="gradeX">
                                    <td>{{$shipping-> id}}</td>
                                    <td>{{$shipping-> country}}</td>
                                    <td>{{$shipping-> shipping_charges0_500g}}</td>
                                    <td>{{$shipping-> shipping_charges501_1000g}}</td>
                                    <td>{{$shipping-> shipping_charges1001_2000g}}</td>
                                    <td>{{$shipping -> shipping_charges2001_5000g}}</td>
                                    <td>
                                        <a href="{{url('admin/EditCharges/'. $shipping-> id)}}"><button
                                                type="button" class="btn btn-success hvr-sweep-left"><i
                                                    class="fa fa-edit" aria-hidden="true"></i>
                                                Edit</button></a>
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
