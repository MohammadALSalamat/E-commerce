<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .invoice-title h2,
    .invoice-title h3 {
        display: inline-block;
    }

    .table>tbody>tr>.no-line {
        border-top: none;
    }

    .table>thead>tr>.no-line {
        border-bottom: none;

    }


    .table>tbody>tr>.thick-line {
        border-top: 2px solid;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2>
                <h3 class="pull-right">Order #{{$MoreDetailes->id}}
                <!-- Genrate the barcode For the product -->
                <span><?= DNS1D::getBarcodeHTML($MoreDetailes->id, 'C39'); ?></span>
                </h3>


            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        {{$userDetailes->name}}<br>
                        {{$userDetailes->address}}<br>
                        {{$userDetailes->city}}<br>
                        {{$userDetailes->state}}<br>
                        {{$userDetailes->postcode}}<br>
                        {{$userDetailes->country}}<br>
                        {{$userDetailes->phonenumber}}


                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Shipped To:</strong><br>
                        {{$MoreDetailes->name}}<br>
                        {{$MoreDetailes->address}}<br>
                        {{$MoreDetailes->city}}<br>
                        {{$MoreDetailes->state}}<br>
                        {{$MoreDetailes->postcode}}<br>
                        {{$MoreDetailes->country}}<br>
                        {{$MoreDetailes->phonenumber}}
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Payment Method:</strong><br>
                        @if($MoreDetailes->payment_method == "COD") Cash On Deleivery @else Paypal @endif

                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Date:</strong><br>
                        \{{$MoreDetailes->created_at->format("Y-m-d")}}<br>

                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td><strong>Code</strong></td>
                                    <td><strong>Size</strong></td>
                                    <td><strong>Color</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Totals</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php
                                // define the subtotal here to use in oprations later
                                $subtotal = 0 ;

                                ?>
                                @foreach ($MoreDetailes->orders as $item)
                                    <tr>
                                    <td class="text-center">{{$item->product_name}}</td>
                                    <td class="text-center;display:block">{{$item->product_code}}
                                    <?= DNS1D::getBarcodeHTML($item->product_code, 'C39'); ?></td>
                                    <td class="text-center">{{$item->product_size}}</td>
                                    <td class="text-center">{{$item->product_color}}</td>
                                    <td class="text-center">{{$item->product_price}}$</td>
                                    <td class="text-center">{{$item->product_quantity}}</td>
                                    <td class="text-right">{{$item->product_quantity * $item->product_price }} $</td>
                                </tr>
                                    <?php
                                    // calculate the subtotal here to show it later in the invoice
                                    $subtotal +=($item->product_quantity * $item->product_price);

                                    ?>
                                @endforeach
                                <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">{{$subtotal}} $</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping Charges </strong></td>
    								<td class="no-line text-right">0</td>
                                </tr>
                                <tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Coupon Discount</strong></td>
    								<td class="no-line text-right">{{$MoreDetailes->coupon_amount}} $</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">{{$MoreDetailes->Total}}$</td>
    							</tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
