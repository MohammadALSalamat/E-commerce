@extends('layouts.adminlayout.admin_desgin')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i
                        class="icon-home"></i>
                    Home</a> <a href="{{ url('admin/view-cms-page') }}" title="Go to CMS Page"
                    class="tip-bottom">CMS-Page</a>
                <a href="#" class="current">View CMS Page</a> </div>
            <h1>View CMS Page</h1>
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
                            <h5>View CMS Page</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>CMS Title</th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($CMSShow as $Show)
                                        <tr class="gradeX">
                                            <td>{{ $Show->title }}</td>
                                            <td>{{ $Show->url }}</td>
                                            <td class="center">
                                                @if ($Show->status == 1)
                                                    <span style="color: green">Active</span>
                                                @else
                                                    <span style="color: red">Not Active</span>
                                                @endif
                                            </td>
                                            <td style="width:43%">
                                                <a title="View More Detailes" class="tip-bottom"
                                                    href="#myModal{{ $Show->id }}" data-toggle="modal"><button type="button"
                                                        class="btn btn-info hvr-sweep-top"><i class="fa fa-eye"
                                                            aria-hidden="true"></i>
                                                        View More</button></a>
                                                <a title="Edit This Item" class="tip-bottom"
                                                    href="{{ url('admin/CMSEdit/' . $Show->id) }}"><button type="button"
                                                        class="btn btn-success hvr-sweep-left"><i class="fa fa-pencil"
                                                            aria-hidden="true"></i>
                                                        Edit</button></a>
                                                <a title="Delete This Item" class="tip-bottom" <?php
                                                    /*href="{{ url('admin/CMSDelete/'. $Show->id) }}" */ ?>
                                                    href="javascript:"><button rel="{{ $Show->id }}" rel1="CMSDelete"
                                                        type="button" class="btn btn-danger hvr-sweep-right deleteRecord"><i
                                                            class="fa fa-window-close" aria-hidden="true"></i>
                                                        Delete</button></a>
                                            </td>
                                        </tr>
                                        <div id="myModal{{ $Show->id }}" class="modal hide" aria-hidden="true"
                                            style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>{{ $Show->title }} Details</h3>
                                            </div>
                                            <div class="modal-body">
                                                <p> <Strong>Title : </Strong><span>{{ $Show->title }}</span></p>
                                                <p> <Strong>Description : </Strong><span>{{ $Show->descrption }}</span></p>
                                                <p> <Strong>Url : </Strong><span>{{ $Show->url }}</span></p>
                                                <p> <Strong>Status : </Strong><span>
                                                    @if ($Show->status == 1)Active @else
                                                            Not Active @endif
                                                    </span></p>
                                                <p> <Strong>Created At :
                                                    </Strong><span>{{ $Show->created_at->format('Y-m-d') }}</span></p>
                                            </div>
                                        </div>
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
