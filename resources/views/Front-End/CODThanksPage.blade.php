@extends('layouts.frontlayout.front_desgin')
@section('content')
<style>
    thanks-wrap {
        background: #FFFFFF;
        padding: 30px;
        margin: 0 auto 10px;
        display: none;
        max-width: 220px;
        text-align: center
    }

    .checkmark {
        max-width: 200px;
        margin-left: 330px;
        text-align: center
    }

    .path {
        stroke-dasharray: 1000;
        stroke-dashoffset: 0;
        animation: dash 2s ease-in-out
    }

    .spin {
        animation: spin 2s;
        transform-origin: 50% 50%
    }

    h2 {
        animation: text 1s
    }

    @keyframes dash {
        0% {
            stroke-dashoffset: 1000
        }

        100% {
            stroke-dashoffset: 0
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg)
        }

        100% {
            transform: rotate(360deg)
        }
    }

    @keyframes text {
        0% {
            opacity: 0
        }

        100% {
            opacity: 1
        }
    }
</style>
<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">Thanks-page</li>
        </ol>
    </div>
</div>
<div class="container text-center">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-2">
            <div class="thanks-wrap">
                <div class="checkmark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 161.2 161.2">
                        <circle class="path" fill="none" stroke="green" stroke-width="4" stroke-miterlimit="10"
                            cx="80.6" cy="80.6" r="62.1" />
                        <path class="path" fill="none" stroke="green" stroke-width="6" stroke-linecap="round"
                            stroke-miterlimit="10" d="M113 52.8l-38.9 55.6-25.9-22" />
                        <circle class="spin" fill="none" stroke="green" stroke-width="4" stroke-miterlimit="10"
                            stroke-dasharray="12.2175,12.2175" cx="80.6" cy="80.6" r="73.9" />
                    </svg>
                </div>
                <h2>Thank you For using Our Service  <strong> Cash On Delivery </strong>.Your Order has been completed.</h2>
                <p> you can see More detailes In History link  </p>
            </div>
            <button class="btn btn-info hvr-sweep-left" style="margin:30px 0 ;padding:0 40px 10px"><a href="{{url('/History')}}"><h2>Check the History</h2></a></button>


        </div>
    </div>
</div>
@endsection
