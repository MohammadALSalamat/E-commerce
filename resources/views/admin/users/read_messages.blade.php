@extends('layouts.adminlayout.admin_desgin')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i
                        class="icon-home"></i>
                    Home</a> <a href="{{ url('admin/contact_us') }}" title="Go to User Messages"
                    class="tip-bottom">CMS-Page</a>
                <a href="#" class="current">View User Messages</a> </div>
            <h1>View User Messages</h1>
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
                            <h5>View User Messages</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($readMessage as $Show)
                                        <tr class="gradeX">
                                            <td>{{ $Show->Name }}</td>
                                            <td>{{ $Show->Email }}</td>
                                            <td>{{ $Show->Subject }}</td>
                                            <td class="center">
                                                @if ($Show->status == 1)
                                                    <span style="color: green">Answerd</span>
                                                @else
                                                    <span style="color: red">Not read </span>
                                                @endif
                                            </td>
                                            <td style="width:20%">
                                                <a title="View More Detailes" class="tip-bottom"
                                                    href="#myModal{{ $Show->id }}" data-toggle="modal"><button type="button"
                                                        class="btn btn-info hvr-sweep-top"><i class="fa fa-eye"
                                                            aria-hidden="true"></i>
                                                        Message</button></a>
                                            </td>
                                        </tr>
                                        <div id="myModal{{ $Show->id }}" class="modal hide" aria-hidden="true"
                                            style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>{{ $Show->title }} Details</h3>
                                            </div>
                                            <div class="modal-body">
                                                <p> <Strong>User Name : </Strong><span>{{ $Show->Name }}</span></p>
                                                <p> <Strong>User Email: </Strong><span>{{ $Show->Email }}</span></p>
                                                <p> <Strong>Subject: </Strong><span>{{ $Show->Subject }}</span></p>
                                                <p> <Strong>Message : </Strong><span>{{ $Show->Message }}</span></p>
                                                <p> <Strong>Status : </Strong><span>
                                                    @if ($Show->status == 1)Replyed @else
                                                            Not Reply yet @endif
                                                    </span></p>
                                                <p> <Strong>Created At :
                                                    </Strong><span>{{ $Show->created_at->format('Y-m-d') }}</span></p>
                                                <p> <Strong>Admin replies: </Strong></p>

                                                @if (empty($Show->admin_reply))
                                                    <span style="color:red"> Admins Has Not Replyd Yet To This Message
                                                    </span>
                                                @else
                                                    <textarea disabled rows="4" cols="24">
                                                    {{ $Show->admin_reply }}
                                                    </textarea>
                                                @endif
                                                </>
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
