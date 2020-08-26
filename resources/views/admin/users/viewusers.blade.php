@extends('layouts.adminlayout.admin_desgin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('admin/user/viewusers')}}" title="Go to User" class="tip-bottom">Users</a>
            <a href="#" class="current">View New Users</a> </div>
        <h1>View New Users</h1>
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
        href="{{url('user/ExportUsers')}}"><button type="button"
            class="btn btn-info"  style="background: none ; border:1px solid blue;color:blue"><i class="fa fa-file-export"
                aria-hidden="true"></i>
            Export Users</button></a>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Users </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>User ID </th>
                                    <th>User Name </th>
                                    <th>User Email </th>
                                    <th>User Country</th>
                                    <th>Phone Number</th>
                                    <th>User Status</th>
                                    <th>Registered Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ViewUsers as $view)
                                <tr class="gradeX" style=" text-align: center">
                                    <td style="text-align: center">{{$view-> id}}</td>
                                    <td style="text-align: center">{{$view-> name}}</td>
                                    <td style="text-align: center">{{$view-> email}}</td>
                                    <td style="text-align: center">{{$view-> country}}
                                    </td>
                                    <td style="text-align: center">{{$view-> phonenumber}}</td>
                                    <td style="text-align: center">@if($view-> status == 1)
                                       <span style="color:green">Active</span>
                                       @else
                                       <span style="color:red"> Not Active</span>
                                        @endif</td>
                                    <td style="text-align: center">{{$view->created_at}}</td>
                                    <td style="text-align: center">
                                        <a title="Ban The user" class="tip-bottom"
                                            href="{{url('/admin/user/banusers/'.$view-> id)}}"><button class="btn btn-warning hvr-sweep-left"><i
                                                    class="fa fa-trash" aria-hidden="true"></i>
                                                ban</button></a>
                                        <a title="Delete The User" class="tip-bottom" href="javascript:"><button
                                                rel="{{$view-> id}}" rel1="user" type="button"
                                                class="btn btn-danger deleteRecord hvr-sweep-right"><i class="icon-trash"
                                                    aria-hidden="true"></i>
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
