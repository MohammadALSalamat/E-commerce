    @extends('layouts.frontlayout.front_desgin')
    @section('404')

    <div class="container text-center">
        <div class="logo-404">
            <a href="{{asset('/')}}"><img {{asset('images/images_frontend/images/home/logo.png')}}" alt="" /></a>
        </div>
        <div class="content-404">
            <img src="{{asset('images/images_frontend/images/404/404.png')}}" class="img-responsive" alt="" />
            <h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
            <p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
         <a href="{{asset('/')}}" class="btn btn-dark hvr-sweep-top"> Back to Home</a>
        </div>

    </div>
    @endsection
