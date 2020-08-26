@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('admin/view-cms-page')}}" title="Go to CMS Page" class="tip-bottom">CMS-Page</a>
            <a href="#" class="current">Edit CMS Page</a> </div>
        <h1>Edit CMS Page</h1>
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
                        <h5>Edit CMS Page</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data"
                            action="{{url('/admin/updateEdit/'.$CMSShow->id)}}" name="Add_product" id="Add_product">
                            @csrf

                            <div class="control-group" style="width:50%">
                                <label class="control-label"> CMS Title </label>
                                <div class="controls">
                                    <input type="text" name="title" id="title" value="{{$CMSShow->title}}">
                                </div>
                            </div>
                             <div class="control-group" style="width:50%">
                                <label class="control-label">Meta Title</label>
                                <div class="controls">
                                    <input type="text" name="Meta_title" id="Meta_title" value="{{$CMSShow->meta_title}}">
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea name="CMS_dec" id="CMS_dec" cols="40" rows="5" >{{$CMSShow->descrption}}</textarea>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Meta Description</label>
                                <div class="controls">
                                    <textarea name="Meta_dec" id="Meta_dec" cols="20" rows="2" >{{$CMSShow->meta_description}}</textarea>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Meta Keywords</label>
                                <div class="controls">
                                    <textarea name="Meta_Keywords" id="Meta_Keywords" cols="20" rows="2" >{{$CMSShow->meta_keywords}}</textarea>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">CMS URL </label>
                                <div class="controls">
                                    <input type="text" name="url" id="url" value="{{$CMSShow->url}}">
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">CMS Status</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="1"
                                     @if ($CMSShow->status == 1)
                                     checked
                                    @endif>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary hvr-sweep-top">
                                    Edit CMS Page</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
