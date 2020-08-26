@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/category/viewCategory')}}" title="Go to Category"
                class="tip-bottom">Admins</a> <a href="#" class="current">Create New admin</a> </div>
        <h1>Create New admin</h1>
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
                        <h5>Create New Admin</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{url('admin/StoreAdminData')}}"
                            name="Add_category" id="Add_category">
                            @csrf
                            <div class="control-group" style="width:41%">
                                <label class="control-label"> Position </label>
                                <div class="controls">
                                    <select name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="markting">Markting</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label"> User Name </label>
                                <div class="controls">
                                    <input type="text" name="user_name"  id="user_name" required>
                                </div>
                            </div>
                            <div class="control-group" style="width:50%">
                                <label class="control-label"> Passsord </label>
                                <div class="controls">
                                    <input type="password" name="pass"  id="pass" required>
                                </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary hvr-sweep-top">
                                    Add User</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
