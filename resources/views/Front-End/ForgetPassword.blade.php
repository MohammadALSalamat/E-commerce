@extends('layouts.frontlayout.front_desgin')
@section('content')
<div class="top-content" >
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h1 style="color: #444"><strong>Hmmmm!!!</strong> Forgot Password ?</h1>
                </div>
            </div>
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
                <div class="col-sm-6 col-sm-offset-3 text">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Forgot Password</h3>
                                <p>Enter username or email address to get password:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <div class="form-bottom" style="height: 230px">
                            <form role="form" action="{{url('/forgotPassword')}}" method="post" class="login-form">
                                @csrf
                                <div class="form-group">
                                    <label class="sr-only" for="form-username">Username</label>
                                    <input type="email" name="forgetPass" placeholder="Please Enter Your Email"
                                        class="form-username form-control" id="form-username" required>
                                </div>
                                <button type="submit"
                                    style="border:1px solid #00f ;width:100%; font-size:15px;float:left;margin-top:20px ; margin-bottom:30px"
                                    class="btn btn-info hvr-sweep-bottom">
                                    <span style="color: #fff">Recovery</span>
                                </button>

                                <br><br>
                            </form>
                            <a href="{{url('/Frontregister')}}"><button
                                    style="border:1px solid green ;width:30%; font-size:15px;float:left;margin-top:20px"
                                    class="btn btn-success hvr-sweep-left">
                                    <span style="color: #fff">Login</span>
                                </button>
                            </a>
                            <a href="{{url('/Frontregister')}}"><button
                                    style="border:1px solid #f00 ;width:30%; font-size:15px;float:right;margin-top:20px"
                                    class="btn btn-danger hvr-sweep-right">
                                    <span style="color: #fff">Register</span>
                                </button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
