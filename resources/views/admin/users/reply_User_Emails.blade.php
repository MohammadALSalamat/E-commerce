@extends('layouts.adminlayout.admin_desgin')
@section('content')
<link rel="stylesheet" href="{{asset('css/backend_css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend_css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend_css/colorpicker.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend_css/datepicker.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend_css/matrix-style.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend_css/matrix-media.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend_css/bootstrap-wysihtml5.css')}}" />
<link href="{{asset('fonts/backend_fornts/css/font-awesome.css')}}" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/contact_us')}}" title="Go to View User Message"
                class="tip-bottom">CMS-Page</a>
            <a href="#" class="current">Reply User Message </a> </div>
        <h1>Reply User Message </h1>
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

        <p> <Strong>User Name : </Strong><span>{{$showMessage-> Name}}</span></p>
        <p> <Strong>User Email: </Strong><span>{{$showMessage-> Email}}</span></p>
        <p> <Strong>Subject: </Strong><span>{{$showMessage-> Subject}}</span></p>
        <p> <Strong>Message : </Strong><span>{{$showMessage-> Message}}</span></p>

        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Admin Replay</h5>
                </div>
                <div class="widget-content">
                    <div class="control-group">
                        <form method="post" action="{{url('/admin/SendReplyEmail/'.$showMessage->id)}}">
                            @csrf
                            <div class="controls">
                                @if (!empty($showMessage->admin_reply))
                                <p> <Strong>Admin Reply is : </Strong><span>{{$showMessage-> admin_reply}}</span></p>
                                @else
                                <textarea class="textarea_editor span12" name="reply" rows="6"
                                    placeholder="Enter text ...">

                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-info hvr-sweep-left"><i class="fa fa-reply"
                                    aria-hidden="true"></i>
                                Reply</button>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/backend_js/jquery.min.js')}}"></script>
<script src="{{asset('js/backend_js/jquery.ui.custom.js')}}"></script>
<script src="{{asset('js/backend_js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/backend_js/bootstrap-colorpicker.js')}}"></script>
<script src="{{asset('js/backend_js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/backend_js/jquery.toggle.buttons.js')}}"></script>
<script src="{{asset('js/backend_js/masked.js')}}"></script>
<script src="{{asset('js/backend_js/jquery.uniform.js')}}"></script>
<script src="{{asset('js/backend_js/select2.min.js')}}"></script>
<script src="{{asset('js/backend_js/matrix.js')}}"></script>
<script src="{{asset('js/backend_js/matrix.form_common.js')}}"></script>
<script src="{{asset('js/backend_js/wysihtml5-0.3.0.js')}}"></script>
<script src="{{asset('js/backend_js/jquery.peity.min.js')}}"></script>
<script src="{{asset('js/backend_js/bootstrap-wysihtml5.js')}}"></script>
<script>
    $('.textarea_editor').wysihtml5();
</script>

@endsection
