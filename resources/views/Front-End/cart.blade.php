<?php
use App\Products;
?>
@extends('layouts.frontlayout.front_desgin')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
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
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php  $totalAmount =0;?>
                    @foreach ($CartDetalies as $item)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{asset('images/images_backend/small_image_size/'.$item->image)}}"
                                    width="100px" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->product_name}}</a></h4>
                            <p>{{$item->product_code}} | {{$item->product_size}} </p>
                        </td>
                        <td class="cart_price">
                            <!-- use new variable for security so hackers can not change the price -->
                            <?php $produc_price = Products::getTheCartPrice($item->product_id,$item->product_size) ?>
                            <p>{{$produc_price}} $</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{url('/cart/'.$item->id.'/1')}}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity"
                                    value="{{$item->quantity}}" autocomplete="off" size="10">
                                @if ($item->quantity > 1)
                                <a class="cart_quantity_down" href="{{url('/cart/'.$item->id.'/-1')}}"> - </a>
                                @endif
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$item->quantity * $produc_price}} $</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="deletItem/{{$item->id}}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php
                    // get the sum of all products in cart Total
                    $totalAmount =$totalAmount + ($item->quantity * $produc_price);
                    ?>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount/coupon code you want to use.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <form action="/cart/apply-coupon" method="post">
                                @csrf
                                <label>Coupon Code :</label>
                                <input type="text" class="form-control" style="padding: 17px" name="cop_code">
                                <button type="submit"
                                    style="border:1px solid #000 ; font-size:15px; margin-top:20px"
                                    class="btn btn-dark hvr-sweep-right">
                                    <span style="color: #fff">Apply Coupon</span>
                                </button> </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">

                    <ul>
                        @if (!empty(Session::get('couponAmount')))
                        <?php $getCurrency = Products::getCurrency($totalAmount - Session::get('couponAmount')) ?>
                        <li >Sub-Total <span>{{$totalAmount}} $</span></li>
                        <li> Discound<span>{{Session::get('couponAmount')}} $</span></li>
                        <li title="{{number_format($getCurrency['RYM_Rate'])}} RYM " class="tip-bottom " >Total<span>{{$totalAmount - Session::get('couponAmount')}} $</span></li>
                        @else
                        <?php $getCurrency = Products::getCurrency($totalAmount) ?>
                        <li title="{{number_format($getCurrency['RYM_Rate'])}} RYM " class="tip-bottom ">Total <span>{{$totalAmount}} $</span></li>
                        @endif
                    </ul>
                    <a href="{{url('/')}}"> <button type="button"
                            style="border:1px solid #000 ; font-size:15px;margin-top:20px;margin-left:40px;margin-bottom:25px;padding:7px 30px;"
                            class="btn btn-dark hvr-sweep-top">
                            <span style="color: #fff">Contniuo Shopping </span>
                        </button></a>
                    <a href="{{url('/checkout')}}"> <button type="button"
                            style="border:1px solid; font-size:15px; margin-top:20px ; margin-bottom:25px; padding:7px 30px;"
                            class="btn btn-info hvr-sweep-bottom check_out">
                            <span style="color: #fff">Ckeck Out</span>
                        </button></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
<!--/#cart_items-->
@endsection
