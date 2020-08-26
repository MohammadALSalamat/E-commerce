<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\shoppingCart;
use App\productAttr;
use Auth;
use Session;

class Products extends Model
{
    public function ProcAttr(){
        // this link to make relationship with productAttr table in product_id
        return $this->hasMany('\App\productAttr','product_id');




    }
    // create static function to count the items that in shipping cart depends on login user
    // we use this kind of work to show it in front in directly so all we need to do is add the model there
    public static function CartCount(){
        // check if the user is login or not
        if(Auth::check()){
            // if the user login then get his user_Email
            $user_email = Auth::user()->email;
            $cartCount = shoppingCart::where('user_email',$user_email)->sum('quantity');

        }else{
            //if the user not login then get the session_id
            $session_id = Session::get('session_id');
            $cartCount =shoppingCart::where('session_id',$session_id)->sum('quantity');

        }

        return $cartCount;
    }

    // count the product and show it in front end

    public static function ProductCount($cat_id){
        // get the product

        return $cartCount;
    }

    // count the categories
    public static function CategoryCount($cat_id){
        // get the Categories
        $countCategory = Products::where(['cat_id'=>$cat_id])->count();
        return $countCategory;
    }

    // get the current price to block the hack

    public static function getTheCartPrice($id , $product_size){
        $getThePrice = productAttr::select('price')->where(["product_id"=>$id , "size"=>$product_size])->first();
        return $getThePrice->price;
    }

    // show the currency in front end side

    public static function getCurrency($price){
        $getCurrency = Currency::where('status',1)->get();
        foreach($getCurrency as $getprice){
            // check if the currency is RYM
            if($getprice->currency_code == 'RYM'){
                $MYR_Rate = round($price*$getprice->exchange_rate,2);
            }

        }
          // make array to get all the data
            $currencyArry = array('RYM_Rate' => $MYR_Rate);

            return $currencyArry;
    }
}
