<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AltrenImage;
use App\Category;
use App\productAttr;
use App\Products;
use Auth;
use DB;
use Illuminate\Support\Facades\array_flatten;
use Image;
use Session;
use App\Exports\ExportProducts;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    public function create()
    {

        // security part to check if the user try to enter the password page through URl or login form
        if (Session::has('AdminSession')) {
            // run to dashboard
        } else {
            return redirect('/admin')->with('error', 'Sorry you have to Login First ');
        }

        // new Way to get somthing from another table to pass it in another table
        $categories = Category::where(['parent_id' => 0])->get();
        $cat_select_option = "<option selected disabled> Select Category </option>";
        foreach ($categories as $cat) {
            $cat_select_option .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
            //Fetch sub-categories and display all under its main Category
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $cat_select_option .= "<option value='" . $sub_cat->id . "'>&nbsp;--> &nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('admin/product/createProducts', compact('cat_select_option'));
    }

    public function store(Request $request)
    {
        if (Session::has('AdminSession')) {
            // run to dashboard
        } else {
            return redirect('/admin')->with('error', 'Sorry you have to Login First ');
        }
        // anthoer way to store data after creating items
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (empty($data['featuer_item'])) {
                $featuer_item = 0;
            } else {
                $featuer_item = 1;
            }
            $product = new Products;
            $product->cat_id = $data['Category_id'];
            $product->featuer_item = $featuer_item;
            $product->proc_name = $data['proc_name'];
            $product->descrption = $data['proc_dec'];
            $product->Care = $data['care'];
            $product->price = $data['price'];
            $product->proc_code = $data['code'];
            $product->color = $data['color'];
            //Uplode Image and Create Image folders
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->clientExtension();
                    // add random number to image
                    $filename = rand(1, 1000000) . '.' . $extension;
                    // Create path
                    $larg_image_path = 'images/images_backend/larg_image_size/' . $filename;
                    $meduim_image_path = 'images/images_backend/meduim_image_size/' . $filename;
                    $small_image_path = 'images/images_backend/small_image_size/' . $filename;
                    // resize the images
                    Image::make($image_tmp)->save($larg_image_path); // Main size of image suppose to be large(1200,1200);
                    Image::make($image_tmp)->resize(600, 600)->save($meduim_image_path); // change the size to be 600,600
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path); // change the size to be 300 ,300

                    // store the final image to product table
                    $product->image = $filename;
                }
            }
            //Uplode Video and Create Video folders
            if ($request->hasFile('video')) {
                $video_tmp = $request->file('video');
                $viedo_name = $video_tmp->getClientOriginalName(); // use for videos
                $viedo_path = 'videos/';
                // store the final image to product table
                $video_tmp->move($viedo_path, $viedo_name);
                $product->video = $viedo_name;
            }

            $product->save();
        }
        return redirect('admin/product/create')->with('success', 'Congrats You have add New Item to your Database ');
    }

    public function show()
    {
        $products = Products::get();
        //display the category name on product table
        foreach ($products as $key => $val) {
            $category_name = Category::where(['id' => $val->cat_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin/product/viewProducts', compact('products'));
    }
    public function showFeatuers()
    {
        $products = Products::get();
        //display the category name on product table
        foreach ($products as $key => $val) {
            $category_name = Category::where(['id' => $val->cat_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin/product/addNewFeatuers', compact('products'));
    }

    public function edit(\App\Products $Product)
    {
        // new Way to get somthing from another table to pass it in another table
        $categories = Category::where(['parent_id' => 0])->get();
        $cat_select_option = "<option selected disabled> Select Category </option>";
        foreach ($categories as $cat) {
            // check if we have any value to print it
            if ($cat->id == $Product->cat_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $cat_select_option .= "<option value='" . $cat->id . "'" . $selected . ">" . $cat->name . "</option>";
            //Fetch sub-categories and display all under its main Category
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                // heck if we have any value to print it
                if ($sub_cat->id == $Product->cat_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $cat_select_option .= "<option value='" . $sub_cat->id . "' " . $selected . ">&nbsp;--> &nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('admin/product/edit', compact('Product', 'cat_select_option'));
    }
    public function update(Request $request, $product) // in this way get id in the table
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //Uplode Image and Create Image folders
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->clientExtension();
                    // add random number to image
                    $filename = rand(1, 1000000) . '.' . $extension;
                    // Create path
                    $larg_image_path = 'images/images_backend/larg_image_size/' . $filename;
                    $meduim_image_path = 'images/images_backend/meduim_image_size/' . $filename;
                    $small_image_path = 'images/images_backend/small_image_size/' . $filename;
                    // resize the images
                    Image::make($image_tmp)->save($larg_image_path); // Main size of image suppose to be large(1200,1200);
                    Image::make($image_tmp)->resize(600, 600)->save($meduim_image_path); // change the size to be 600,600
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path); // change the size to be 300 ,300
                }
            } else {
                $filename = $data['currnt_image'];
            }
            //Uplode Video and Create Video folders
            if ($request->hasFile('video')) {
                $video_tmp = $request->file('video');
                $viedo_name = $video_tmp->getClientOriginalName(); // use for videos
                $viedo_path = 'videos/';
                // store the final image to product table
                $video_tmp->move($viedo_path, $viedo_name);
            } else {
                $viedo_name = $data['currnt_video'];
            }
            if (empty($data['featuer_item'])) {
                $featuer_item = 0;
            } else {
                $featuer_item = 1;
            }
            Products::where(['id' => $product])->update([
                'cat_id' => $data['Category_id'],
                'featuer_item' => $featuer_item,
                'proc_name' => $data['proc_name'],
                'descrption' => $data['proc_dec'],
                'Care' => $data['care'],
                'price' => $data['price'],
                'proc_code' => $data['code'],
                'color' => $data['color'],
                'image' => $filename,
                'video' => $viedo_name,
            ]);
        }
        return redirect('admin/product/viewProducts')->with('success', 'Your item has been Updated');
    }

    public function deletImage($product)
    {
        // to delet the Image path we have to do few steps 1-) get the image names

        $ProductImage = Products::where(['id' => $product])->first();

        //2-) get the images paths
        $larg_image_path = 'images/images_backend/larg_image_size/';
        $meduim_image_path = 'images/images_backend/meduim_image_size/';
        $small_image_path = 'images/images_backend/small_image_size/';

        //3-) check if the image name is exists then delete it
        // delete larg image
        if (file_exists($larg_image_path . $ProductImage->image)) {
            // unlink uses to delete the image from the main file
            unlink($larg_image_path . $ProductImage->image);
        }
        // delete Medium image
        if (file_exists($meduim_image_path . $ProductImage->image)) {
            // unlink uses to delete the image from the main file
            unlink($meduim_image_path . $ProductImage->image);
        }
        // delete smal image
        if (file_exists($small_image_path . $ProductImage->image)) {
            // unlink uses to delete the image from the main file
            unlink($small_image_path . $ProductImage->image);
        }

        Products::where(['id' => $product])->update(['image' => '']);
        return redirect()->back()->with('success', 'Your Image has been Deleted');
    }
    public function deletVideo($id)
    {
        // to delet the Image path we have to do few steps 1-) get the image names

        $ProductVideo = Products::where(['id' => $id])->first();

        //2-) get the images paths
        $videoPath = 'videos/';

        //3-) check if the video name is exists then delete it
        // delete larg video
        if (file_exists($videoPath . $ProductVideo->video)) {
            // unlink uses to delete the video from the main file
            unlink($videoPath . $ProductVideo->video);
        }

        Products::where(['id' => $id])->update(['video' => '']);
        return redirect()->back()->with('success', 'Your Video has been Deleted');
    }

    public function delete(Request $request, $id)
    {
        if (!empty($id)) {
            Products::where(['id' => $id])->delete();
        };
        return redirect()->back()->with('success', 'Your item has been Deleted');
    }

    /**
     *  Start the product Attribute page
     */

    public function addProductAttr(Request $request, $id)
    {
        // with('ProcAttr') ... this line is to confirm the relation between tables
        $ProductAttr = Products::with('ProcAttr')->where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            $data = $request->all();

            // this code use to fetch the data as Array(key => value)  then insert hidden id last save the data
            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {

                    // check if the database has same value  to declare the dplicate
                    $SKUDplicate = productAttr::where('sku', $val)->count();
                    if ($SKUDplicate > 0) {
                        return redirect('admin/addProductAttr/' . $id)->with('error', 'Your database has the same SKU name please change it  ');
                    }

                    // check if the database has same value  to declare the dplicate
                    $SIZEDplicate = productAttr::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($SIZEDplicate > 0) {
                        return redirect('admin/addProductAttr/' . $id)->with('error', 'Your database has the same Size name please change it  ');
                    }

                    $procAttr = new productAttr;
                    $procAttr->product_id = $id;
                    $procAttr->sku = $val;
                    $procAttr->size = $data['size'][$key];
                    $procAttr->price = $data['price'][$key];
                    $procAttr->stock = $data['stock'][$key];
                    $procAttr->save();

                }
            }
            return redirect('admin/addProductAttr/' . $id)->with('success', 'Your Attributs has been Saved To Product ' . $ProductAttr->proc_names);
        }

        return view('admin/product/addProductAttr', compact('ProductAttr'));

    }

    public function EditProductAttr(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // make  loop to fetch the array of the attribuates
            foreach ($data['idAttr'] as $key => $Attr) {
                productAttr::where(['id' => $Attr])->update([
                    'price' => $data['priceAttr'][$key],
                    'stock' => $data['stockAttr'][$key],
                ]);

            }

            return redirect()->back()->with('success', 'Your item has been Updated successfuly!!!');

        }

    }

    public function Attrdelete(Request $request, $id)
    {
        if (!empty($id)) {
            productAttr::where(['id' => $id])->delete();
        };
        return redirect()->back()->with('success', 'Your Attribute has been Deleted');
    }

    public function addAltrnImage(Request $request, $id)
    {
        // with('ProcAttr') ... this line is to confirm the relation between tables
        $ProductAttr = Products::with('ProcAttr')->where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $images = $request->file('image');
                foreach ($images as $file) {
                    if ($file->isValid()) {
                        // prepare the data
                        $image = new AltrenImage;
                        $extension = $file->clientExtension();
                        // add random number to image
                        $filename = rand(1, 1000000) . '.' . $extension;
                        // Create path
                        $larg_image_path = 'images/images_backend/larg_image_size/' . $filename;
                        $meduim_image_path = 'images/images_backend/meduim_image_size/' . $filename;
                        $small_image_path = 'images/images_backend/small_image_size/' . $filename;
                        // resize the images
                        Image::make($file)->resize(600, 600)->save($larg_image_path); // Main size of image suppose to be large(1200,1200);
                        Image::make($file)->resize(300, 300)->save($meduim_image_path); // change the size to be 600,600
                        Image::make($file)->resize(150, 150)->save($small_image_path); // change the size to be 300 ,300

                        // Save it to databasae
                        $image->alter_image = $filename;
                        $image->product_id = $data['proc_id'];
                        $image->save();
                    }
                }
            }

            return redirect()->back()->with('success', ' You have Add Your Alterntive Images Successfuly!!!');
        }
        // get all images from the table
        $alternImage = AltrenImage::where(['product_id' => $id])->get();
        return view('admin/product/addAltrntiveImage', compact('ProductAttr', 'alternImage'));

    }

    public function AltrnImagedelete(Request $request, $id)
    {
        if (!empty($id)) {
            AltrenImage::where(['id' => $id])->delete();

        };
        return redirect()->back()->with('success', 'Your Alternate Image has been Deleted');
    }

/**
 * Important function to fetch the main category and subcategory then make their URL daymince
 *
 */

    public function ShowsingleProduct($url)
    {
        // Now we will check if the url is correct then do the opration otherwise show 404 Page

        $CountURL = Category::where(['url' => $url, 'status' => 1])->count();
        // count the product in cart and show it in header
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
            $getImageCart = Products::where('products.id', $product->product_id)->first();
            $CartDetalies[$key]->image = $getImageCart->image;

        }
        if ($CountURL == 1) {
            // Get the Data that has relation between Categpry and Product
            $Showcategory = Category::with('frontCategory')->where(['parent_id' => 0])->get();
            // get the category detalies to make relation with the product table
            $ShowsingleCategory = Category::where(['url' => $url])->first();

            // now we will do if statment to check if the main category has products in sub cateogry

            if ($ShowsingleCategory->parent_id == 0) {

                //Fetch all Data from Product Table of sub category of the main one
                $subcategory = Category::where(['parent_id' => $ShowsingleCategory->id])->get();

                // do loop to get all subcategories and a sign it to $subCat_id
                foreach ($subcategory as $subCat) {
                    // we will make $subCat_id as array to hold all values inside it
                    $subCat_id[] = $subCat->id;
                }
                // once we get all the id of subcategories we now try to display all using an array
                $Showproduct = Products::whereIn('products.cat_id', $subCat_id)->orderBy('products.id', 'DESC');
                $ParentBreadCrmb ="<a class='active' href='".$ShowsingleCategory->url ."'>".$ShowsingleCategory->name."</a>";
                $breadCrumb="";
            } else {
                //Fetch all Data from Product Table of sub category only
                $Showproduct = Products::where(['products.cat_id' => $ShowsingleCategory->id])->orderBy('products.id', 'DESC');
                // show the parent for the category if it has one to use it in breadCrumb
                $CategoryParent = Category::where("id",$ShowsingleCategory->parent_id)->first();
                if(!empty($CategoryParent)){
                $ParentBreadCrmb ="<a href='".$CategoryParent->url ."'>".$CategoryParent->name."</a>";
                // show the main category to use it for breadcrumbs navigation bar
                $breadCrumb = "<a class='active' href='".$ShowsingleCategory->url ."'>".$ShowsingleCategory->name."</a>";
                }else{
                    $ParentBreadCrmb ="";
                    $breadCrumb="";
                }
            }


            // fillter the products depend on the color

            if (!empty($_GET['color'])) {
                $ColorArry =explode('-', $_GET['color']);
                $Showproduct = $Showproduct->whereIn('products.color',$ColorArry);
            }
             // fillter the products depend on the size

            if (!empty($_GET['size'])) {
                $sizeArray =explode('-', $_GET['size']);
                $Showproduct = $Showproduct->join("product_attrs","product_attrs.product_id","=","products.id")
                ->select("products.*" ,"product_attrs.product_id","product_attrs.size")
                ->groupBy("product_attrs.product_id")
                ->whereIn('product_attrs.size',$sizeArray);
            }
            $Showproduct = $Showproduct->paginate(6);
         // to make the filter dynamic we have to set an array hold all colors and fetch the colors from database
            $ColorArry =Products::select('color')->groupBy('color')->pluck('color')->toArray();

            // fillter the  size and use pluck to convert it array
            $sizeArray = productAttr::select("size")->groupBy("size")->get()->pluck("size")->toArray();


            // get the name of the website * Meta Tags *
            $meta_title = $ShowsingleCategory->meta_title; // name of the main website
            $meta_description = $ShowsingleCategory->meta_description; // name of the main website
            $meta_keywords = $ShowsingleCategory->meta_keywords; // name of the main website

            return view('Front-End.listing', compact('CartDetalies', 'Showcategory', 'ShowsingleCategory', 'Showproduct', 'meta_title', 'meta_description', 'meta_keywords', 'url','ColorArry','sizeArray','breadCrumb','ParentBreadCrmb'));
        } else {
            // send the user to 404 page
            return abort(404);
        }
    }


    //Export Products
    public function ExportProducts(){
        return Excel::download(new ExportProducts , "Products_Excel.xlsx");
    }

}
