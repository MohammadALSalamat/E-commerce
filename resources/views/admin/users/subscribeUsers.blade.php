@extends('layouts.adminlayout.admin_desgin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('admin/user/viewusers')}}" title="Go to User" class="tip-bottom">Users</a>
            <a href="#" class="current">View Subscribe Users</a> </div>
        <h1>View Subscribe Users</h1>
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
        <a title="Export The Emails" class="tip-bottom" style="float: right;margin-right:20px"
        href="{{url('user/ExportSubscriberEmail')}}"><button type="button"
            class="btn btn-info " style="background: none ; border:1px solid blue;color:blue"><i class="fa fa-file-export"
                aria-hidden="true"></i>
            Export</button></a>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Subscribe Users </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>User ID </th>
                                    <th>User Email </th>
                                    <th>User Status</th>
                                    <th>Subscribe Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Subscribe as $view)
                                <tr class="gradeX" style=" text-align: center">
                                    <td style="text-align: center">{{$view-> id}}</td>
                                    <td style="text-align: center">{{$view-> email}}</td>
                                    <td style="text-align: center">@if($view-> status == 1)
                                        <span style="color:green">Subscribe</span>
                                        @else
                                        <span style="color:red"> Not Subscribe</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">{{$view->created_at}}</td>
                                    <td style="text-align: center">@if($view-> status == 1)
                                        <a title="DeaActive the subscribtion" class="tip-bottom"
                                            href="{{url('user/updateStatusSubscriber/'.$view-> id)}}"><button type="button"
                                                class="btn btn-danger hvr-sweep-top"><i class="fa fa-window-close"
                                                    aria-hidden="true"></i>
                                                DeaActive Subscribe</button></a>
                                        @else
                                        <a title="Activate the subscribtion" class="tip-bottom"
                                            href="{{url('user/updateStatusSubscriber/'.$view-> id)}}"><button type="button"
                                                class="btn btn-success hvr-sweep-top"><i class="icon icon-ok"
                                                    aria-hidden="true"></i>
                                                Activate Subscribe</button></a>
                                        @endif
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
