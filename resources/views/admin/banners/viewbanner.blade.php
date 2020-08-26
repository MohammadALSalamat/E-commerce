@extends('layouts.adminlayout.admin_desgin') @section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i
                        class="icon-home"></i>
                    Home</a> <a href="{{ url('/admin/viewbanner') }}" title="Go to Banners" class="tip-bottom">Banners</a>
                <a href="#" class="current">View Banners</a> </div>
            <h1>View Banners</h1>
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
                        <h5>View Banners</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th> Banner ID </th>
                                    <th>Banner Image</th>
                                    <th>Banner Title</th>
                                    <th>Description</th>
                                    <th>Url</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($views as $view)
                                    <tr class="gradeX">
                                        <td style="line-height: 80px">{{ $view->id }}</td>
                                        <td style="line-height: 80px"><img
                                                src="{{ asset('images/images_frontend/banners/' . $view->image) }}" alt=""
                                                width="80px"></td>
                                        <td style="line-height: 80px">{{ $view->Title }}</td>
                                        <td style="width:45%">{{ $view->description }}</td>
                                        <td style="line-height: 80px;width:7%">{{ $view->link }}</td>
                                        <td style="line-height: 80px" class="center">
                                            @if ($view->status == 1)
                                            <span style="color:green">Active</span> @else
                                                <span style="color:Red">Not Active</span> @endif
                                        </td>
                                        <td style="line-height: 80px ; width:25%">
                                            <a href="{{ url('admin/' . $view->id . '/edit') }}"><button type="button"
                                                    class="btn btn-success hvr-sweep-left"><i class="fa fa-edit"
                                                        aria-hidden="true"></i>
                                                    Edit</button></a>
                                            <a <?php /*href="{{ url('admin/view/'. $view->id) }}" */ ?> href="javascript:"><button rel="{{ $view->id }}"
                                                    rel1="delete" type="button"
                                                    class="btn btn-danger hvr-sweep-right deleteRecord"><i
                                                        class="fa fa-window-close" aria-hidden="true"></i>
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
