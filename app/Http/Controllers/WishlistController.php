<?php

namespace App\Http\Controllers;

use App\Products;
use App\User;
use Session;
use App\Wishlist;
use Auth;
use DB;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function ViewWishlistPage(){
        //get user email
        if(Auth::check()){
            $user_email = Auth::user()->email;
        }

        $viewWishlistPage = Wishlist::where("user_email",$user_email)->get();
        // create loop to get the product_id then get the image from product table where both have a relation
        foreach ($viewWishlistPage as $key => $product) {
            // to get image from product table
            $getImageCart = Products::where('id', $product->product_id)->first();
            $viewWishlistPage[$key]->image = $getImageCart->image;
        }
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
         $meta_title = "Home | Wish-List"; // name of the main website
        return view('Front-End.wishlist',compact('viewWishlistPage','meta_title','CartDetalies'));
    }

    // get the data of prduct and insert it in table wish list

    public function AddToWishlist($id){
        // get product detailes
        $productInfo = Products::where('id',$id)->first();
        //get the user_name email
        if(Auth::check()){
            $user_email = Auth::user()->email;
        }else{
            Session::forget("checkwishlist");
        }
        $checkwishlist = Wishlist::where('product_id',$id)->count();
        if($checkwishlist> 0 ){
            $checkwishlistshow = Wishlist::where('product_id',$id)->get();
            foreach($checkwishlistshow as $product){

            }
            Session::put("checkwishlist",$checkwishlist);
            return redirect()->back();
        }
        else{
            //insert data to wishlist table
            $insertData = array(
            "product_id"=>$productInfo->id,
            "user_email"=>$user_email,
            "product_name"=>$productInfo->proc_name,
            "product_code"=>$productInfo->proc_code,
            "product_size"=>'Small',
            "product_color"=>$productInfo->color,
            "product_price"=>$productInfo->price,
            "quantity"=>1,
            "created_at"=>now(),
            "updated_at"=>now(),
        );
        // inseert the data above to save in table
            Wishlist::insert($insertData);
            return redirect()->back();
        }
    }

}
