<?php
use App\Products;
?>

@extends('layouts.frontlayout.front_desgin')
@section('content')
<section>
<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><a href="#">Single Product</a></li>
            <li >
                @if(!empty($breadCrumb))
                <?= $breadCrumb ?>
                @endif
            </li>
            <li><a href="#" class="active">
            {{$quickview->proc_name}}
            </a></li>
        </ol>
    </div>
</div>
    <div class="container">
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
        <div class="row">
            <div class="col-sm-3">
                <!-- Include the left side bar page  -->
                @include('layouts.frontlayout.leftsidebar')

            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <div class="zoom">
                                <img id="MainImage"
                                    src="{{ asset( 'images/images_backend/small_image_size/'.$quickview->image )}}"
                                    style="width:280px" alt="" />
                            </div>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    @foreach ($alternImage as $item)
                                    <div class="zoom">
                                        <img class="ChangeImage"
                                            src="{{asset('images/images_backend/small_image_size/'.$item->Alter_image )}}"
                                            width="80px" alt="">
                                    </div>
                                    @endforeach
                                </div>

                            </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                    <!-- This form is the one who will pass information to add cart table  -->
                    <div class="col-sm-7">
                        <form action="{{url('/addTocart')}}" method="post" name="addcartForm" id="addcartForm">
                            <div class="product-information">
                                @csrf
                                <!--
                                * first step is to make a hidden form information to submit all information
                                -->
                                <input type="hidden" name="product_id" value="{{$quickview->id}}">
                                <input type="hidden" name="product_name" value="{{$quickview->proc_name}}">
                                <input type="hidden" name="product_color" value="{{$quickview->color}}">
                                <input type="hidden" name="product_code" value="{{$quickview->proc_code}}">
                                <!-- give the price id to change it from the jquery main.js  -->
                                <input type="hidden" name="product_price" id="price" value="{{$quickview->price}}">

                                <!--/product-information-->
                                <img src="{{asset('/images/images_frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                                <h2>{{$quickview->proc_name}}</h2>
                                <p>Product Code: {{$quickview->proc_code}}</p>
                                <select name="size" id="size" style="width:130px; padding:7px 0; margin:10px 0"
                                    required>
                                    <option value="0"> Select Size</option>
                                    @foreach ($quickview->ProcAttr as $size)
                                    <option value="{{$quickview->id}}-{{$size-> size}}"> {{$size-> size}}</option>
                                    @endforeach
                                </select>
                                <img src={{asset("images/images_frontend/images/product-details/rating.png")}} alt="" />
                                <span>
                                    <?php $getCurrency = Products::getCurrency($quickview->price) ?>
                                    <span id="ChangePrice">
                                    {{($quickview->price)}} $<br>
                                    <?=number_format($getCurrency['RYM_Rate'])?>

                                    </span>
                                    <label>Quantity:</label>
                                    <input type="text" name="quantity" value="1" />
                                    <?php if ($totalStock > 0){?>
                                    <button id="AvalibalCart" type="submit" style="border:1px solid #000"
                                        name="Wishlist" value="AddCart" class="btn btn-dark hvr-sweep-right cart">
                                        <strong style="color: #fff">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </strong>
                                    </button>

                                    <?php }else{?>
                                    <button id="disAvalibalCart" type="submit" style="border:1px solid #000 ;"
                                        class="btn btn-dark hvr-sweep-right cart" disabled>
                                        <strong style="color: #fff">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </strong>
                                    </button>

                                    <?php }?>
                                </span>
                                <?php if ($totalStock > 0){?>
                                    <button type="submit"
                                        id="Wishlist" name="Wishlist" value="Wishlist" class="btn btn-info hvr-sweep-right">
                                        <strong style="color: #fff">
                                            <i class="fa fa-heart"></i>
                                            Add to WishList
                                        </strong>
                                    </button>
                                    <?php }?>
                                <p><b>Availability : </b><span id="availabilty">
                                    @if($totalStock > 0)
                                    <strong style="color: green"> In Stock </strong>
                                    @else
                                    <strong style="color:red"> Sorry ,Out Of Stock </strong>
                                    @endif</span></p>
                                <p><b>Condition:</b> New</p>
                                <p><b>Delivery:</b>
                                    <input type="text" name="pincode" id="checkpincode"
                                        placeholder="Check your city's Zip Code"
                                        style=" margin:10px; border:none ; background:none; border-bottom:1px solid #000; width:180px "
                                        >
                                    <button type="button" id="pincode" class="btn btn-light hvr-sweep-left "
                                        style="border:1px solid #000; font-size:15px"><strong
                                            style="color: blue ;">Check</strong> </button></p>
                                <strong id="sendErrormessage"></strong><br>
                                <p style="margin-top: 15px"><b>Brand:</b> Abo-Store</p>
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="sharethis-inline-share-buttons"></div>
                            </div>
                            <!--/product-information-->
                        </form>
                    </div>
                </div>
                <!--/product-details-->
                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Details</a></li>
                            <li><a href="#Care" data-toggle="tab">Materials & Care</a></li>
                            <li><a href="#Delivary" data-toggle="tab">Delivary Options</a></li>
                            <li><a href="#Video" data-toggle="tab">Product Video</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details">
                            <div class="col-sm-12">
                                <p style="padding:20px">{{$quickview -> descrption}}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="Care">
                            <div class="col-sm-12">
                                <p style="padding:20px">{{$quickview -> Care}}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="Delivary">
                            <div class="col-sm-12">
                                <ol>
                                    <li>100% orginal Product</li>
                                    <li>100% Free Delivary</li>
                                    <li>Cash on Delivary</li>
                                    <li> online Payment Methods </li>
                                    <li>Return the product with in 3 days only </li>
                                    <li>open service 24 hours </li>
                                </ol>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Video">
                            <div class="col-sm-12">
                                <video src="{{asset('videos/'.$quickview -> video)}}" controls frameborder="0"
                                    width="100%" height="400px"></video>
                            </div>
                        </div>

                        <div class="tab-pane fade active in" id="reviews">
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur.</p>
                                <p><b>Write Your Review</b></p>

                                <form action="#">
                                    <span>
                                        <input type="text" placeholder="Your Name" />
                                        <input type="email" placeholder="Email Address" />
                                    </span>
                                    <textarea name=""></textarea>
                                    <b>Rating: </b> <img src="{{asset('/images/images_frontend/images/product-details/rating.png')}}" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/category-tab-->

                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($relatedItems->chunk(3) as $chunk)
                            <div class="item active">
                                @foreach ($chunk as $item)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{asset('images/images_backend/small_image_size/'.$item->image )}}"
                                                    alt="" />
                                                <h2>{{$item-> price}} $</h2>
                                                <p>{{$item-> proc_name}}</p>
                                                <a href="{{url('/quickview/'.$item->id)}}"><button type="button"
                                                        class="btn btn-default add-to-cart"><i
                                                            class="fa fa-eye"></i>View More</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            @endforeach
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <!--/recommended_items-->

            </div>
        </div>
    </div>
</section>
@endsection
