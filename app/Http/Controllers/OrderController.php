<?php

namespace App\Http\Controllers;

use App\User;
use App\order;
use Dompdf\Dompdf;
use App\shipping_charge;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function viewOrderPage()
    {
        // get the detalies of all orders including the products
        $orderview = order::with('orders')->orderBy('id', 'DESC')->get();
        return view('admin.Orders.vieworder', compact('orderview'));
    }

    public function viewMoreDetailes($id)
    {
        // get the detalies of all orders including the products
        $MoreDetailes = order::with('orders')->where('id', $id)->first();

        // get the billing address  and shipping address
        //First we have to get the user detailes through fetching the user_id from order table.
        $user_email = $MoreDetailes->user_email;
        $userDetailes = User::where(['email' => $user_email])->first();
        return view('admin.Orders.viewMoreDetailes', compact('MoreDetailes', 'userDetailes'));
    }

    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            order::where('id', $data['id'])->update([
                'order_status' => $data['Select_status']
            ]);
            return redirect()->back()->with('success', 'The order status has been  updated');
        }
    }

    // view OrderInvoice

    public function OrderInvoice($id)
    {
        // get the detalies of all orders including the products
        $MoreDetailes = order::with('orders')->where('id', $id)->first();
        // get the billing address  and shipping address
        //First we have to get the user detailes through fetching the user_id from order table.
        $user_email = $MoreDetailes->user_email;
        $userDetailes = User::where(['email' => $user_email])->first();
        return view('admin.Orders.OrderInvoice', compact('MoreDetailes', 'userDetailes'));
    }

    // get OrderInvoice PDF

    public function getInvoicPDF($id)
    {
        // get the detalies of all orders including the products
        $MoreDetailes = order::with('orders')->where('id', $id)->first();
        // get the billing address  and shipping address
        //First we have to get the user detailes through fetching the user_id from order table.
        $user_email = $MoreDetailes->user_email;
        $userDetailes = User::where(['email' => $user_email])->first();

        $getshippingCharges = shipping_charge::where("country", $MoreDetailes->country)->first();

        // get variable to handle the outputs

        $outputs = '
        <html lang="en">

<head>
    <meta charset="utf-8">
    <title>INVOICE</title>
    <style>
    .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;
  height: 29.7cm;
  margin: 0 auto;
  color: #001028;
  background: #FFFFFF;
  font-family: Arial, sans-serif;
  font-size: 12px;
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}


h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: left;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

.company {
  float: right;
  text-align: right;
}
.company span {
  color: #5D6975;
  text-align: left;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#project div,
#company div {
  white-space: nowrap;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;
  font-weight: normal;
}

table .service,
table .code,
table .size,
table .color{
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.code,
table td.size,
table td.color
 {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
  text-align: center;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
</head>

<body>
    <header class="clearfix">
        <h1>INVOICE #' . $MoreDetailes->id . '</h1>
        <div id="project" class="clearfix">
            <div style="margin-bottom:10px">Order Detailes:</div>
            <div><span>Order ID</span> : ' . $MoreDetailes->id . '</div>
            <div><span>Order Date</span> : ' . $MoreDetailes->created_at . '</div>
            <div><span>Order Amount</span>  : ' . $MoreDetailes->Total . ' $</div>
            <div><span>Order Status</span> : ' . $MoreDetailes->order_status . '</div>
            <div><span>Payment </span> : ' . $MoreDetailes->payment_method . '</div>
        </div>
    <div id="project" style = " float:right">
            <div style="margin-bottom:10px">Shipped Address:</div>
            <div><span>CLIENT</span> : ' . $MoreDetailes->name . '</div>
            <div><span>ADDRESS</span> : ' . $MoreDetailes->address . '</div>
            <div><span>EMAIL</span> <a href="#"> :' . $MoreDetailes->user_email . '</a></div>
            <div><span>CITY</span> : ' . $MoreDetailes->city . '</div>
            <div><span>STATE</span> :' . $MoreDetailes->state . '</div>
            <div><span>COUNTRY</span> : ' . $MoreDetailes->country . '</div>
            <div><span>PHONE NO:</span> : ' . $MoreDetailes->phonenumber . '</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">Name</th>
                    <th class="code">Code</th>
                    <th class="size">Size</th>
                    <th class="color">Color</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                ';
        $subtotal = 0;
        foreach ($MoreDetailes->orders as $item) {
            $outputs .= '
                <tr>
                    <td class="service">' . $item->product_name . '</td>
                    <td class="code">' . $item->product_code . '</td>
                    <td class="size">' . $item->product_size . '</td>
                    <td class="color">' . $item->product_color . '</td>
                    <td class="unit">' . $item->product_price . '</td>
                    <td class="qty">' . $item->product_quantity . '</td>
                    <td class="total">' . $item->product_quantity * $item->product_price . ' $</td>
                </tr>
                ';
            $subtotal += ($item->product_quantity * $item->product_price);
        }
        $outputs .= '
                <tr>
                    <td colspan="6">SUBTOTAL</td>
                    <td class=" grand total">' . $subtotal . ' $</td>
                </tr>
                <tr>
                    <td colspan="6">COUPON</td>
                    <td class=" grand total">' . $MoreDetailes->coupon_amount . ' $</td>
                </tr>
                  <tr>
                    <td colspan="6">Shipping Charges</td>
                    <td class=" grand total">' . $getshippingCharges->shipping_charges0_500g . ' $</td>
                </tr>
                <tr>
                    <td colspan="6">GRAND TOTAL</td>
                    <td class="grand total">' . $MoreDetailes->Total . '$</td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($outputs);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
