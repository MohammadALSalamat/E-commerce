@extends('layouts.frontlayout.front_desgin')
@section('content')
<section id="form" style="margin-top: 50px">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-1 text-center" style="margin-bottom: 30px">
                <h1 style="color: #444"><strong>Welcome!!!</strong> <span>Signup</span> & <span>Signin</span> Page</h1>
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
        <div class="col-sm-4 col-sm-offset-1">

            <div class="login-form">
                <!--login form-->
                <h2>Login to your account</h2>

                <form action="{{url('/Frontlogin')}}" method="post">
                    @csrf
                    <input id="email" name="email" type="email" placeholder="Email Address" />
                    <input id="pass" name="pass" type="password" placeholder="Password" />
                    <button type="submit" style="border:1px solid blue ; font-size:15px;width:100% ;margin-top:20px"
                        class="btn btn-info hvr-sweep-right">
                        <span style="color: #fff">Login</span>
                    </button>
                    <a href="{{url('/forgotPassword')}}">
                        <button type="button" style="border:1px solid red ; font-size:15px;width:100% ;margin-top:20px"
                            class="btn btn-danger hvr-sweep-left">
                            <span style="color: #fff">Forgot Password ?</span>
                        </button>
                    </a>
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
                <h2>New User Signup!</h2>
                <form id="Signup" name="Signup" action="{{url('/storedata')}}" method="POST">
                    @csrf
                    <input id="name" name="name" type="text" placeholder="Name" />
                    <input id="email" name="email" type="email" placeholder="Email Address" />
                    <input id="myPassword" name="pass" type="password" placeholder="Password" />

                    <button type="submit" style="border:1px solid #000 ; font-size:15px;width:100% ;margin-top:20px"
                        class="btn btn-dark hvr-sweep-bottom">
                        <span style="color: #fff">Register</span>
                    </button> </form>
            </div>
            <!--/sign up form-->
        </div>
    </div>
    </div>
</section>
<!--/form-->
@endsection
