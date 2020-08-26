<?php
    use App\Products; // use this line to call the function cartCount from model products jsut as below:-

?>
@extends('layouts.frontlayout.front_desgin')
@section('content')
<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li>@if(!empty($ParentBreadCrmb))
                <?= $ParentBreadCrmb?></li>
            @endif
            <li>
                @if(!empty($breadCrumb))
                <?= $breadCrumb ?></li>
            @endif</li>
        </ol>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            <!-- Include the left side bar page  -->

            <form action="{{url('/product-filtter')}}" method="post">
                @csrf
                @if (!empty($url))
                <input type="hidden" name="url" value="{{$url}}">
                @endif
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        <div class="panel panel-default">

                            @foreach ($Showcategory as $MainCat)
                            @if ($MainCat->status == "1")
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle="collapse" data-parent="#accordian"
                                            href="#{{$MainCat->name}}">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            {{ $MainCat->name }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="{{$MainCat->name}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach ($MainCat->frontCategory as $subCat)
                                            @if ($subCat->status == "1")
                                            <li><a href="{{asset('/product/'.$subCat->url)}}"> {{$subCat->name}}</a>
                                                <span ID="sidebar">
                                                    <?php echo $countCategory =products::CategoryCount($subCat->id) ;?>
                                                </span>
                                            </li>
                                            @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @if (!empty($url))
                    <div class="brands_products">
                        <!--Now we have to check the URL to Get the colors that user want to felter  -->
                        <h2>Colors</h2>
                        <div class="brands-name" style="margin-top: 0px">
                            @foreach ($ColorArry as $color)
                            <?php
                                if (!empty($_GET['color'])) {
                                $ColorArr =explode('-', $_GET['color']);
                                    if(in_array($color, $ColorArr)){
                                        $colorCheck = "checked";
                                    }else{
                                        $colorCheck = "";
                                    }
                                }else{
                                        $colorCheck = "";
                                }

                                ?>
                            <label class="container checkbox1">{{ $color }}
                                <input type="checkbox" name="colorFillter[]" id="{{ $color }}" value="{{ $color }}"
                                    onchange="javascript:this.form.submit();" {{ $colorCheck}}>
                                <span class="checkmark"></span>
                            </label>
                            @endforeach

                        </div>
                    </div>
                    <div class="brands_products">
                        <!--Now we have to check the URL to Get the colors that user want to felter  -->
                        <h2>Size</h2>
                        <div class="brands-name" style="margin-top: 0px">
                            @foreach ($sizeArray as $size)
                            <?php
                                if (!empty($_GET['size'])) {
                                $sizeArr =explode('-', $_GET['size']);
                                    if(in_array($size, $sizeArr)){
                                        $sizeCheck = "checked";
                                    }else{
                                        $sizeCheck = "";
                                    }
                                }else{
                                        $sizeCheck = "";
                                }
                                ?>
                            <label class="container checkbox1">{{ $size }}
                                <input type="checkbox" name="sizeFillter[]" id="{{ $size }}" value="{{ $size }}"
                                    onchange="javascript:this.form.submit();" {{ $sizeCheck}}>
                                <span class="checkmark"></span>
                            </label>
                            @endforeach

                        </div>
                    </div>
                    <!--/brands_products-->

                    <div class=" price-range">
                        <!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b>$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div>
                    <!--/price-range-->
                    @endif
                </div>
            </form>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items & show the items here-->
                    <h2 class="title text-center">@if(!empty($searchProduct))
                        <span style="color: green;text-transform: capitalize">Resualt OF Search About
                            {{$searchProduct}}</span>
                        @else
                        Features Items
                        @endif
                    </h2>
                    @foreach ($Showproduct as $Show)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{asset('images/images_backend/small_image_size/'.$Show->image)}}"
                                        alt="" />
                                    <h2>{{ $Show->price}} $</h2>
                                    <p>{{ $Show->proc_name}}</p>
                                    <button class="btn btn-dark add-to-cart"></button>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <img src="{{asset('images/images_backend/small_image_size/'.$Show->image)}}"
                                            alt="" style="width:100%" />
                                        <h2>{{ $Show->price}} $</h2>
                                        <p>{{ $Show->proc_name}}</p>
                                        <a href="/quickview/{{$Show-> id}}"><button type="button"
                                                style="border:1px solid #000 ; font-size:15px;padding:7px 30px;"
                                                class="btn btn-dark hvr-sweep-bottom">
                                                <span style="color: #fff"> <i class="fa fa-shopping-cart"></i> Add To
                                                    Cart </span>
                                            </button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    <div align='center'>{{$Showproduct->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
