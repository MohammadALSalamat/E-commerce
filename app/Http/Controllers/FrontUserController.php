<?php

namespace App\Http\Controllers;

use App\country;
use App\delevary;
use App\order;
use App\productAttr;
use App\ProductOrder;
use App\Products;
use App\shipping_charge;
use App\shoppingCart;
use App\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;

class FrontUserController extends Controller
{
    public function register()
    {
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();

        } else {
            $session_id = Session::get('session_id');
            $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
        }

        // create loop to get the product_id then get the image from product table where both have a relation

        foreach ($CartDetalies as $key => $product) {
            // to get image from product table
            $getImageCart = Products::where('id', $product->product_id)->first();
            $CartDetalies[$key]->image = $getImageCart->image;
        }
        $meta_title = "Home | Login & Register"; // name of the main website
        $meta_description = "The place that user can register and login to the website"; // name of the main website
        $meta_keywords = "login , user , register , information"; // name of the main website

        return view('Front-End/login', compact('CartDetalies', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function storedata(Request $request)
    {
        $data = $request->all();
        $checkUser = User::where('email', $data['email'])->count();
        if ($checkUser > 0) {
            return redirect()->back()->with('error', 'the email is already exists');
        } else {
            $register = new User;
            $register->name = $data['name'];
            $register->email = $data['email'];
            $register->password = bcrypt($data['pass']);
            $register->save();

            // Very Important Step Send Confirm Email to New users To veryfie There Emails before register
            $email = $data['email'];
            $messageData = ['email' => $data['email'], 'name' => $data['name'], 'code' => base64_encode($data['email'])];
            //start send Confirm
            Mail::send('emails.RegisterMail', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Confirom Your Account');
            });
            // Very Important Step Send Offline Email to New users without confrmation
            // $email =$data['email'];
            // $messageData = ['email'=>$data['email'],'name'=>$data['name']];
            // //start send Mail
            // Mail::send('emails.RegisterMail', $messageData, function ($message) use($email) {
            //     $message->to($email)->subject('Registration To AboStore Website');
            // });

            // chekc if the user is attempt then go to cart page
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['pass'], 'status' => 1])) {
                //ceate session to use it to do the middleware
                Session::put('frontsession', $data['email']);

                // once the user enter by his email then we have to insert the email address to cart table
                if (!empty(Session::get('session_id'))) {
                    $session_id = Session::get('session_id');
                    shoppingCart::where('session_id', $session_id)->update(['user_email' => $data['user_email']]);
                }

                return redirect()->back()->with('success', 'Confirmation Has been sent Via Email , Please Confirm Your Account ');
            } else {
                return redirect()->back()->with('success', 'Confirmation Has been sent Via Email , Please Confirm Your Account ');

            }

        }

    }

    // Confirm the Mail  after Click on verify button
    public function confirmEmailAccount($email)
    {
        // decode the email to fetch the data the the email related to
        $Email = base64_decode($email);
        $countUser = User::where('email', $Email)->count();
        if ($countUser > 0) {
            $checkStatus = User::where(['email' => $Email])->first();
            if ($checkStatus->status == 0) {
                User::where(['email' => $Email])->update(['status' => 1]);
                return redirect('/Frontregister')->with('success', 'your email has been Confirmed So you Can use it Login Successfuly');
            } else {
                return redirect('/Frontregister')->with('success', 'your email is Already Confirmed So you Can use it Login Successfuly');
            }
        } else {
            abort(404);
        }

    }
    // login page and get the data
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // here we will check the $data if it is matching with register data
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['pass'], 'status' => 1, 'admin' => 1])) {

                /**
                 *  Important thing we have to do to make this seesion work
                 *
                 *  we have to go to Kernel.php located uneder the Middleware file
                 */
                //ceate session to use it to do the middleware
                Session::put('frontsession', $data['email']);

                // once the user enter by his email then we have to insert the email address to cart table
                if (!empty(Session::get('session_id'))) {
                    $session_id = Session::get('session_id');
                    shoppingCart::where('session_id', $session_id)->update(['user_email' => $data['email']]);
                }
                return redirect('/checkout');
            } else {

                if (Auth::attempt(['email' => $data['email'], 'password' => $data['pass'], 'status' => 0, 'admin' => 1])) {

                    return redirect()->back()->with('error', 'Sorry You have to Verfiy Your Email First , Check Your Emails OR Contact Admins Please ');
                } elseif (Auth::attempt(['email' => $data['email'], 'password' => $data['pass'], 'status' => 1, 'admin' => 0])) {

                    return redirect()->back()->with('error', 'Sorry You Got Ban you can not use this Featuer again , Contact Admins For More Information, Please ');
                } else {
                    // valdiation and send error massege to admin page if data not correct
                    return redirect()->back()->with('error', 'Invalid username or Password please Try again ');
                }

            }
        }
    }
    // just in cases the user forget his password
    public function Forgetpassword(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            // check if Email is already exsist  otherwise send error message
            $checkEmail = User::where(['email' => $data['forgetPass']])->count();
            if ($checkEmail == 0) {
                redirect()->back()->with('error', 'Sorry But This Email Is Not Exist , Type Your Current Email');
            } else {
                // Steps For forget password Form ,

                // 1-) get the user detailes
                $userDetailes = User::where('email', $data['forgetPass'])->first();

                // 2-)  get the random password using the Php function str_random where it help to get number of random chart
                $RandomPass = Str::random(8);

                // 3-) encode the random password to insert it to database
                $encryptPass = bcrypt($RandomPass);

                // 4-) Update the User password with the new one
                User::where('email', $data['forgetPass'])->update([
                    'password' => $encryptPass,
                ]);

                // 5-) send The New Password to user to login again
                $Email = $data['forgetPass'];
                $name = $userDetailes->name;
                $message = [
                    'email' => $Email,
                    'name' => $name,
                    'password' => $RandomPass,
                ];
                Mail::send('emails.forgotpassword', $message, function ($message) use ($Email) {
                    $message->from('alomda.alslmat@gmail.com', 'AboShope');
                    $message->to($Email);
                    $message->subject('Forgot Password , AboShope Website');
                });
                redirect()->back()->with('success', 'Your Password Has been sent to your Current Email, Thank you');

            }
        }

        return view('Front-End.ForgetPassword');
    }

    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $checkUser = User::where('email', $data['email'])->count();
        if ($checkUser > 0) {
            echo "false";
        } else {
            echo "true";
        }

    }

    // start the account page
    public function account()
    {
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();

        } else {
            $session_id = Session::get('session_id');
            $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
        }

        // create loop to get the product_id then get the image from product table where both have a relation

        foreach ($CartDetalies as $key => $product) {
            // to get image from product table
            $getImageCart = Products::where('id', $product->product_id)->first();
            $CartDetalies[$key]->image = $getImageCart->image;
        }
        // get the user detailes to update the account page
        $user_id = Auth::user()->id;
        $userDetailes = User::findOrfail($user_id); // the way to fetch the detailes of the current user
        // get the countries data from countries table
        $countries = country::get();

        return view('Front-End/account', compact('CartDetalies', 'userDetailes', 'countries', 'userDetailes'));
    }

    // update the accounthttp://localhost:8000/quickview/6#Shoes
    public function accountupdate(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['address'])) {
                $data['address'] = "";
            }if (empty($data['city'])) {
                $data['city'] = "";
            }if (empty($data['state'])) {
                $data['state'] = "";
            }if (empty($data['country'])) {
                $data['country'] = "";
            }if (empty($data['postcode'])) {
                $data['postcode'] = "";
            }if (empty($data['mobile'])) {
                $data['mobile'] = "";
            }
            User::where('id', $id)->update([
                'name' => $data['name'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
                'postcode' => $data['postcode'],
                'phonenumber' => $data['mobile'],
            ]);
            return redirect()->back()->with('success', 'your account has been updated');
        }
    }

    // start the section to check the current password if its correct or not
    public function changPass(Request $request)
    {
        $data = $request->all();
        $current_pass = $data['current_pass'];
        $user_id = Auth::user()->id; // get the user id
        $check_pass = User::where('id', $user_id)->first();
        if (Hash::check($current_pass, $check_pass->password)) {
            echo 'true';die;
        } else {
            echo 'false';die;
        }

    }
    // End the section to check the current password if its correct or not
    // update password
    public function update(Request $request)
    {
        // check the mwthod of form if post or somthing else
        if ($request->isMethod('post')) {
            $user_id = Auth::user()->id; // get the user id
            $data = $request->all();
            $check_pass = User::where(['email' => Auth::user()->email])->first();
            $current_pass = $data['current_pass'];
            if (Hash::check($current_pass, $check_pass->password)) {
                $password = bcrypt($data['new_pwd']); // this line use to hash the new password
                // then fetch the data of user to update it
                User::where('id', $user_id)->update(['password' => $password]);
                return redirect('/account')->with('success', 'Your Password has been updated');
            } else {
                return redirect('/account')->with('error', 'Sorry you can not update your password please try again');
            }
        }
    }

    // show the detailes of check out page where it is related to user detalies

    public function checkout()
    {

        $user_id = Auth::user()->id; // get the user_Id
        $userDetailes = User::findOrfail($user_id); // the way to fetch the detailes of the current user
        $countries = country::get(); // get the countries data from countries table
        $userEmail = Auth::user()->email; // get the user email
        $CartDetalies = shoppingCart::where('user_email', $userEmail)->get();
                  /// check if cart has items or not if not then stop all oprations otherwise go ahead
                    foreach($CartDetalies as $Product){}
                    if(empty($Product->id)){
                    return redirect('/cart')->with("error"," Cart Is Empty , Please Select Items To Complete The Process");
                    }else{
                        // check if the data is exists in delevary table if so then just update it otherwise insert data
                        $checkShippingTable = delevary::where('user_id', $user_id)->count();
                        $shippingDetales = array();
                        if ($checkShippingTable > 0) {
                            $shippingDetales = delevary::where('user_id', $user_id)->first();
                        }

                        // get the User email into the cart table using session
                        $session_id = Session::get('session_id');

                        // we use this way to call the table if we dont have model
                        DB::table('shopping_carts')->where(['session_id' => $session_id])->update(['user_email' => $userEmail]);

                        $meta_title = "Home | Check Out"; // name of the main website
                        $meta_description = "The place that user can pay and check his information"; // name of the main website
                        $meta_keywords = "pay , check out , user , information"; // name of the main website

                        // header cart show detalies
                        if (Auth::check()) {
                            $user_email = Auth::user()->email;
                            $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();
                        } else {
                            $session_id = Session::get('session_id');
                            $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
                        }

                        // create loop to get the product_id then get the image from product table where both have a relation

                        foreach ($CartDetalies as $key => $product) {
                            // to get image from product table
                            $getImageCart = Products::where('id', $product->product_id)->first();
                            $CartDetalies[$key]->image = $getImageCart->image;
                        }
                    }
        return view('Front-End/checkout', compact('CartDetalies', 'userDetailes', 'countries', 'shippingDetales', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    // update the tables accourding to billing and shipping forms detailes
    public function updatebillAndShipForms(Request $request)
    {
        // get the user_Id
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;

        // check if the data is exists in delevary table if so then just update it otherwise insert data
        $checkShippingTable = delevary::where('user_id', $user_id)->count();
        $shippingDetales = array();
        if ($checkShippingTable > 0) {
            $shippingDetales = delevary::where('user_id', $user_id)->first();
        }
        // update account table From billing form
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (empty($data['bill_address'])) {
                $data['bill_address'] = "";
            }
            if (empty($data['bill_city'])) {
                $data['bill_city'] = "";
            }
            if (empty($data['bill_state'])) {
                $data['bill_state'] = "";
            }
            if (empty($data['bill_country'])) {
                $data['bill_country'] = "";
            }
            if (empty($data['bill_postcode'])) {
                $data['bill_postcode'] = "";
            }
            if (empty($data['bill_mobile'])) {
                $data['bill_mobile'] = "";
            }
            //  account page update function
            User::where('id', $user_id)->update([
                'name' => $data['bill_name'],
                'address' => $data['bill_address'],
                'city' => $data['bill_city'],
                'state' => $data['bill_state'],
                'country' => $data['bill_country'],
                'postcode' => $data['bill_postcode'],
                'phonenumber' => $data['bill_mobile'],
            ]);
            if ($checkShippingTable > 0) {
                // update dilveries table from shipping form

                if (empty($data['ship_address'])) {
                    $data['ship_address'] = "";
                }
                if (empty($data['ship_city'])) {
                    $data['ship_city'] = "";
                }
                if (empty($data['ship_state'])) {
                    $data['ship_state'] = "";
                }
                if (empty($data['ship_country'])) {
                    $data['ship_country'] = "";
                }
                if (empty($data['ship_postcode'])) {
                    $data['ship_postcode'] = "";
                }
                if (empty($data['ship_mobile'])) {
                    $data['ship_mobile'] = "";
                }
                //  account page update function
                delevary::where('user_id', $user_id)->update([
                    'name' => $data['ship_name'],
                    'address' => $data['ship_address'],
                    'city' => $data['ship_city'],
                    'state' => $data['ship_state'],
                    'country' => $data['ship_country'],
                    'postcode' => $data['ship_postcode'],
                    'user_email' => $user_email,
                    'phonenumber' => $data['ship_mobile'],
                ]);
            } else {
                $AddNewShippingData = new delevary;
                $AddNewShippingData->user_id = $user_id;
                $AddNewShippingData->name = $data['ship_name'];
                $AddNewShippingData->address = $data['ship_address'];
                $AddNewShippingData->city = $data['ship_city'];
                $AddNewShippingData->state = $data['ship_state'];
                $AddNewShippingData->country = $data['ship_country'];
                $AddNewShippingData->postcode = $data['ship_postcode'];
                $AddNewShippingData->user_email = $user_email;
                $AddNewShippingData->phonenumber = $data['ship_mobile'];
                $AddNewShippingData->save();

            }
            $countZipCode = DB::table('pincodes')->where(['suburb' => $shippingDetales->postcode])->count();
            // check the zip code if it match with database or not so if it is not correct then return back
            if ($countZipCode == 0) {
                return redirect()->back()->with('error', 'The Zip Code is Not Valid , No delivery For this area ,Please Check It Again.');
            } else {
                return redirect()->action('FrontUserController@showTheOrder');
            }

        }

    }

    // review order page

    public function showTheOrder()
    {
        $user_id = Auth::user()->id; // get the user_Id
        $userDetailes = User::findOrfail($user_id); // the way to fetch the detailes of the current user
        $countries = country::get(); // get the countries data from countries table
        $userEmail = Auth::user()->email; // get the user email
        $shippingDetales = delevary::where('user_id', $user_id)->first(); // get the detailes of delevery table
        $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $userEmail])->get();
        // create loop to get the product_id then get the image from product table where both have a relation
        foreach ($CartDetalies as $key => $product) {
            // to get image from product table
            $getImageCart = Products::where('id', $product->product_id)->first();
            $CartDetalies[$key]->image = $getImageCart->image;
        }
        $getshippingCharges = shipping_charge::where("country",$shippingDetales->country)->first();
        $meta_title = "Home | Order Review"; // name of the main website
        return view('Front-End.review_order', compact('shippingDetales', 'userDetailes', 'CartDetalies', 'meta_title','getshippingCharges'));
    }

    // get the payment methods here
    public function PaymentMethod(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //before we insert the data into order table we have to fetch the important data from deffrent tables
            // get user email and id from user table
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            // get the data from the delivery table
            $shippingDetales = delevary::where('user_id', $user_id)->first();

            // get the Zip Code then compare it if it is valid then complete the process otherwise return back

            $countZipCode = DB::table('pincodes')->where(['suburb' => $shippingDetales->postcode])->count();
            // check the zip code if it match with database or not so if it is not correct then return back
            if ($countZipCode == 0) {
                return redirect()->action('FrontUserController@checkout')->with('error', 'The Zip Code is Not Valid , No delivery For this area ,Please Check It Again.');
            } else {

                // get the data of coupons  from the session that we save in or make hidden inputs just like Total
                if (empty(Session::get('couponCode'))) {
                    $coupon_code = '';
                } else {
                    $coupon_code = Session::get('couponCode');
                }
                if (empty(Session::get('couponAmount'))) {
                    $coupon_amount = '';
                } else {
                    $coupon_amount = Session::get('couponAmount');
                }
                  // now we will insert data into producetOrder table
                // get the order_id by using this code that works to get the last id inserted in database
                    $order_id = DB::getPdo()->lastInsertId();
                    $CartDetalies = shoppingCart::where('user_email', $user_email)->get();
                  // Start reduce the stock of items when we buy somthing
                    // get the orginal stock
                    foreach($CartDetalies as $Product){}
                    // check the cart if empty or not if so then stop all oprations and back to cart to select items
                    if(empty($Product->id)){
                    return redirect('/cart')->with("error"," Cart Is Empty , Please Select Items To Complete The Process");
                    }else{
                    $OrginalStock = productAttr::where("sku", $Product->product_code)->first();
                    $ReduceStock = $Product->quantity;
                        if($OrginalStock->stock < $ReduceStock){
                        $deleteProduct = productAttr::where("sku", $Product->product_code)->first();
                        // delete the product that has Stock less than Quantity
                        $CartDetalies = shoppingCart::where("product_code",$Product->product_code )->delete();
                    return redirect('/cart')->with("error"," Sorry , Your order is not matching with requirments , the stock of this product is full. please Reduce Product Stock and try Again");
                    }else{
                        // insert the data into the order table
                        $orderDetailes = new order;
                        $orderDetailes->user_id = $user_id;
                        $orderDetailes->user_email = $user_email;
                        $orderDetailes->name = $shippingDetales->name;
                        $orderDetailes->address = $shippingDetales->address;
                        $orderDetailes->city = $shippingDetales->city;
                        $orderDetailes->state = $shippingDetales->state;
                        $orderDetailes->country = $shippingDetales->country;
                        $orderDetailes->postcode = $shippingDetales->postcode;
                        $orderDetailes->phonenumber = $shippingDetales->phonenumber;
                        $orderDetailes->shipping_charge =$data['Shippingcharge'];
                        $orderDetailes->coupon_code = $coupon_code;
                        $orderDetailes->coupon_amount = $coupon_amount;
                        $orderDetailes->order_status = "new";
                        $orderDetailes->payment_method = $data['payment'];
                        $orderDetailes->Total = $data['Total'];
                        $orderDetailes->save();
                        // do loop to get all products then insert all
                        $order_id = DB::getPdo()->lastInsertId();
                        $CartDetalies = shoppingCart::where('user_email', $user_email)->get();

                        foreach ($CartDetalies as $Product) {
                             // secure the cart price
                        $produc_price = Products::getTheCartPrice($Product->product_id,$Product->product_size);
                            $ProductOrder = new ProductOrder;
                            $ProductOrder->order_id = $order_id;
                            $ProductOrder->user_id = $user_id;
                            $ProductOrder->product_id = $Product->product_id;
                            $ProductOrder->product_code = $Product->product_code;
                            $ProductOrder->product_name = $Product->product_name;
                            $ProductOrder->product_size = $Product->product_size;
                            $ProductOrder->product_color = $Product->product_color;
                            $ProductOrder->product_price = $produc_price;
                            $ProductOrder->product_quantity = $Product->quantity;
                            $ProductOrder->save();
                            // update the table
                            $NewStockAfterReducing = $OrginalStock->stock - $ReduceStock ;
                            if ($OrginalStock->stock > 0) {
                                productAttr::where("sku", $Product->product_code)->update([
                                "stock" => $NewStockAfterReducing,
                                ]);
                            }
                            // End reduce the stock of items when we buy somthing
                            // save the order id and total in session to use then later
                            Session::put("order_id", $order_id);
                            Session::put("Total", $data['Total']);
                            // make condition if the user want to buy by paypal then fo to paypal form otherwise go to COD Form
                            if ($data['payment'] == 'COD') {
                                //security side to not allow hackers to change the total price
                                if ($orderDetailes->Total != Session::get("Total")) {
                                    //ban hacker
                                    User::where('email',$user_email)->update([
                                        'admin'=>0
                                    ]);
                                    shoppingCart::where('user_email', $user_email)->delete();
                                    order::where('user_email', $user_email)->delete();
                                    ProductOrder::where('id', $user_id)->delete();
                                    return redirect('/Frontlogout');
                                }else{
                                    // go to COD page thanks
                                    return redirect('/CODThanksPage');
                                }
                            } else {
                                //security side to not allow hackers to change the total price
                                if ($orderDetailes->Total != Session::get("Total")) {
                                    //ban hacker
                                    User::where('email',$user_email)->update([

                                        'admin'=>0
                                    ]);
                                    ProductOrder::where('id', $user_id)->delete();
                                    order::where('user_email', $user_email)->delete();
                                    shoppingCart::where('user_email', $user_email)->delete();
                                    return redirect('/Frontlogout');
                                }else{
                                    // go to paypal thanks
                                    return redirect('/PaypalThanksPage');
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    // Cash on delivery method thnaks page

    public function CODThanksPage(Request $request)
    {
        $user_id = Auth::user()->id; // get the user_Id
        $userDetailes = User::findOrfail($user_id); // the way to fetch the detailes of the current user
        $countries = country::get(); // get the countries data from countries table
        $userEmail = Auth::user()->email; // get the user email
        $orderTabel = ProductOrder::where('id', $user_id)->get(); // get the data from product_orders table
        $orderDetailes = order::where('user_email', $userEmail)->get(); // get the data from orders table
        // once the user get the thanks page we have to remove all data in cart table

        // once the COD dane then Send Email to User

        // get the order data to send it with the email
        $ORderDataForMail = order::with('orders')->where('id', Session::get("order_id"))->first();
        $Email =$userEmail;
        $messageDate = [
            'email' => $Email,
            'name' => $userDetailes->name,
            'order_id' => Session::get("order_id"),
            'productDetailes' => $ORderDataForMail,

        ];
        Mail::send('emails.CODDetailes', $messageDate, function ($message) use ($Email) {
            $message->from('alomda.alslmat@gmail', 'AboStore');
            $message->to($Email);
            $message->subject('The Cod payment has been approved wait for more detalies');
        });

        // header cart show detalies
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();

        } else {
            $session_id = Session::get('session_id');
            $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
        }

        // create loop to get the product_id then get the image from product table where both have a relation

        foreach ($CartDetalies as $key => $product) {
            // to get image from product table
            $getImageCart = Products::where('id', $product->product_id)->first();
            $CartDetalies[$key]->image = $getImageCart->image;
        }

        shoppingCart::where('user_email', $userEmail)->delete();
        return view('Front-End.CODThanksPage', compact('CartDetalies', 'userDetailes', 'countries', 'orderTabel', 'orderDetailes'));

    }

    // paypal method thanks page

    public function PaypalThanksPage()
    {
        // clear the cart table once the user get the paypal thanks page
        $userEmail = Auth::user()->email; // get the user email
        shoppingCart::where('user_email', $userEmail)->delete();
        // header cart show detalies
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();

        } else {
            $session_id = Session::get('session_id');
            $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
        }

        // create loop to get the product_id then get the image from product table where both have a relation

        foreach ($CartDetalies as $key => $product) {
            // to get image from product table
            $getImageCart = Products::where('id', $product->product_id)->first();
            $CartDetalies[$key]->image = $getImageCart->image;
        }

        return view('Front-End.PaypalThanksPage', compact('CartDetalies'));
    }

    // return to thanls paypal page from the paypal page
    public function returnPaypalThanks()
    {
        return view('Front-End.returnPaypalThanks');
    }

    public function CancelPaypal()
    {
        return view('Front-End.CancelPaypal');
    }
    // history of user orders

    public function HistoryOrder()
    {

        // get the user_id
        $user_id = Auth::user()->id;

        // get the data from Order table

        $orderTable = order::orderBy('created_at', 'DESC')->with('orders')->where('user_id', $user_id)->get();
        // header cart show detalies
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();

        } else {
            $session_id = Session::get('session_id');
            $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
        }

        // create loop to get the product_id then get the image from product table where both have a relation

        foreach ($CartDetalies as $key => $product) {
            // to get image from product table
            $getImageCart = Products::where('id', $product->product_id)->first();
            $CartDetalies[$key]->image = $getImageCart->image;
        }
        return view('Front-End.History', compact('CartDetalies', 'orderTable'));
    }

    public function ProductOrderDetailes($order_id)
    {
        // get the user_id
        $user_id = Auth::user()->id;

        // get the data from Order table

        $orderTable = order::with('orders')->where('id', $order_id)->first();
        // header cart show detalies
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();

        } else {
            $session_id = Session::get('session_id');
            $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
        }

        // create loop to get the product_id then get the image from product table where both have a relation

        foreach ($CartDetalies as $key => $product) {
            // to get image from product table
            $getImageCart = Products::where('id', $product->product_id)->first();
            $CartDetalies[$key]->image = $getImageCart->image;
        }

        return view('Front-End.MoreProductDetalies', compact('CartDetalies', 'orderTable'));
    }

    // log out method
    public function Frontlogout()
    {
        Auth::logout();
        // this step is important to force user to login before enter any page under middleware section.
        Session::forget('frontsession');
        // once the user log out need to forget the session_id of the cart
        Session::forget('session_id');
        return redirect('/');
    }

}
