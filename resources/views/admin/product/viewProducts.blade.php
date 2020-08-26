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
        <a title="Export Excel File" class="tip-bottom" style="float: right;margin-right:20px"
            href="{{ url('/products/ExportProducts') }}"><button type="button" class="btn btn-info "
                style="background: none ; border:1px solid blue;color:blue"><i class="fa fa-file-export"
                    aria-hidden="true"></i>
                Export Products</button></a>
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
                                    <th>product Price</th>
                                    <th>Product View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="gradeX">
                                        <td style="line-height: 80px;text-align:center">{{ $product->id }}</td>
                                        <td style="line-height: 80px;text-align:center">{{ $product->category_name }}</td>
                                        <td> <img
                                                src="{{ asset('images/images_backend/small_image_size/' . $product->image) }}"
                                                style="width:80px;">
                                        </td>
                                        <td style="line-height: 80px;text-align:center;">{{ $product->proc_name }}</td>
                                        <td style="line-height: 80px;text-align:center;">{{ $product->price }}</td>
                                        <td style="line-height: 80px;text-align:center;">
                                            @if ($product->featuer_item == 1)
                                                <span style="color: green">Active</span>
                                            @else
                                                <span style="color: red">Disable</span>
                                            @endif
                                        </td>
                                        <td style="line-height: 80px;text-align:center;width:38%;">
                                            <a title="View More Detailes" class="tip-bottom"
                                                href="#myModal{{ $product->id }}" data-toggle="modal"><button type="button"
                                                    class="btn btn-primary hvr-sweep-top"><i class="fa fa-eye"
                                                        aria-hidden="true"></i>
                                                    View</button></a>
                                            <a title="Edit The product" class="tip-bottom"
                                                href="{{ url('admin/product/' . $product->id . '/edit') }}"><button
                                                    type="button" class="btn btn-success hvr-sweep-bottom"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i>
                                                    Edit</button></a>
                                            <a title="Delete The product" class="tip-bottom"
                                                {{-- // Create the pop-up view
                                                --}} <div id="myModal{{ $product->id }}"
                                                class="modal hide" aria-hidden="true" style="display: none;">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>{{ $product->proc_name }} Full Details</h3>
                                                </div>
                                                <div class="modal-body d-flex">
                                                    <div class="row d-flex">
                                                        <div class="col-4"><img
                                                                src="{{ asset('images/images_backend/small_image_size/' . $product->image) }}"
                                                                style="width:95%;padding:20px">
                                                        </div>
                                                        <div class="col-8 font-weight-bold float-right">
                                                            <div style="padding-left:20px"><strong style="color:red">product
                                                                    ID
                                                                    :</strong> {{ $product->id }}</div>
                                                            <hr>
                                                            <div style="padding-left:20px"><strong
                                                                    style="color:red">Category ID :
                                                                </strong> {{ $product->cat_id }}</div>
                                                            <hr>
                                                            <div style="padding-left:20px"><strong
                                                                    style="color:red">Category Name :
                                                                </strong> {{ $product->category_name }}</div>
                                                            <hr>
                                                            <div style="padding-left:20px"><strong style="color:red">product
                                                                    Name
                                                                    :</strong> {{ $product->proc_name }}</div>
                                                            <hr>
                                                            <div style="padding-left:20px"><strong
                                                                    style="color:red">Descrption :
                                                                </strong> {{ $product->descrption }}</div>
                                                            <hr>
                                                            <div style="padding-left:20px"><strong style="color:red">Product
                                                                    Price :
                                                                </strong> {{ $product->price }}</div>
                                                            <hr>
                                                            <div style="padding-left:20px"><strong style="color:red">Product
                                                                    Code :
                                                                </strong> {{ $product->proc_code }}</div>
                                                            <hr>
                                                            <div style="padding-left:20px"><strong style="color:red">Product
                                                                    Color
                                                                    :</strong> {{ $product->color }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                    </div>
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
