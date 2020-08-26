<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\AltrenImage;
use App\banner;
use App\Category;
use App\productAttr;
use App\Products;
use App\shoppingCart;
use App\subscribeUsers;
use App\Wishlist;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class FrontIndexController extends Controller
{
    public function index()
    {
        /**
         * ********************** Get Products **********************
         *
         *  there are few ways to sort the product
         * 1-) ASC "its by defualt"  $Showproduct = Products::get();
         *
         * 2-) DESC "use order By('column' ,'DESC')"  $Showproduct = Products::orderBy('created_at', 'DESC')->get();
         *
         * -3) Random " use inRandomOrder()"  $Showproduct = Products::inRandomOrder()->get();
         *
         * 4-) to get the pagination we use "paginate" to spicfice the number of pages to show otherwise use get()
         */
        // fetch the data from Product Table to show it in Home_page
        // just show the product that featuer_item is ==1 so the admin can disable the products

        $Showproduct = Products::orderBy('created_at', 'DESC')->where('featuer_item', 1)->paginate(6);



        /**
         * ********************** Get categories and sub-categories **********************
         *
         *  there are 2 ways to get the categories and sub-categories
         *
         * 1-) with database relations
         *
         * $Showcategory = Category::where(['parent_id'=>0])->get();
         *
         *2-) without database relations
         *
         *   $Showcategory = Category::with('frontCategory')->where(['parent_id'=>0])->get();
         *
         */

        // this is the first way $Showcategory = Category::where(['parent_id'=>0])->get();


        $Showcategory = Category::with('frontCategory')->where(['parent_id'=>0])->get();

        // define variable to hold the HTML code then return it to Home_page

        // This is the first way to get categories and sub-category without relation

        // IMPORTANT NOTE::  if you want to active this way then dont forget to add $ShowMainCategory to compact() and echo $ShowMainCategoryin HTML
       /**
         $ShowMainCategory ="";
            foreach($Showcategory as $cat){

                $ShowMainCategory .="  <div class='panel panel-default'>
                                        <div class='panel-heading'>
                                            <h4 class='panel-title'>
                                                <a data-toggle='collapse' data-parent='#accordian' href='#" . $cat->name ."'>
                                                    <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                                    " . $cat->name ."
                                                </a>
                                            </h4>
                                        </div>
                                        <div id='" . $cat->name ."' class='panel-collapse collapse'>
                                            <div class='panel-body'>
                                                <ul>";

                // get all sub category that related to the Main category
            $subCategory= Category::where(['parent_id' => $cat-> id])->get();{
                foreach ($subCategory as $subCat) {

                    $ShowMainCategory .=" <li><a href='#'>". $subCat->name. "</a></li>";}
                             $ShowMainCategory .="</ul>
                                            </div>
                                        </div>
                                    </div>";
            }
        }*/


         // get the banners detailes to show it in front end
        $banners = banner::where('status','1')->get();

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
         $meta_title = "Home | AboStore"; // name of the main website
         $meta_description = "Contact Admins if you have any issue or Question"; // name of the main website
         $meta_keywords = "problems , admins , users , issue , contact , contact us "; // name of the main website

        return view('Home_page',compact('Showproduct' ,'Showcategory','banners' ,'meta_description','meta_keywords','meta_title' ,'CartDetalies'));
    }


    // this function use to get all details of product to show it in Front-End
    public function QuickView($id){
        // Get the Data that has relation between Categpry and Product
        $Showcategory = Category::with('frontCategory')->where(['parent_id'=>0])->get();

        // get the Alternate Image to Show it
        $alternImage = AltrenImage::where('product_id', $id)->get();

        // get the product Data with the attribute .
        //First we have to check the relation in model between tables
        $quickview = Products::with('ProcAttr')->where(['id'=> $id ])->first();

        // this function use to sum the values of stock column to show it to user
        $totalStock = productAttr::where('product_id',$id)->sum('stock');

        // receument items Show the related items to the same category
        $relatedItems = Products::where('id','!=',$id)->where(['cat_id'=>$quickview->cat_id])->get();



            // breadCumb
            // get the category detalies to make relation with the product table
            $ShowsingleCategory = Category::where(['id' => $quickview->cat_id])->first();

            // now we will do if statment to check if the main category has products in sub cateogry

            if ($ShowsingleCategory->parent_id == 0) {
                $ParentBreadCrmb ="<a href='/product/".$ShowsingleCategory->url ."'>".$ShowsingleCategory->name."</a>";
                $breadCrumb="";
            } else {
               // show the parent for the category if it has one to use it in breadCrumb
                $CategoryParent = Category::where("id",$ShowsingleCategory->parent_id)->first();
                if(!empty($CategoryParent)){
                $ParentBreadCrmb ="<a href='/product/".$CategoryParent->url ."'>".$CategoryParent->name."</a>";
                // show the main category to use it for breadcrumbs navigation bar
                $breadCrumb = "<a href='/product/".$ShowsingleCategory->url ."'>".$ShowsingleCategory->name."</a>";
                }else{
                    $ParentBreadCrmb ="";
                    $breadCrumb="";
                }
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
         $meta_title = $quickview->proc_name; // name of the main website
         $meta_description = $quickview->descrption; // name of the main website
         $meta_keywords =$quickview->proc_name; // name of the main website





        return view('Front-End/Singleproduct',compact('quickview','Showcategory','alternImage','totalStock','relatedItems','meta_title','meta_description','meta_keywords' ,'CartDetalies','breadCrumb','ParentBreadCrmb'));
    }




       // search For the product using the button in Home Page

    public function SearchProducts(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
        $Showcategory = Category::with('frontCategory')->where(['parent_id'=>0])->get();
        $searchProduct= $data['search'];
        //get the resalt
        $Showproduct = Products::where('proc_name','like','%'.$searchProduct .'%')
                                        ->orwhere('proc_code','like','%'.$searchProduct .'%')
                                        ->orwhere('color','like','%'.$searchProduct .'%')
                                        ->orwhere('descrption','like','%'.$searchProduct .'%')
                                        ->paginate(6);
        // here is a dvance Query to get the product search  where the query above is the normal one
        // $Showproduct =Products::where(function($query) use($searchProduct){
        //     Products::where('proc_name','like','%'.$searchProduct .'%')->orwhere('proc_code','like','%'.$searchProduct .'%');
        // })->paginate(6);
        $ParentBreadCrmb ="<a class='active'>".$searchProduct."</a>";

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

        return view('Front-End.listing',compact('CartDetalies','Showproduct','Showcategory','searchProduct','ParentBreadCrmb'));

        }
    }


    // we use $request when we try to get informations from methods get or post
    public function AJAXgetPrice(Request $request){
        $data = $request->all();
        //we use the explode to delete the "-" between the output and put it in array
        $procAttr = explode('-',$data['IdSize']);
        // fetch data from Product Attribute table
        $getProcPrice =productAttr::where(['product_id'=> $procAttr[0] ,'size' => $procAttr[1]])->first();
          // last step change the code in AJAX to show the result and dont forget to echo the result like below
            // fetch all currencies as well
        $getCurrency = Products::getCurrency($getProcPrice->price);
        echo $getProcPrice->price."-". $getCurrency['RYM_Rate'];
        echo '#';
        // this line is to get the stock value then use it to hide the Cart button if its empty
        echo $getProcPrice->stock;

    }
    // get the pin code from database then return it to ajax form to see if its valid or not

    public function checkZipCode( Request $request){
        if($request->isMethod('post'));
        $data=$request->all();

        $getTheZipCodeFromDatabase = DB::table('pincodes')->where(['Suburb'=>$data['checkZipcode']])->count();
        if($getTheZipCodeFromDatabase > 0 ){
            echo 'True';
        }else{
            echo 'False';
        }
    }

    // start the filtter page // the rest of filttering in productsController@

    public function FillterProduct(Request $request){
        $data =$request->all();
        //define the url that color comes from
        $colorUrl = '';
        // loop the coming data
        if(!empty($data['colorFillter'])){
            foreach($data['colorFillter'] as $color){
                if(empty($colorUrl)){
                    $colorUrl = '&color='.$color;
                }else{
                    $colorUrl .= "-".$color;
                }
            }
        }
        $sizeUrl = '';
        // loop the coming data
        if(!empty($data['sizeFillter'])){
            foreach($data['sizeFillter'] as $size){
                if(empty($sizeUrl)){
                    $sizeUrl = '&size='.$size;
                }else{
                    $sizeUrl .= "-".$size;
                }
            }
        }
        // send the result through the URL
        $finalUrl = "product/".$data['url']."?".$colorUrl.$sizeUrl;
        return redirect::to($finalUrl);
    }
}
