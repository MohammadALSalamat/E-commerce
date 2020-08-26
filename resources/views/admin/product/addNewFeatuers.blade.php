@extends('layouts.adminlayout.admin_desgin')
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i
                        class="icon-home"></i>
                    Home</a> <a href="{{ url('/admin/product/viewProducts') }}" title="Go to products"
                    class="tip-bottom">products</a>
                <a href="#" class="current">View products</a> </div>
            <h1>View products</h1>
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
                        <h5>View Products</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>product ID </th>

                                    <th>Category Name </th>
                                    <th>product Image</th>
                                    <th>product Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="gradeX">
                                        <td>{{ $product->id }}</td>
                                        <td style="line-height: 80px;">{{ $product->category_name }}</td>
                                        <td> <img
                                                src="{{ asset('images/images_backend/small_image_size/' . $product->image) }}"
                                                style="width:80px;">
                                        </td>
                                        <td style="line-height: 80px;">{{ $product->proc_name }}</td>
                                        <td style="line-height: 80px; width:45%">
                                            <a title="Create New Attribute" class="tip-bottom"
                                                href="{{ url('admin/addProductAttr/' . $product->id) }}"><button
                                                    type="button" class="btn btn-success hvr-sweep-left "><i
                                                        class="fa fa-tags" aria-hidden="true"></i>
                                                    Create Attribute </button></a>
                                            <a title="Create New Altrntive Image" class="tip-bottom"
                                                href="{{ url('admin/addAltrnImage/' . $product->id) }}"><button
                                                    type="button" class="btn btn-primary hvr-sweep-right "><i
                                                        class="fa fa-image" aria-hidden="true"></i>
                                                    Create Altrntive Image </button></a>
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
