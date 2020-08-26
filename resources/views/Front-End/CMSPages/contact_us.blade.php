@extends('layouts.frontlayout.front_desgin')
@section('content')
    <section>
        <div id="contact-page" class="container" style="margin-top: 0">
            <div class="breadcrumbs" style="margin-bottom: 0">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Contact_Us</li>
                </ol>
            </div>
            <div class="bg">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="title text-center">Contact <strong>Us</strong></h2>

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
                <div class="row" style="margin-top: 0">
                    <div class="col-sm-8">
                        <div class="contact-form">
                            <h2 class="title text-center">Get In Touch</h2>
                            <div class="status alert alert-success" style="display: none"></div>
                            <form id="main-contact-form" class="contact-form row" name="contact-form"
                                action="{{ url('/page/sendcontactissue') }}" method="post">
                                @csrf
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" required="required"
                                        placeholder="Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" required="required"
                                        placeholder="Email">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="subject" class="form-control" required="required"
                                        placeholder="Subject">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea name="message" id="message" required="required" class="form-control" rows="8"
                                        placeholder="Your Message Here"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit"
                                        style="border:1px solid #000 ; font-size:15px;width:100% ;margin-top:20px"
                                        class="btn btn-dark hvr-sweep-top">
                                        <span style="color: #fff">Submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contact-info">
                            <h2 class="title text-center">Contact Info</h2>
                            <address>
                                <p><strong style="color: #c44;">Abo-</strong>Shope</p>
                                <p>935 W. Webster Ave New Streets Kuala Lumpur, IL 60614, KL</p>
                                <p>Malaysia</p>
                                <p>Mobile: +60178464650</p>
                                <p>Fax: 1-714-252-0026</p>
                                <p>Email: Alomda.alslmat@gmail.com</p>
                            </address>
                            <div class="social-networks">
                                <h2 class="title text-center">Social Networking</h2>
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/#contact-page-->
    </section>
@endsection
