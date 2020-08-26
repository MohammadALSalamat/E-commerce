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
                <li class="active">WishList</li>
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
                        <td class="total">Action</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php  $totalAmount =0;?>
                    @foreach ($viewWishlistPage as $item)
                    <tr>
                        <td  class="cart_product">
                            <a href=""><img src="{{asset('images/images_backend/small_image_size/'.$item->image)}}"
                                    width="100px" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->product_name}}</a></h4>
                            <p>{{$item->product_code}} | {{$item->product_size}} </p>
                        </td>
                        <td class="cart_price">
                            <!-- use new variable for security so hackers can not change the price -->
                            {{-- <?php $produc_price = Products::getTheCartPrice($item->product_id,$item->product_size) ?> --}}
                            <p>{{$item->product_price}} $</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                {{$item->quantity}}
                            </div>
                        </td>
                        <form action="{{url('/addTocart')}}" method="post" name="addcartFormWishlist" id="addcartForm">
                            @csrf
                            <td style="width:10%">
                                <!--
                                * first step is to make a hidden form information to submit all information
                                -->
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <input type="hidden" name="product_id" value="{{$item->product_id}}">
                                <input type="hidden" name="product_name" value="{{$item->product_name}}">
                                <input type="hidden" name="product_color" value="{{$item->product_color}}">
                                <input type="hidden" name="product_code" value="{{$item->product_code}}">
                                <input type="hidden" name="size" value="{{$item->product_size}}">
                                <!-- give the price id to change it from the jquery main.js  -->
                                <input type="hidden" name="product_price" id="price" value="{{$item->product_price}}">
                                <input type="hidden" name="quantity" id="quantity" value="{{$item->quantity}}">
                                <input type="hidden" name="user_email" id="user_email" value="{{$item->user_email}}">
                                <a title="Add Item To Cart" href="{{url('/addTocart')}}"> <button type="submit" name="FormWishlist"
                                    id="FormWishlist" value="FormWishlist"
                                    style="border:1px solid; font-size:15px;  margin:10px; padding:7px 30px;"
                                    class="btn btn-info hvr-sweep-bottom check_out">
                                    <span style="color: #fff">Add To Cart</span>
                                    </button>
                                </a>
                            </td>
                            <td class="cart_delete">
                                <a title="Delete The Item" class="cart_quantity_delete" href="deletItemFromwishlist/{{$item->id}}"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </form>
                    </tr>
                    <?php
                    // get the sum of all products in cart Total
                    $totalAmount =$totalAmount + ($item->quantity * $item->product_price);
                    ?>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#do_action-->
<!--/#cart_items-->
@endsection
