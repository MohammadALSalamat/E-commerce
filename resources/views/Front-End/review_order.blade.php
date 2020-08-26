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
                <li class="active">Order Review</li>
            </ol>
        </div>
         @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 ">
                    <style type="text/css">
                        .myTable {
                            width: 100%;
                            background-color: #fff;
                            border-collapse: collapse;
                        }

                        .myTable th {
                            background-color: rgb(241, 240, 240);
                            color: #444;
                            width: 50%;
                            text-align: center
                        }

                        .myTable td,
                        .myTable th {
                            padding: 20px;
                            border: 1px solid #ccc;
                        }

                        strong {
                            margin-left: 10px;
                            margin-right: 10px;
                            font-size: 15px;
                            font-weight: bolder
                        }
                    </style>
                    <!-- End Styles -->
                    <table class="myTable table table-striped">
                        <tr>
                            <th>Billing Address</th>
                            <th>Shipping Address</th>
                        </tr>
                        <tr>
                            <td> <strong> Name : </strong> {{$userDetailes->name}}</td>
                            <td> <strong> Name : </strong> {{$shippingDetales->name}}</td>
                        </tr>
                        <tr>
                            <td> <strong> Address : </strong> {{$userDetailes->address}}</td>
                            <td> <strong> Address : </strong> {{$shippingDetales->address}}</td>
                        </tr>
                        <tr>
                            <td> <strong> City : </strong> {{$userDetailes->city}}</td>
                            <td> <strong> City : </strong> {{$shippingDetales->city}}</td>
                        </tr>
                        <tr>
                            <td> <strong> State : </strong> {{$userDetailes->state}}</td>
                            <td> <strong> State : </strong> {{$shippingDetales->state}}</td>
                        </tr>
                        <tr>
                            <td> <strong> Country : </strong> {{$userDetailes->country}}</td>
                            <td> <strong> Country : </strong> {{$shippingDetales->country}}</td>
                        </tr>
                        <tr>
                            <td> <strong> Postcode : </strong> {{$userDetailes->postcode}}</td>
                            <td> <strong> Postcode : </strong> {{$shippingDetales->postcode}}</td>
                        </tr>
                        <tr>
                            <td> <strong> Phone Number : </strong> {{$userDetailes->phonenumber}}</td>
                            <td> <strong> Phone Number : </strong> {{$shippingDetales->phonenumber}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>
        <div class="table-responsive cart_info">
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
                            <?php $product_price = Products::getTheCartPrice($item->product_id,$item->product_size) ?>

                            <p>{{$product_price}} $</p>
                        </td>
                        <td class="cart_quantity">
                            {{$item->quantity}}
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$item->quantity * $product_price}} $</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="deletItem/{{$item->id}}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php
                    // get the sum of all products in cart Total
                    $totalAmount =$totalAmount + ($item->quantity * $product_price);
                    ?>
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>{{$totalAmount}} $</td>
                                </tr>
                                <tr>
                                    <td>Coupon Amount</td>
                                    <td>
                                        @if (!empty(Session::get('couponAmount')))
                                        {{Session::get('couponAmount')}} $
                                        @else
                                        0
                                        @endif</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>{{$resualt = $getshippingCharges->shipping_charges0_500g}} $</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>{{ $GrantTotal = $totalAmount - Session::get('couponAmount') + $resualt}} $</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <form id="paymentForm" name="paymentForm" method="POST" action="{{url('/paymentMethod')}}">
            @csrf
            <!-- Send the Grante total as hidden file  -->
            <input type="hidden" name="Total" value="{{$GrantTotal}}">
            <input type="hidden" name="Shippingcharge" value="{{$resualt}}">
            <div class="payment-options">
                <span>
                    <label><Strong>Select Your Payment Method : </Strong></label>
                </span>
                <span>
                    <label><input type="radio" name="payment" id="COD" value="COD" > Cash On Delivery</label>
                </span>
                <span>
                    <label><input type="radio" name="payment" id="Paypal" value="Paypal" > Paypal</label>
                </span>
                <span style="float: right">
                    <button type="submit" id="submit-payment"
                            style="border:1px solid #000 ; font-size:15px;padding:7px 30px;"
                            class="btn btn-dark hvr-sweep-right">
                            <span style="color: #fff">Place Order  <i class="fa fa-arrow-right"></i> </span>
                        </button>
                </span>
            </div>
        </form>
    </div>
</section>
<!--/#cart_items-->
<!--/form-->

@endsection
