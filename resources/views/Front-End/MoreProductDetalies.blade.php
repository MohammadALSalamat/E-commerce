@extends('layouts.frontlayout.front_desgin')
@section('content')
<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><a href="{{url('/History')}}">History</a></li>
            <li class="active">Product_Detailes</li>
        </ol>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Code</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Size</th>
                <th scope="col">Product Color</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Quantity</th>

            </tr>
        </thead>
        <tbody>
             @foreach ($orderTable->orders as $product)
            <tr>
                <td>{{$product->product_id}}</td>
                <td>{{$product->product_code}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->product_size}}</td>
                <td>{{$product->product_color}}</td>
                <td>{{$product->product_price}}</td>
                <td>{{$product->product_quantity}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
