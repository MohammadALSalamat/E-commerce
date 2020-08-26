@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/category/viewCategory')}}" title="Go to Category"
                class="tip-bottom">Categories</a> <a href="#" class="current">Create New Category</a> </div>
        <h1>Create New Category</h1>
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
                        <h5>Create New Category</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{url('admin/category/create')}}"
                            name="Add_category" id="Add_category">
                            @csrf
                            <div class="control-group" style="width:50%">
                                <label class="control-label"> Category Name </label>
                                <div class="controls">
                                    <input type="text" name="cat_name"  id="cat_name">
                                </div>
                            </div>
                            <div class="control-group" style="width:41%">
                                <label class="control-label"> Category Level </label>
                                <div class="controls ">
                                    <select name="Level" id="Level">
                                        <option value="0">Main Category</option>
                                        @foreach ($levels as $level)
                                        <option value="{{$level->id}}">{{$level->name}}</option>
                                        @endforeach
                                    </select>
                                    <p class="pt-2"><strong style="color:red"> Note: </strong> Select Main Category to
                                        Create it</p>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea name="cat_dec"  id="cat_dec" cols="40"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">URL</label>
                                <div class="controls">
                                    <input type="text"  name="url" id="url">
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Meta Title</label>
                                <div class="controls">
                                    <input type="text" name="Meta_title" id="Meta_title" required>
                                </div>
                            </div>

                            <div class="control-group" style="width:50%">
                                <label class="control-label">Meta Description</label>
                                <div class="controls">
                                    <textarea name="Meta_dec" id="Meta_dec" cols="20" rows="2" required></textarea>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Meta Keywords</label>
                                <div class="controls">
                                    <textarea name="Meta_Keywords" id="Meta_Keywords" cols="20" rows="2" required></textarea>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                    <input type="checkbox"  name="status" id="status" value="1">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary hvr-sweep-top">
                                    Create New Category</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
