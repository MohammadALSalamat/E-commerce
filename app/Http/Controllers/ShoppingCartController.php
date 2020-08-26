<?php

namespace App\Http\Controllers;

use App\coupon;
use App\productAttr;
use App\Products;
use App\shoppingCart;
use App\Wishlist;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class ShoppingCartController extends Controller
{
    /**
     * start to get the informations from the add to cart button then show it all in add to cart page
     *
     * it is very important to add the classes in the top of page to get the relastions as well
     *
     * notice the way to insert the data using the laravel functions
     *
     * there are many ways to insert data such as use array inside the insert function or make it var alone
     *
     * session_id is important part for users that does not register to website where the session id will help
     * to remember those people and let them use the website to add to cart
     *
     */

    // show detailes function

    public function insertDataToCart(Request $request)
    {
        $data = $request->all();

        //check the information that comes from Add to cart or add to wishlist
        if(!empty($data['Wishlist'])&& $data['Wishlist'] == 'Wishlist'){
            if(!Auth::check()){
            return redirect()->back()->with("error" , " Please Login First To Add The Item To Your WhisList");
            }else{
                //get the user email
                $user_email = Auth::user()->email;
            }
            if ($data['size']== "0") {
                return redirect()->back()->with('error', 'Please Select The Size Of This Product. It is Required');
            }
            // this line use to get the size as it is name without any addetional data
            $sizeArr = explode('-', $data['size']);

            // get the price depends on the size of the item from productAttr table
            $getPrice = productAttr::where(['product_id'=>$data['product_id'] , 'size'=>$sizeArr[1]])->first();
            $checkwishlist = Wishlist::where(['product_id'=>$data['product_id'] ,'user_email' =>$user_email ,'product_color'=>$data['product_color'],'product_size'=>$sizeArr[1]])->count();
            if($checkwishlist > 0 ){
                return redirect()->back()->with('error' , 'This Item Is Already Exsist In Wishlist');
            }else{
            $insertData = array(
            "product_id"=>$data['product_id'],
            "user_email"=> $user_email,
            "product_name"=>$data['product_name'],
            "product_code"=>$data['product_code'],
            "product_size"=>$sizeArr[1],
            "product_color"=>$data['product_color'],
            "product_price"=>$getPrice->price,
            "quantity"=>1,
            "created_at"=>now(),
            "updated_at"=>now(),
            );

               // inseert the data above to save in table
            Wishlist::insert($insertData);
            return redirect()->back()->with("success","Your Item Has Been Add To Your WishList");
            }
    }elseif(!empty($data['FormWishlist'])&& $data['FormWishlist'] == 'FormWishlist'){
        //insert data to cart from wish list direct
        // the quantity +1 otherwise add it to cart as new item
            $getSku = productAttr::select('sku')->where([
            'product_id' => $data['product_id']
            , 'size' => $data['size'],
            ])->first();
        // get the Stock value from product attribuate to use it to check if the item is in cart then update
            // the quantity +1 otherwise add it to cart as new item
            $getStock = productAttr::select('stock')->where([
            'product_id' => $data['product_id']
            , 'size' => $data['size'],
            ])->first();
        // forget sessions to delete the asign info this will help to update the cart daynamic
        Session::forget('couponAmount'); // forget couponAmount in seesion
        Session::forget('couponCode'); // forget coupon name that user typed in seesion
            // get session_id for users .it get number of latters randomly this will help to store the products
            // for one user that have the same session id
            $session_id = Session::get('session_id');
            if (!isset($session_id)) {
                $session_id = Str::random(30);
                Session::put('session_id', $session_id);
            }
            // if the user not registered then make it empty else sign the user email that register with
            if (empty(Auth::user()->email)) {
                $data['user_email'] = '';
            } else {
                $data['user_email'] = Auth::user()->email;
            }
        // compare the quantity that user insert with the stock
            if ($getStock->stock >= $data['quantity']) {
                // insert the getting data inside the cart table
                // fetch the data fromt the form
                $insertData = array(
                "product_id" => $data['product_id'],
                "product_name" => $data['product_name'],
                "product_code" => $getSku->sku, // update the line to accept the new value of stock
                "product_color" => $data['product_color'],
                "product_size" => $data['size'],
                "product_price" => $data['product_price'],
                "quantity" => $data['quantity'],
                "user_email" => $data['user_email'],
                "session_id" => $session_id,
                "created_at" => now(),
                "updated_at" => now(),

            );
         // this line to check if the item is already in cart if so then dont allow it to insert to cart again
                $checkExitstItem = shoppingCart::where(['product_id' => $data['product_id'],
                "product_color" => $data['product_color'],
                "product_size" => $data['size'],
                "session_id" => $session_id,
            ])->count();
                // insert the data like this to cart table
                if ($checkExitstItem == 0) {

                // get the informations and send all to the shooping cart its another way to insert all detailes
                    DB::table('shopping_carts')->insert($insertData);
                } else {
                    return redirect()->back()->with('error', 'Your item is Already Exist in cart!!! You can Updae the Quantity from the cart it self');
                }
                Wishlist::where(['id' => $data['id']])->delete();
                return redirect('/cart')->with('success', 'Your item has been sent to cart successfuly!!!');

            } else {
                return redirect()->back()->with('error', 'Sorry The Max Stock For This Product Is [' . $getStock->stock .'] Please Try Again');
            }

    } else{
        // forget sessions to delete the asign info this will help to update the cart daynamic
        Session::forget('couponAmount'); // forget couponAmount in seesion
        Session::forget('couponCode'); // forget coupon name that user typed in seesion
            // get session_id for users .it get number of latters randomly this will help to store the products
            // for one user that have the same session id
            $session_id = Session::get('session_id');
            if (!isset($session_id)) {
                $session_id = Str::random(30);
                Session::put('session_id', $session_id);
            }
            // if the user not registered then make it empty else sign the user email that register with
            if (empty(Auth::user()->email)) {
                $data['user_email'] = '';
            } else {
                $data['user_email'] = Auth::user()->email;
            }

            if ($data['size']== "0") {
                return redirect()->back()->with('error', 'Please Select The Size Of This Product It is Required');
            }
            // this line use to get the size as it is name without any addetional data
            $sizeArr = explode('-', $data['size']);
            // get the sku value from product attribuate to use it to check if the item is in cart then update
            // the quantity +1 otherwise add it to cart as new item
            $getSku = productAttr::select('sku')->where([
            'product_id' => $data['product_id']
            , 'size' => $sizeArr[1],
        ])->first();

            // get the Stock value from product attribuate to use it to check if the item is in cart then update
            // the quantity +1 otherwise add it to cart as new item
            $getStock = productAttr::select('stock')->where([
            'product_id' => $data['product_id']
            , 'size' => $sizeArr[1],
        ])->first();

                if(empty($data['pincode'])){
                    return redirect()->back()->with("error" , "Please Enter Your City Zip Code. ");
                }
            // compare the quantity that user insert with the stock
            if ($getStock->stock >= $data['quantity']) {
                // insert the getting data inside the cart table
                // fetch the data fromt the form
                $insertData = array(
                "product_id" => $data['product_id'],
                "product_name" => $data['product_name'],
                "product_code" => $getSku->sku, // update the line to accept the new value of stock
                "product_color" => $data['product_color'],
                "product_size" => $sizeArr[1],
                "product_price" => $data['product_price'],
                "quantity" => $data['quantity'],
                "user_email" => $data['user_email'],
                "session_id" => $session_id,
                "created_at" => now(),
                "updated_at" => now(),

            );
                // this line to check if the item is already in cart if so then dont allow it to insert to cart again
                $checkExitstItem = shoppingCart::where(['product_id' => $data['product_id'],
                "product_color" => $data['product_color'],
                "product_size" => $sizeArr[1],
                "session_id" => $session_id,
            ])->count();
                // insert the data like this to cart table
                if ($checkExitstItem == 0) {

                // get the informations and send all to the shooping cart its another way to insert all detailes
                    DB::table('shopping_carts')->insert($insertData);
                } else {
                    return redirect()->back()->with('error', 'Your item is Already Exist in cart!!! You can Updae the Quantity from the cart it self');
                }
                return redirect('/cart')->with('success', 'Your item has been sent to cart successfuly!!!');
            } else {
                return redirect()->back()->with('error', 'Sorry The Max Stock For This Product Is [' . $getStock->stock .'] Please Try Again');
            }
        }

    }

    public function ShowCartDetalies()
    {

        // check if the user is login then get all data that he stored in cart if not then use the session to get them
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

        // get the name of the website * Meta Tags *
         $meta_title = "Home | Shopping-Cart"; // name of the main website
        return view('Front-End/cart')->with(compact('CartDetalies','meta_title'));
    }

    // Function to handel the quantity of iteams where if the user press on + it will increase

    public function updateQuantity($id, $quantity)
    {
        // forget sessions to delete the asign info this will help to update the cart daynamic
        Session::forget('couponAmount'); // forget couponAmount in seesion
        Session::forget('couponCode'); // forget coupon name that user typed in seesion
        // fetch the data from cart table
        $cartData = shoppingCart::where('id', $id)->first();
        // get the sku data from productAtrr table that match with product_code in cart table
        // we use this data to get the stock value where we need it to check if stock is more than 0 to show it
        $getSku = productAttr::where('sku', $cartData->product_code)->first();

        $updateQuantity = $cartData->quantity + $quantity;

        if ($getSku->stock >= $updateQuantity) {
            // the way to incease the item 1 by pressing on + and when click on  - then will decrease by 1
            shoppingCart::where('id', $id)->increment('quantity', $quantity);
            return redirect()->back()->with('success', 'Your item has been updated');
        } else {

            return redirect()->back()->with('error', ' Sorry This item has only [' . ' ' . $getSku->stock . ' ' . '] Quantity, You Can not Add more');
        }

    }

    public function DeleteItem($id)
    {
        // forget sessions to delete the asign info this will help to update the cart daynamic
        Session::forget('couponAmount'); // forget couponAmount in seesion
        Session::forget('couponCode'); // forget coupon name that user typed in seesion
        if (!empty($id)) {
            shoppingCart::where(['id' => $id])->delete();
        }
        return redirect()->back()->with('success', 'Your item has been Deleted');
    }

    public function DeleteItemFromWishlist($id)
    {

        // forget sessions to delete the asign info this will help to update the cart daynamic
        Session::forget('couponAmount'); // forget couponAmount in seesion
        Session::forget('couponCode'); // forget coupon name that user typed in seesion
        if (!empty($id)) {
            Wishlist::where(['id' => $id])->delete();
        }
        return redirect()->back()->with('success', 'Your item has been Deleted');
    }

    // this side for coupon .. here will check if the coupon that user uses is valid or not

    public function applycoupon(Request $request)
    {
         // forget sessions to delete the asign info this will help to update the cart daynamic
        Session::forget('couponAmount'); // forget couponAmount in seesion
        Session::forget('couponCode'); // forget coupon name that user typed in seesion
        $data = $request->all();
        $couponCount = coupon::where('coupon_code', $data['cop_code'])->count();

        if ($couponCount == 0) {
            return redirect()->back()->with('error', 'Sorry this coupon code is not Exist');
        } else {
            // get the coupon detailes to check if the status is active or not
            $couponDetailes = coupon::where('coupon_code', $data['cop_code'])->first();

            if ($couponDetailes->status == 0) {
                return redirect()->back()->with('error', ' This Coupon Code Is Not Active Yet , Thank you ');
            }

            // check the expiry date now of the coupon

            $expiry_date = $couponDetailes->expiry_date;
            $current_date = date('Y-m-d');

            if ($expiry_date < $current_date) {
                return redirect()->back()->with('error', ' This Coupon Code Is Expired , Thank you ');
            } else {
                // $discound = ($couponDetailes->product_price) / $couponDetailes->coupon_amount  ;

                if (Auth::check()) {
                    $user_email = Auth::user()->email;
                    $CartDetalies = DB::table('shopping_carts')->where(['user_email' => $user_email])->get();

                } else {
                    //find the total amount to do the discound by using Seesion_id
                    $session_id = Session::get('session_id');
                    $CartDetalies = DB::table('shopping_carts')->where(['session_id' => $session_id])->get();
                }

                // create loop to get the product_id then get the image from product table where both have a relation
                $totalAmount = 0;
                foreach ($CartDetalies as $item) {
                    // to get the total amount
                    $totalAmount = $totalAmount + ($item->quantity * $item->product_price);
                }

                // check the type of discound is it by Fixed or Presantege
                if ($couponDetailes->amount_type == "Fixed") {
                    $couponAmount = $couponDetailes->coupon_amount;

                } else {
                    $couponAmount = $totalAmount * ($couponDetailes->coupon_amount / 100);
                }

                // Add coupon Anoumt in session to use it later to delete the info isnide coupons then we need to forget as in top
                Session::put('couponAmount', $couponAmount); // save couponAmount in seesion
                Session::put('couponCode', $data['cop_code']); // save coupon name that user typed in seesion
                return redirect()->back()->with('success', ' This Coupon Code Is valid , Thank you For using our Products ');

            }
        }

    }

}
