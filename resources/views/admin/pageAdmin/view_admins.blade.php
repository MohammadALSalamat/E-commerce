@extends('layouts.adminlayout.admin_desgin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/viewAdmins')}}" title="Go to Admins & sub-admins" class="tip-bottom">Admins</a>
            <a href="#" class="current">View Admins</a> </div>
        <h1>View  Admins</h1>
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
                        <h5>View Admins </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Admin ID </th>
                                    <th>Admin Name </th>
                                    <th>Admin POsition</th>
                                    <th>Admin Status</th>
                                    <th>Registered Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ViewAdmins as $view)
                                <tr class="gradeX" style=" text-align: center">
                                    <td style="text-align: center">{{$view-> id}}</td>
                                    <td style="text-align: center">{{$view-> username}}</td>
                                    <td style="text-align: center">{{$view-> position}}</td>
                                    <td style="text-align: center">
                                        @if($view-> status == 1)
                                        <span style="color: green">Active</span>
                                        @else
                                        <span style="color: red">deactivate</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">{{$view->created_at}}</td>
                                    <td style="text-align: center ; width:15%">
                                        <a title="Edit The Admin" class="tip-bottom"
                                            href="{{url('/admin/editAdmin/'.$view-> id)}}"><button class="btn btn-success hvr-sweep-left"><i
                                                    class="fa fa-edit" aria-hidden="true"></i>
                                                Edit</button></a>
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
