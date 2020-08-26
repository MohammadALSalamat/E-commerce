@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('admin/product/viewProducts')}}" title="Go to product"
                class="tip-bottom">Products</a>
            <a href="#" class="current">Create New Attribute</a> </div>
        <h1>Create New Attribute for the Product</h1>
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
                        <h5>Create New Attribute</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data"
                            action="{{url('admin/addProductAttr/'.$ProductAttr->id)}}" name="Add_productAttr"
                            id="Add_productAttr">
                            @csrf
                            <input type="hidden" name="proc_id" value="{{ $ProductAttr->id }}">
                            <div class="control-group" style="width:50%">
                                <label class="control-label"> Product Name </label>
                                <label class="control-label"><strong> {{$ProductAttr->proc_name}} </strong> </label>

                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Product Color</label>
                                <label class="control-label"><strong> {{$ProductAttr->color}} </strong> </label>

                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Product Code</label>
                                <label class="control-label"><strong> {{$ProductAttr->proc_code}} </strong> </label>
                            </div>
                            <div class="control-group" style="width:100%; padding:20px">
                                <div class="field_wrapper">
                                    <div>
                                        <input type="text" name="sku[]" id="sku" placeholder="Enter Sku Product"
                                            required style="width:150px" />
                                        <input type="text" name="size[]" id="Size" placeholder="Enter Product Size"
                                            required style="width:150px" />
                                        <input type="text" name="price[]" id="price" placeholder="Enter Product price"
                                            required style="width:150px" />
                                        <input type="text" name="stock[]" id="stock" placeholder="Enter Product stock"
                                            required style="width:150px" />
                                        <a href="javascript:void(0);" class="add_button tip-bottom"
                                            title="Add New Fields"><i class="fa fa-plus-circle"
                                                style="font-size:20px;padding:0px 10px" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Add Attributes" class="btn btn-primary hvr-sweep-top">
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
                        <h5>View Products Attributes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="{{url('admin/EditProductAttr/'.$ProductAttr->id)}}" method="post">
                            @csrf
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>Attribute ID </th>
                                        <th>SKU</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ProductAttr['ProcAttr'] as $Attr)
                                    <tr class="gradeX">
                                        <td>
                                            <input type="hidden" name="idAttr[]" value="{{$Attr->id}}">
                                            {{$Attr-> id}}
                                        </td>
                                        <td style="line-height: 80px;">{{$Attr-> sku}}</td>
                                        <td style="line-height: 80px;">{{$Attr-> size}}</td>
                                        <td style="line-height: 80px;">
                                            <input type="text" name="priceAttr[]" value="{{$Attr-> price}}">

                                        </td>
                                        <td style="line-height: 80px;">
                                            <input type="text" name="stockAttr[]" value="{{$Attr-> stock}}">
                                        </td>
                                        <td style="line-height: 80px;">
                                            <button type="submit" class="btn btn-primary hvr-sweep-right">
                                                Update </button>
                                            <a href="javascript:"><button rel="{{$Attr-> id}}" rel1="productAttr"
                                                    type="button" class="btn btn-danger deleteRecord hvr-sweep-right"><i
                                                        class="fa fa-window-close" aria-hidden="true"></i>
                                                    Delete</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
