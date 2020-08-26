<!DOCTYPE html>
<html lang="en">
<head>
    <title>AboShope</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/backend_css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/fullcalendar.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/matrix-style.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="{{asset('css/backend_css/matrix-media.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.flaticon.com/authors/pixel-perfect">
    <link href="{{asset('fonts/backend_fornts/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/backend_css/jquery.gritter.css')}}" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>



</head>

<body>
    <!-- Include the header page  -->
    @include('layouts.adminlayout.admin_header')

    <!-- Include the sidebar page  -->
    @include('layouts.adminlayout.admin_sidebar')

    @yield('content')

    <!-- Include the Footer page  -->
    @include('layouts.adminlayout.admin_footer')

    {{-- // validation script for setting page --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('js/backend_js/jquery.min.js')}}"></script>
    <script src="{{asset('js/backend_js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/backend_js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/backend_js/jquery.uniform.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/backend_css/theme.css')}}" />
    <script src="{{asset('js/backend_js/select2.min.js')}}"></script>
    <script src="{{asset('js/backend_js/jquery.validate.js')}}"></script> {{-- // plagin for validations --}}
    <script src="{{asset('js/backend_js/jquery.dataTables.min.js')}}"></script> {{-- // serch on tables--}}
    <script src="{{asset('js/backend_js/matrix.js')}}"></script>{{--  //genral java scrpit --}}
    <script src="{{asset('js/backend_js/matrix.tables.js')}}"></script> {{-- // desgin the tables --}}
    <script src="{{asset('js/backend_js/matrix.form_validation.js')}}"></script> {{-- // use for validation in forms --}}
    <script src="{{asset('js/backend_js/matrix.popover.js')}}"></script> {{-- // plagin use for pop-up slids --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>{{-- //sweet alert for confirmation --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"></script>{{-- //sweet alert for confirmation --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>{{-- //sweet alert for confirmation --}}
</body>

</html>
