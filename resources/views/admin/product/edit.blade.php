@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/product/viewProducts')}}" title="Go to product"
                class="tip-bottom">Productss</a>
            <a href="#" class="current">Edit Product</a> </div>
        <h1>Edit Product</h1>
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
                        <h5>Edit Product</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{url('/admin/product/'.$Product->id)}}"
                            name="Edit_product" id="Edit_product" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            <div class="control-group" style="width:41%">
                                <label class="control-label"> Select Category </label>
                                <div class="controls">
                                    <select name="Category_id" id="Category_id">
                                        <?php echo $cat_select_option ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group" style="width:50%">
                                <label class="control-label"> Product Name </label>
                                <div class="controls">
                                    <input type="text" name="proc_name" id="cat_name" value="{{$Product->proc_name}}">
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea name="proc_dec" id="proc_dec" cols="40"
                                        rows="5">{{$Product->descrption}}</textarea>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Material & Care </label>
                                <div class="controls">
                                    <textarea name="care" id="care" cols="40" rows="5">{{$Product->Care}}</textarea>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Product Color</label>
                                <div class="controls">
                                    <input type="text" name="color" id="color" value="{{$Product->color}}">
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Product Price</label>
                                <div class="controls">
                                    <input type="text" name="price" id="price" value="{{$Product->price}}">
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Product Code</label>
                                <div class="controls">
                                    <input type="text" name="code" id="code" value="{{$Product->proc_code}}">
                                </div>
                            </div>
                             <div class="control-group" style="width:50%">
                                <label class="control-label">Featuer Item</label>
                                <div class="controls">
                                    <input type="checkbox"  name="featuer_item" id="status" value="1"
                                    @if ($Product->featuer_item == 1) checked
                                    @endif>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Product Image</label>
                                <div class="controls">

                                    <input type="file" name="image" id="image">
                                    <input type="hidden" name="currnt_image" value="{{$Product->image}}">
                                    @if (!empty($Product->image))
                                    <img src="{{asset('images/images_backend/small_image_size/'.$Product->image)}}"
                                        style="width:40px;"> | <a
                                        href="{{url('admin/product/deletImage/'.$Product->id)}}"> Delete Image </a>
                                    @endif
                                </div>
                            </div>
                             <div class="control-group" style="width:50%">
                                <label class="control-label">Product Video</label>
                                <div class="controls">
                                    <input type="file" name="video" id="video">
                                      @if (!empty($Product->video))
                                        <input type="hidden" name="currnt_video" value="{{$Product->video}}">
                                        <a href="{{url('videos/'.$Product->video)}}" target="_blank" rel="noopener noreferrer"> View</a>
                                        | <a href="{{url('admin/deletVideo/'.$Product->id)}}"> Delete Video </a>
                                   @endif
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary hvr-sweep-top">
                                    Edit Product</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
