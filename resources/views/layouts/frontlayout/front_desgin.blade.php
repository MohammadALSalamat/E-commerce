<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="">
        <title> @if(!empty($meta_title)) {{$meta_title}} @else Home | E-com @endif </title>
        @if(!empty($meta_description))
        <meta name="description" content="{{$meta_description}}">@endif

        @if(!empty($meta_keywords))
        <meta name="keywords" content="{{$meta_keywords}}">@endif

        <link href="{{asset('css/frontend_css/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/frontend_css/css/strength.css')}}" rel="stylesheet">
        <link href="{{asset('css/frontend_css/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/frontend_css/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('css/frontend_css/css/prettyPhoto.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/frontend_css/css/theme.css')}}" />
        <link rel="stylesheet" href="{{asset('css/frontend_css/css/forgetpass.css')}}" />
        <link href="{{asset('css/frontend_css/css/price-range.css')}}" rel="stylesheet">
        <link href="{{asset('css/frontend_css/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('css/frontend_css/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('css/frontend_css/css/zoom.css')}}" rel="stylesheet">
        <link href="{{asset('css/frontend_css/css/responsive.css')}}" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
        <link rel="shortcut icon" href="{{asset('images/images_frontend/images/ico/favicon.ico')}}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144"
            href="{{asset('images/images_frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114"
            href="{{asset('images/images_frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72"
            href="{{asset('images/images_frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed"
            href="{{asset('images/images_frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
        <script>
            function foo() {
            alert("Page Still Under Testing You Can Check it out And You Can Leave Message Below To Rate The Work");
        }
        </script>
    </head>
    <!--/head-->

    <body>
        <!-- Include the header page  -->
        @include('layouts.frontlayout.front_header')




        <!-- Include the Contnent of page  -->
        @yield('content')

        <!-- Include the Footer page  -->
        @include('layouts.frontlayout.front_footer')



        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{asset('js/frontend_js/js/jquery.js')}}"></script>
        <script src="{{asset('js/frontend_js/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/frontend_js/js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('js/frontend_js/js/price-range.js')}}"></script>
        <script src="{{asset('js/frontend_js/js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('js/frontend_js/js/jquery.validate.js')}}"></script>
        <script src="{{asset('js/frontend_js/js/strength.js')}}"></script>
        <script src="{{asset('js/frontend_js/js/main.js')}}"></script>
        <script src="{{asset('js/frontend_js/js/zoom.js')}}"></script>

        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ecade31f23908c7">
        </script>

    </body>

</html>
