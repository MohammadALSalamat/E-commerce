    <?php
    use App\Http\Controllers\Controller;

    use App\User;
    use App\Wishlist;
    use App\Products; // use this line to call the function cartCount from model products jsut as below:-
    $cartCount =Products::CartCount();
    $WishListCount =Wishlist::WishListCount();
    $maincategory = Controller::maincategory();
    $getUserDetailes = User::get();
    foreach($getUserDetailes as $user){}
    ?>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +60 1784-64650</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i>info@abo-shoe.online</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">

                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{url('/')}}">
                                <h1 style="font-size:35px;margin:0;"> <strong style="color: #c44;font-size: 37px;">Abo-</strong>Shope
                                </h1>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="{{url('/cart')}}"><i class="fa fa-shopping-basket fa-lg">
                                            <span ID="lblCartCount">
                                                @if (!empty(Auth::check()))
                                                {{$cartCount}}
                                                @else
                                                0
                                                @endif
                                            </span></i></a>
                                    <div class="dropdown-content">
                                        <?php  $totalAmount =0;
                                        ?>
                                        @if (!empty(Auth::check()))
                                         @foreach($CartDetalies  as $item)
                                        <?php
                                            // get the sum of all products in cart Total
                                            $totalAmount =$totalAmount + ($item->quantity * $item->product_price);
                                            ?>
                                        <div class="row drop" style="flex-wrap: nowrap ">
                                            <div class="col-5">
                                                <img src="{{asset('images/images_backend/small_image_size/'.$item->image)}}"
                                                    width="40px" alt="">
                                            </div>
                                            <div class="col-6 content">
                                                <h5>
                                                    {{$item->product_name}}<br>
                                                    {{$item->product_size}}
                                                </h5>
                                                <p>{{$item->product_price *  $item->quantity }} $</p>
                                                <b ID="lblCartCount">{{$item->quantity}}</b>
                                                <strong class="cart_delete">
                                                    <a class="cart_quantity_delete" href="deletItem/{{$item->id}}"><i
                                                            class="fa fa-times"></i></a>
                                                </strong>
                                            </div>

                                        </div>
                                        @endforeach
                                        <div class="row" style="flex-wrap: nowrap ">
                                            <div class="subtotal">
                                                <div class="col-6">
                                                    <h4>SUBTOTAL</h4>
                                                </div>
                                                <div class="col-6">
                                                    <span style="text-align: right">
                                                    @if (!empty(Session::get('couponAmount')))
                                                        {{$totalAmount - Session::get('couponAmount')}} $
                                                        @else
                                                        {{$totalAmount}} $
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-ground">
                                            <a href="{{url('/cart')}}"> <button type="button"
                                                    style="border:1px solid; font-size:15px;  margin:10px; padding:7px 30px;"
                                                    class="btn btn-info hvr-sweep-top check_out">
                                                    <span style="color: #fff">View Cart</span>
                                                </button></a>
                                            <a href="{{url('/checkout')}}"> <button type="button"
                                                    style="border:1px solid; font-size:15px;  margin:10px; padding:7px 30px;"
                                                    class="btn btn-success hvr-sweep-bottom check_out">
                                                    <span style="color: #fff">Ckeck Out</span>
                                                </button></a>
                                        </div>
                                        @else
                                        <div style="color:red;padding:20px"> No Data In Cart To Show</div>

                                    </div>
                                    @endif
                                </li>
                                @if(!empty(Session::get("checkwishlist")))
                                <li><a href="{{url('/Wishlist')}}"><i style="color: orange" class="fa fa-star"></i> Wishlist
                                            <span ID="lblCartCount">
                                                @if (!empty(Auth::check()))
                                                {{$WishListCount}}
                                                @else
                                                0
                                                @endif
                                            </span>
                                        </a>
                                </li>
                                @else
                                <li><a href="{{url('/Wishlist')}}"><i class="fa fa-star"></i> Wishlist</a></li>
                                @endif
                                <!-- check if the user has refister or not if not then show login otherwise show account page -->
                                @if (!empty(Auth::check()))
                                <li><a href="{{url('/History')}}"><i class="fa fa-crosshairs"></i> History</a></li>
                                <li><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="{{url('/Frontlogout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                                @else
                                <li><a href="{{url('/Frontregister')}}"><i class="fa fa-lock"></i> Login</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{url('/')}}" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($maincategory as $cat)
                                        @if ($cat->status == "1")
                                        <li><a href="{{asset('/product/'.$cat->url)}}">{{ $cat->name}}</a></li>
                                        @endif
                                        @endforeach

                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
                                        <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{url('page/contactUs')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Search for the product -->
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="{{url('/Search-Products')}}" method="POST">
                                @csrf
                                <input type="text" name="search" id="search" placeholder="Search Product" />
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->
