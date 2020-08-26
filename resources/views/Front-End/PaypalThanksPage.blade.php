<?php use App\order; ?>
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
                <h2>One more Step To Complete The Process <strong> Using Paypal </strong></h2>
                <p> To complate the process please Click The button below </p>
            <?php
               //fetch the data from the order table
               $OrderDetailes = order::getOrderDetailes(Session::get('order_id'));
               $spreateNameColumn = explode(' ' ,$OrderDetailes->name );
                ?>
            </div>

            <!-- This Form use to get the money of payment to your account paypal -->
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="abusare45@gmail.com">
                <input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
                <input type="hidden" name="item_number" value="{{Session::get('order_id')}}">
                <input type="hidden" name="amount" value="{{Session::get('Total')}}">
                <input type="hidden" name="no_shipping" value="0">
                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="first_name" value="{{$spreateNameColumn[0]}}">
                <input type="hidden" name="last_name" value="{{$spreateNameColumn[1]}}">
                <input type="hidden" name="address1" value=" {{$OrderDetailes->address }}">
                <input type="hidden" name="city" value="{{$OrderDetailes->city }}">
                <input type="hidden" name="state" value="{{$OrderDetailes->state }}">
                <input type="hidden" name="zip" value="{{$OrderDetailes->postcode }}">
                <input type="hidden" name="email" value="{{$OrderDetailes->user_email }}">
                <input type="hidden" name="return" value="{{url('/Paypal/PaypalThanks')}}">
                <input type="hidden" name="cancel_return" value="{{url('/Paypal/Cancel')}}">
                <input type="hidden" name="lc" value="AU">
                <input type="hidden" name="bn" value="PP-BuyNowBF">
                <input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_paynow_LG.gif" border="0" name="submit"
                    alt="PayPal - The safer, easier way to pay online.">
                <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
            </form>

        </div>
    </div>
</div>

<?php Session::forget('order_id'); // forget couponAmount in seesion
        Session::forget('Total'); ?>
@endsection
