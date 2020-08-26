
<?php
use App\AdminDetailes;
use App\FrontEmail;
$username = AdminDetailes::where(['username'=>Session::get('AdminSession')])->first(); // show the user detailes
$count_unread_Messages = FrontEmail::where('status',0)->count(); //count un read messages
?>
<!--Header-part-->
<div id="header">
  <h1 style="font-size:35px"><a href="dashboard.html"> <strong style="color: #c44">Abo</strong>Shope </a></h1>
</div>
<!--close-Header-part-->


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><img src="{{asset('images/images_backend/UserAvater/'. $username->avatar)}}" width="15px" style="border-radius: 50%;margin-right:5px" > <span class="text">{{  $username->username}}</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="{{url('/admin/setting')}}"><i class="icon-user"></i> My Profile</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
        <li class="divider"></li>
        <li><a href="{{ url('/logout') }}"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    @if($username->position =="Admin")
    <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">{{$count_unread_Messages}}</span> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a class="sAdd" title="" href="{{url('/admin/show_unread_Messages')}}"><i class="icon-plus"></i> new message<span class="label label-important" style="float: right">{{$count_unread_Messages}}</span></a></li>
        <li class="divider"></li>
        <li><a class="sInbox" title="" href="{{url('/admin/contact_us')}}"><i class="icon-envelope"></i> inbox</a></li>
        <li class="divider"></li>
        <li><a class="sOutbox" title="" href="{{url('/admin/read_Messages')}}"><i class="icon-arrow-up"></i> outbox</a></li>
        <li class="divider"></li>
      </ul>
    </li>
    @endif
    <li class=""><a title="" href="{{ url('/logout') }}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
  <img src="{{asset('images/images_backend/UserAvater/'. $username->avatar)}}" width="30px" style="padding: 0 ;margin-top:-10px;">
</div>

<!--close-top-serch-->
