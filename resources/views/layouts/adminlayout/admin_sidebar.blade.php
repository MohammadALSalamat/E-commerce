<?php

use App\AdminDetailes;
$username = AdminDetailes::where(['username'=>Session::get('AdminSession')])->first(); // show the user detailes
// get the current url of the page
$url = url()->current();
?>

<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
    <!--
    ==>  Make the side bar cative daynmice
    ==> The problem here that the names are the same so when we try to fix it just change the names of url
    -->
    <li <?php if(preg_match("/dashboard/i",$url)){ ?> class="active" <?php }?>><a
                href="{{url('admin/dashboard')}}"><i class="icon icon-home"></i>
                <span>Dashboard</span></a> </li>
        @if($username->position == 'Admin')
        <li class="submenu"> <a href="#"><i class="fa fa-user-cog" style="color:white ; font-size:15px"></i>
                <span>Admins/Sub-Admins</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match("/viewAdmins/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/viewAdmins/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/viewAdmins')}}">View Admins</a></li>
                <li <?php if(preg_match("/addAdmins/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/addAdmins')}}">Add Sub Admins</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-user" style="color:white ; font-size:15px"></i>
                <span>Users</span> <span class="label label-important">4</span></a>
            <ul <?php if(preg_match("/user/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/viewusers/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/user/viewusers')}}">View Users</a></li>
                <li <?php if(preg_match("/banusers/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/user/ViewBanUsers')}}">Ban Users</a></li>
                <li <?php if(preg_match("/subscribe/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/subscribe')}}">Subscribe Users</a></li>
                        <li <?php if(preg_match("/contact_us/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/contact_us')}}">User Feedbacks</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon-signal"" style="color:white ; font-size:15px"></i>
                <span>Site Analytics</span> <span class="label label-important">4</span></a>
            <ul <?php if(preg_match("/chart/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/AdminChart/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/chart/AdminChart')}}">View Admin Chart</a></li>
                <li <?php if(preg_match("/UsersChart/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/chart/UsersChart')}}">View Users Chart</a></li>
                <li <?php if(preg_match("/SellsChart/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/chart/SellsChart')}}">View Sells Chart</a></li>
            </ul>
        </li>
        @endif
        <li class="submenu"> <a href="#"><i class="fa fa-code-fork" style="color:white ; font-size:15px"></i>
                <span>Categories</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match("/categor/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/viewCategory/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/category/viewCategory')}}">View Categories</a></li>
                <li <?php if(preg_match("/createCategory/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/category/createCategory')}}">Create Category</a>
                </li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list" style="color:white ; font-size:15px"></i>
                <span>Products</span> <span class="label label-important">3</span></a>
            <ul <?php if(preg_match("/product-/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/viewProducts/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/product/viewProducts')}}">View Products</a></li>
                <li <?php if(preg_match("/createProducts/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/product/createProducts')}}">Create Products</a></li>
                <li <?php if(preg_match("/featuers/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/product/view/featuers')}}">Create New Featuers</a>
                </li>
            </ul>
        <li class="submenu"> <a href="#"><i class="fas fa-gift" style="color:white ; font-size:15px"></i>
                <span>Coupons</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match("/coupon/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/viewCoupons/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/coupon/viewCoupons')}}">View Coupons</a></li>
                <li <?php if(preg_match("/addcoupon/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/addcoupon')}}">Create Coupons</a></li>
            </ul>
        <li class="submenu"> <a href="#"><i class="fas fa-truck" style="color:white ; font-size:15px"></i>
                <span>Orders</span> <span class="label label-important">1</span></a>
            <ul <?php if(preg_match("/order/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/orderview/i",$url)){ ?> class="active" <?php }?>>
                    <a href="{{url('/admin/order/orderview')}}">View Orders</a>
                </li>
            </ul>
        <li class="submenu"> <a href="#"><i class="	far fa-images" style="color:white ; font-size:15px"></i>
                <span>Banners</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match("/banner/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/viewbanner/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/viewbanner')}}">View banners</a></li>
                <li <?php if(preg_match("/addbanners/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/addbanners')}}">Create banners</a></li>

            </ul>

        </li>
        <li class="submenu"> <a href="#"><i class="fa fa-images" style="color:white ; font-size:15px"></i>
                <span>CMS Pages</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match("/cms-page/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/view-cms-page/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/view-cms-page')}}">View CMS Pages</a></li>
                <li <?php if(preg_match("/add-cms-page/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/add-cms-page')}}">Create CMS Pages</a></li>

            </ul>

        </li>
        <li class="submenu"> <a href="#"><i class="fa fa-money" style="color:white ; font-size:15px"></i>
                <span>Convert Currenies</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match("/currency/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/view-currency/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/view-currency')}}">View Currenies</a></li>
                <li <?php if(preg_match("/add-currency/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/add-currency')}}">Create Currenies</a></li>

            </ul>

        </li>
        <li class="submenu"> <a href="#"><i class="fab fa-btc" style="color:white ; font-size:15px"></i>
                <span>Shipping Charges</span> <span class="label label-important">1</span></a>
            <ul <?php if(preg_match("/shippingCharge/i",$url)){ ?> style="display:block" <?php }?>>
                <li <?php if(preg_match("/shippingCharge/i",$url)){ ?> class="active" <?php }?>><a
                        href="{{url('/admin/view-shippingCharge')}}"> View Shipping Charge</a></li>

            </ul>

        </li>
    </ul>
</div>
<!--sidebar-menu-->
