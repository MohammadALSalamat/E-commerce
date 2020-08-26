@extends('layouts.frontlayout.front_desgin')
@section('content')
<section id="form" style="margin:50px 0">
    <!--form-->
    <div class="container">
         <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">User Settings</li>
            </ol>
        </div>
        <div class="row">
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="col-sm-4 col-sm-offset-1">

                <div class="login-form">
                    <!--login form-->
                    <h2>Update your account Information</h2>

                    <form action="{{url('/account/update/'.$userDetailes->id)}}" method="post">
                        @csrf
                        <input class="form-control " id="name" name="name" type="text" placeholder="User Name" value="{{$userDetailes->name}}"
                            required />
                        <input class="form-control "  id="address" name="address" type="text" placeholder="User address"
                            value="{{$userDetailes->address}}" />
                        <input id="city" class="form-control " name="city" type="text" placeholder="User city"
                            value="{{$userDetailes->city}}" />
                        <input id="state" class="form-control " name="state" type="text" placeholder="User state"
                            value="{{$userDetailes->state}}" />
                        <select style="padding: 10px 0" id="country" name="country">
                            <option value="">Select Your Country</option>
                            @foreach ($countries as $country)
                            <option value="{{$country->country_name}}" @if ($country->
                                country_name==$userDetailes->country)
                                selected
                                @endif> {{ $country->country_name}} </option>
                            @endforeach
                        </select>
                        <input style="margin-top: 10px" class="form-control " id="postcode" name="postcode" type="text" placeholder="postcode"
                            value="{{$userDetailes->postcode}}" />
                        <input id="mobile" name="mobile" class="form-control " type="text" placeholder="User Phone Number"
                            value="{{$userDetailes->phonenumber}}" />
                       <button type="submit" style="border:1px solid #000 ; font-size:15px;width:100% ;margin-top:20px"  class="btn btn-dark hvr-sweep-top">
                                <span style="color: #fff">Update Account</span>
                            </button>
                        </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Update Password!</h2>
                    <form class="form-horizontal" method="post" action="{{url('/account/updatePass')}}"
                        name="password_validate" id="password_validate" novalidate="novalidate">
                        @csrf
                        <div class="control-group">
                            <label class="control-label">Current Password</label>
                            <div class="controls">
                                <input type="password" name="current_pass" class="form-control " id="current_pass" />
                                <span id="changPass"></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">New Password</label>
                            <div class="controls">
                                <input type="password" class="form-control " name="new_pwd" id="new_pwd" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Confirm password</label>
                            <div class="controls">
                                <input type="password" class="form-control " name="con_pwd" id="con_pwd" />
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" style="border:1px solid #000 ; font-size:15px;width:100% ;margin-top:20px"  class="btn btn-dark hvr-sweep-top">
                                <span style="color: #fff">Updat Password</span>
                            </button>
                                </form> </div> <!--/sign up form-->
                        </div>
                </div>
            </div>
</section>
<!--/form-->
@endsection
