<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    // make relation with product Order table

    public function orders(){
        // first input is the name of table then the column that has relation with
        return $this->hasMany('\App\ProductOrder' , 'order_id');
    }

    // get the order detailes to use it in paypal form this must be static
    // we user tatic function when we try to use the model in HTML file  then fetch data from table
    // we can see this in paypalThanlks page
    public static function getOrderDetailes ($order_id){

        $getOrderDetailes = order::where('id',$order_id)->first();
        return $getOrderDetailes;
    }
}
