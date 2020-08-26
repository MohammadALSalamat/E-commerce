@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/view-currency')}}" title="Go to Currency"
                class="tip-bottom">Currencies</a> <a href="#" class="current">Edit Currency</a> </div>
        <h1>Edit Currency</h1>
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
                        <h5>Edit Currency</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{url('admin/updatecurrency/'.$getCurrency->id)}}"
                            name="Add_category" id="Add_category">
                            @csrf
                            <div class="control-group" style="width:50%">
                                <label class="control-label"> Currency Code </label>
                                <div class="controls">
                                    <input type="text" name="cur_code"  id="cur_code" value="{{$getCurrency->currency_code}}">
                                </div>
                            </div>
                              <div class="control-group" style="width:50%">
                                <label class="control-label"> Exchange Rate</label>
                                <div class="controls">
                                    <input type="text" name="Ex_rate"  id="Ex_rate" value="{{$getCurrency->exchange_rate}}">
                                </div>
                            </div>

                            <div class="control-group" style="width:50%">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                    <input type="checkbox"  name="status" id="status" value="1" @if ($getCurrency->status == 1) checked

                                    @endif>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary hvr-sweep-top">
                                    Edit Currency</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
