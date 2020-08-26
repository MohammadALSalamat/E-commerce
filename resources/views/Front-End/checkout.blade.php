@extends('layouts.frontlayout.front_desgin')
@section('content')
<section id="form" style="margin:50px 0">
    <!--form-->
    <div class="container">
         <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div>
        <form action="{{url('/nextStep')}}" method="post">
            @csrf
            <div class="row">
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                <div class="col-sm-4 col-sm-offset-1">

                    <div class="login-form">
                        <!--login form-->
                        <h2>Billing To </h2>
                        <div class="form-group">
                            <input id="bill_name" name="bill_name" type="text" placeholder="User Name "
                               @if (!empty($userDetailes->name))
                                value="{{$userDetailes->name}}"
                               @endif required class="form-control" /></div>
                        <div class="form-group">
                            <input id="bill_address" name="bill_address" type="text" placeholder="User address"
                               @if (!empty($userDetailes->address))
                                 value="{{$userDetailes->address}}"
                               @endif class="form-control" /></div>
                        <div class="form-group">
                            <input id="bill_city" name="bill_city" type="text" placeholder="User city"
                               @if (!empty($userDetailes->city))
                                 value="{{$userDetailes->city}}"
                               @endif class="form-control" /></div>
                        <div class="form-group">
                            <input id="bill_state" name="bill_state" type="text" placeholder="User state"
                                @if (!empty($userDetailes->state))
                              value="{{$userDetailes->state}}"
                               @endif class="form-control" /></div>
                        <select style="padding: 10px 0" id="bill_country" name="bill_country">
                            <option value="">Select Your Country</option>
                            @foreach ($countries as $country)
                            <option value="{{$country->country_name}}"
                              @if (!empty($userDetailes->country) && $country->country_name==$userDetailes->country)
                                selected
                                @endif> {{ $country->country_name}} </option>
                            @endforeach

                        </select>
                        <div class="form-group">
                            <input style="margin-top: 10px" id="bill_postcode" name="bill_postcode" type="text"
                                placeholder="postcode" @if (!empty($userDetailes->postcode))
                              value="{{$userDetailes->postcode}}"
                               @endif  class="form-control" /></div>
                        <div class="form-group">
                            <input id="bill_mobile" name="bill_mobile" type="text" placeholder="User Phone Number"
                               @if (!empty($userDetailes->phonenumber))
                               value="{{$userDetailes->phonenumber}}"
                               @endif  class="form-control" /></div>
                        <div class="form-check" style="display:flex ; width:100% ; margin-top:20px">
                            <input style="height:15px ;width:15px ; margin-right : 15px" type="checkbox"
                                class="" id="billtoship" name="billtoship">
                            <label style="padding-top: 2px;" class="form-check-label" for="billtoship"> Shipping address
                                is the same as Billing address ? </label>
                        </div>

                    </div>
                    <!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or"> <i class="fa fa-long-arrow-right " style="font-size:30px ; margin-top:9px"></i>
                    </h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <!--sign up form-->
                        <h2>Shipping To</h2>
                        <div class="form-group">
                            <input id="ship_name" name="ship_name" type="text" placeholder="shipping Name" required
                                class="form-control" @if (!empty($shippingDetales->name))
                               value="{{$shippingDetales ->name}}"
                               @endif  /></div>
                        <div class="form-group"><input id="ship_address" name="ship_address" type="text"
                                placeholder="shipping address" class="form-control" @if (!empty($shippingDetales->address))
                               value="{{$shippingDetales ->address }}"
                               @endif   /></div>
                        <div class="form-group"> <input id="ship_city" name="ship_city" type="text"
                                placeholder="shipping city" class="form-control" @if (!empty($shippingDetales->city))
                               value="{{$shippingDetales ->city}}"
                               @endif   /></div>
                        <div class="form-group"> <input id="ship_state" name="ship_state" type="text"
                                placeholder="shipping state" class="form-control" @if (!empty($shippingDetales->state))
                                value="{{$shippingDetales ->state}}"
                               @endif /></div>
                        <select style="padding: 10px 0" id="ship_country" name="ship_country">
                            @foreach ($countries as $country)
                            <option value="{{$country->country_name}}"
                            @if (!empty($shippingDetales->country) && $country->country_name==$shippingDetales->country)
                                selected
                                @endif> {{ $country->country_name}} </option>
                            @endforeach

                        </select>
                        <div class="form-group"> <input style="margin-top: 10px" id="ship_postcode" name="ship_postcode"
                                type="text" placeholder="postcode" class="form-control" @if (!empty($shippingDetales->postcode))
                               value="{{$shippingDetales ->postcode}}"
                               @endif  /></div>
                        <div class="form-group"> <input id="ship_mobile" name="ship_mobile" type="text"
                                placeholder="shipping Phone Number" class="form-control" @if (!empty($shippingDetales->phonenumber))
                               value="{{$shippingDetales ->phonenumber}}"
                               @endif  /></div>
                        <div class=" form-group form-actions">
                           <button type="submit"
                            style="border:1px solid #000 ; font-size:15px;margin-top:20px;width:100%; padding:7px"
                            class="btn btn-dark hvr-sweep-right">
                            <span style="color: #fff"> Next Step <i class="fa fa-arrow-right"></i> </span>
                        </button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!--/form-->
@endsection
