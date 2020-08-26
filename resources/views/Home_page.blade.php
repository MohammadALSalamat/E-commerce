@extends('layouts.frontlayout.front_desgin')
@section('content')
<!-- Include the slide Show page  -->
@include('layouts.frontlayout.slidShow')
<section onload="foo()">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <!-- Include the left side bar page  -->
                @include('layouts.frontlayout.leftsidebar')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items & show the items here-->

                    <h2 class="title text-center">Features Items</h2>
                    @foreach ($Showproduct as $Show)

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{asset('images/images_backend/small_image_size/'.$Show->image)}}"
                                        alt="" />
                                    <h2>{{ $Show->price}} $</h2>
                                    <p>{{ $Show->proc_name}}</p>
                                    <a href="{{url('/quickview/'.$Show->id)}}" style="border-color:#000 "
                                        class="btn btn-dark hvr-sweep-top add-to-cart"></a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <img src="{{asset('images/images_backend/small_image_size/'.$Show->image)}}"
                                            alt="" style="width:100%" />
                                        <h2>{{ $Show->price}} $</h2>
                                        <p>{{ $Show->proc_name}}</p>
                                        <a href="{{url('/quickview/'.$Show->id)}}"
                                            class="btn btn-dark hvr-sweep-top add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>View More</a>
                                    </div>
                                </div>
                            </div>

                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li>
                                        <a href="{{url('/AddToWishlist/'.$Show->id)}}">

                                            <i class="fa fa-heart"></i>
                                            Add to wishlist
                                        </a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>

                                </ul>
                            </div>

                        </div>
                    </div>

                    @endforeach

                </div>
                <!-- Display the pagination-->
                <div align="center">{{ $Showproduct->links() }}</div>
            </div>
        </div>
    </div>
</section>
@endsection
