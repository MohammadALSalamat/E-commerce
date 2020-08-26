<?php

namespace App;
use Auth;


use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public static function WishListCount(){
        // check if the user is login or not
        if(Auth::check()){
            // if the user login then get his user_Email
            $user_email = Auth::user()->email;
            $WishListCount = Wishlist::where('user_email',$user_email)->count();

        }else{
            $WishListCount = 0;
        }

        return $WishListCount;
    }
}
