@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('admin/product/viewProducts')}}" title="Go to Featuers" class="tip-bottom">Products</a>
            <a href="#" class="current">Create New Altrentive Image</a> </div>
        <h1>Create New Altrentive Image for the Product</h1>
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
                        <h5>Create New Altrentive Image</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data"
                            action="{{url('admin/addAltrnImage/'.$ProductAttr->id)}}" name="Add_productAttr"
                            id="Add_productAttr">
                            @csrf
                            <input type="hidden" name="proc_id" value="{{ $ProductAttr->id }}">
                            <div class="control-group" style="width:50%">
                                <label class="control-label"> Product Name </label>
                                <label class="control-label"><strong> {{$ProductAttr->proc_name}} </strong> </label>

                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Product Code</label>
                                <label class="control-label"><strong> {{$ProductAttr->proc_code}} </strong> </label>
                            </div>
                             <div class="control-group" style="width:50%">
                                <label class="control-label">Product Image</label>
                                <div class="controls">
                                    <input type="file" name="image[]" multiple="multiple" id="image">
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="submit" value="Add New Image" class="btn btn-primary hvr-sweep-top">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Products Images</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Image ID </th>
                                    <th>Product ID </th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                 @foreach ($alternImage as $Image)
                                <tr>
                                    <td>{{$Image->id}}</td>
                                    <td style="line-height: 80px;">{{$Image->product_id}}</td>
                                    <td style="line-height: 80px;"> <img src="{{asset('images/images_backend/small_image_size/'.$Image->Alter_image)}}" style="width:90px">
                                    </td>
                                    <td>
                                        <a title="Delete The product" class="tip-bottom" <?php /*href="{{url('admin/product/'. $Image-> id)}}"*/?>
                                            href="javascript:"><button rel="{{$Image-> id}}" rel1="DeleteAltrnImage"
                                                type="button" class="btn btn-danger deleteRecord hvr-sweep-right"><i
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
