@extends('layouts.frontlayout.front_desgin')
@section('content')

<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">History</li>
        </ol>
    </div>
    @foreach ($orderTable as $item)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>
                Detailes Of proccess On <strong>{{$item->created_at}}</strong>
            </span>
            <span class='pull-right toggle-info'>
                <i class=' fa fa-plus'></i>
            </span>
        </div>

        <div id="hide" class="panel-body">
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
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
                                border: 1px solid #ccc;
                            }

                            strong {
                                margin-left: 10px;
                                margin-right: 10px;
                                font-size: 15px;
                                font-weight: bolder
                            }

                            span {
                                font-size: 13px;
                            }
                            button{
                                width:100% ;
                                padding:20px 0 ;
                                color :#000 ;
                                font-size:20px;
                                border:1px solid #000;

                            }
                            button:hover{
                               border:1px solid #000;
                               font-weight: bold
                            }
                        </style>
                        <table class="myTable table table-striped">
                            <tr>
                                <th colspan="2">Order Detailes</th>
                            </tr>
                            <tr class="text-left ">
                                <td> <strong>User Email : </strong><span>{{$item->user_email}}</span> </td>
                                <td> <strong> User Name : </strong><span> {{$item->name}}</span> </td>
                            </tr>
                            <tr class="text-left ">
                                <td> <strong>Order Status : </strong><span>{{$item->order_status}}</span> </td>
                                <td> <strong> Payment Method : </strong><span> {{$item->payment_method}}</span> </td>
                            </tr>
                            <tr>
                                <th colspan="2">Product Detailes</th>
                            </tr>
                            <!--
                                This Foreach works to get the detailes from productOrder table that we made relation with
                                Order Table so to get all detailes we have to sign it like below
                            -->
                            @foreach ($item->orders as $product)
                            <tr class="text-left ">
                                <td> <strong>Product Code: </strong><span>{{$product->product_code}}</span></td>
                                <td> <strong> Product Name : </strong><span> {{$product->product_name}}</span> </td>
                            </tr>
                            @endforeach
                            <tr>
                            <tr>
                                <th colspan="2">Total Detailes</th>
                            </tr>
                            <td colspan="2" class="text-center"> <strong style="font-size: 18px;color:#444">Total Price
                                    : {{$item->Total}} $</strong>
                            </td>

                            </tr>
                        </table>
                        <a href="{{url('/ProductOrderDetailes/'.$item->id)}}"><button class="btn btn-default" style=" padding:10px 0 ;font-weight: bold;border:2px solid blue;font-size:20px;" > More Detailes</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

@endsection
