@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/setting')}}" title="Go to Setting" class="tip-bottom">Setting</a> <a
                href="#" class="current" disabled>Admin Setting</a> </div>
        <h1>Admin Settings </h1>
    </div>
    <div class="widget-box">
        <div class="widget-title">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab1">Profile</a></li>
                <li><a data-toggle="tab" href="#tab2">Password</a></li>
            </ul>
        </div>
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
        <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                <h5>{{ Session::get('AdminSession')}} Profile</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <form class="form-horizontal" method="post" action="{{url('/admin/updateprofile')}}"  enctype="multipart/form-data" name="basic_validate"
                                    id="basic_validate">
                                    @csrf
                                    <div class="control-group">
                                        <label class="control-label">Your Name</label>
                                        <div class="controls">
                                            <input type="text" name="username" id="required" required value="{{$username->username}}">
                                        </div>
                                    </div>
                                    <div class="control-group" style="width:50%">
                                        <label class="control-label">User Avater</label>
                                        <div class="controls">
                                            <input type="file" name="image" id="image">
                                            <input type="hidden" name="currnt_image" value="{{$username->avatar}}">
                                            @if (!empty($username->avatar))
                                            <img src="{{asset('images/images_backend/UserAvater/'.$username->avatar)}}"
                                                style="width:40px;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary hvr-sweep-right">
                                            Update Profile</button> </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab2" class="tab-pane">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                <h5>Update Password</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <form class="form-horizontal" method="post" action="{{url('/admin/update_pass')}}"
                                    name="password_validate" id="password_validate" novalidate="novalidate">
                                    @csrf
                                    @method('patch')
                                    <div class="control-group">
                                        <label class="control-label">User Name</label>
                                        <div class="controls">
                                            <input type="text" name="username" id="username" readonly
                                                value="{{$username->username}}" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Current Password</label>
                                        <div class="controls">
                                            <input type="password" name="current_pass" id="current_pass" />
                                            <span id="changPass"></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">New Password</label>
                                        <div class="controls">
                                            <input type="password" name="new_pwd" id="new_pwd" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Confirm password</label>
                                        <div class="controls">
                                            <input type="password" name="con_pwd" id="con_pwd" />
                                        </div>
                                    </div>
                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary hvr-sweep-right">
                                            Update Password</button> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
