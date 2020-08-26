<html>

<head>
</head>

<body>
    <table class="table" width="900px">
        <tr>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td><img src="{{asset('public/images/images_frontend/images/home/logo.png')}} " width="400" height="100px">
            </td>
        </tr>
        <tr>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>Hello {{$name}},</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th> Thank You For Shopping from us , Your Order Has been Completed</th><br>
        </tr>
        <tr>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th> Your Order Detailes </th><br>
        </tr>
        <tr>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>Order ID : {{$order_id}}</th><br>
        </tr>
        <tr>
            <th>&nbsp;</th>
        </tr>

        <tr>
            <td>
                <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Size</th>
                        <th scope="col">Product Color</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Product Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productDetailes['orders'] as $Product)
                    <tr>
                        <td>{{$Product-> product_code}}</td>
                        <td>{{$Product-> product_name}}</td>
                        <td>{{$Product-> product_size}}</td>
                        <td>{{$Product-> product_color}}</td>
                        <td>{{$Product-> product_quantity}}</td>
                        <td>$ {{$Product-> product_price}}</td>

                    </tr>
                    @endforeach
                    <tr>
                        <td colspan='5' align="right">Shipping Charges</td>
                        <td>$ {{$productDetailes['shipping_charge']}}</td>
                    </tr>
                    <tr>
                        <td colspan='5' align="right">Coupon Amount</td>
                        <td>$ {{$productDetailes['coupon_amount']}}</td>
                    </tr>
                    <tr>
                        <td colspan='5' align="right"> Order Total</td>
                        <td>$ {{$productDetailes['Total']}}</td>
                    </tr>
                 </tbody>
                 </table>
            </td>
        </tr>
    </table>
</body>

</html>
