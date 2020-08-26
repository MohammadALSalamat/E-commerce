<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     *  this is the second way to get the Category with relation database
     * we use this way if we want to avoid the FIrst way which  you can see it in the FrontIndexController@index
     * this way is recomend besuse its easy and short
     *
     *  we use the relation hasMany('Model Name "\App\Category" ','Column Name "parent_id"');
     *
     * once we do so we go to FrontIndexController@index and update the function as below
     * we add with('frontCategory') to make the relation thats all..
     * $Showcategory = Category::with('frontCategory')->where(['parent_id'=>0])->get();
     */

    public function frontCategory(){

        return $this->hasMany('\App\Category','parent_id');
    }

}
