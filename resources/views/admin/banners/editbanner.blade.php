@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/viewbanner')}}" title="Go to banner" class="tip-bottom">Banners</a>
            <a href="#" class="current">Edit  Banner</a> </div>
        <h1>Edit  Banner</h1>
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
                        <h5>Edit Banner</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{url('admin/update/'.$banner->id)}}"
                            name="Add_product" id="Add_product">
                            @csrf
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Banner Image</label>
                                <div class="controls">
                                    <input type="file" name="image" id="image">
                                     <input type="hidden" name="currnt_image" value="{{$banner->image}}">
                                     @if (!empty($banner->image))
                                    <img src="{{asset('images/images_frontend/banners/'.$banner->image)}}"
                                        style="width:40px;"> | <a
                                        href="{{url('admin/deletImage/'.$banner->id)}}"> Delete Image </a>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label"> Tital </label>
                                <div class="controls">
                                    <input type="text" name="ban_name" id="ban_name" value="{{$banner->Title}}">
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea name="ban_dec" id="ban_dec" cols="40" rows="5">{{$banner->description}}</textarea>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Link </label>
                                <div class="controls">
                                    <input type="text" name="link" id="link" value="{{$banner->link}}">
                                </div>
                            </div>

                            <div class="control-group" style="width:50%">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="1"
                                    @if ($banner->status ==1 ) checked
                                    @endif>
                                </div>
                            </div>
                            <div class="form-actions">
<button type="submit" class="btn btn-primary hvr-sweep-top">
                                    Edit Banner</button>                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
