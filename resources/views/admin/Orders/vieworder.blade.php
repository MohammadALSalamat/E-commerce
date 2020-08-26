@extends('layouts.adminlayout.admin_desgin')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('admin/order/orderview')}}" title="Go to order" class="tip-bottom">Orders</a>
            <a href="#" class="current">View New Orders</a> </div>
        <h1>View New Orders</h1>
    </div>
    <div class="container-fluid">
        <!-- Display the error masseges from AdminController -->
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
            @endif
        </div>
        <hr>

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Orders </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Order ID </th>
                                    <th>Customer Name </th>
                                    <th>Customer Email </th>
                                    <th>Order Product</th>
                                    <th>Order Amount</th>
                                    <th>Payment Method</th>
                                    <th>Order Status</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderview as $view)
                                <tr class="gradeX" style=" text-align: center">
                                    <td style="text-align: center">{{$view-> id}}</td>
                                    <td style="text-align: center">{{$view-> name}}</td>
                                    <td style="text-align: center">{{$view-> user_email}}</td>
                                    <td style="text-align: center">
                                    @foreach ($view->orders as $item)
                                    {{$item->product_name}} ({{($item->product_quantity)}})<br>
                                    @endforeach
                                    </td>
                                    <td style="text-align: center">{{$view-> Total}}</td>
                                    <td style="text-align: center">{{$view-> payment_method}}</td>
                                    <td style="text-align: center">{{$view->order_status}}</td>
                                    <td style="text-align: center">{{$view->created_at}}</td>
                                    <td style="text-align: center ; width:33%">
                                        <a target="_blank" title="View More Detailes" class="tip-bottom"
                                            href="{{url('admin/order/orderview/'. $view-> id )}}"><button
                                                class="btn-success btn mr-1 mb-1 hvr-sweep-left mt-5 px-4"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Detalies</button></a>
                                        @if ($view->order_status == "Delivered" ||$view->order_status == "Approve"||$view->order_status == "Paid"   )
                                        <a target="_blank" title="View More Detailes" class="tip-bottom"
                                            href="{{url('admin/OrderInvoice/'. $view-> id )}}"><button
                                                class="btn-info btn mr-1 mb-1 hvr-sweep-right mt-5 px-4"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Invoice</button></a>
                                        <a title="Export Excel File" class="tip-bottom"
                                            href="{{url('/getInvoicPDF/'.$view->id)}}"><button type="button" style="margin-top:10px "
                                                class="btn btn-danger " style="background: none ; border:1px solid red;color:red"><i class="fa fa-file-pdf"
                                                    aria-hidden="true"></i>
                                                Invoice PDF</button></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
