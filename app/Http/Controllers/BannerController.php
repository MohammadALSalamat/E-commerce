<?php

namespace App\Http\Controllers;

use App\banner;
use Image;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function addbanner(Request $request)
    {
        return view('admin/banners/addbanner');
    }

    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();

             //Uplode Image and Create Image folders
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->clientExtension();
                    // add random number to image
                    $filename = rand(1, 1000000) . '.' . $extension;
                    // Create path
                    $image_path = 'images/images_frontend/banners/' . $filename;
                    // resize the images
                  Image::make($image_tmp)->resize(300, 300)->save($image_path); // change the size to be 300 ,300

                }
            }

            // get the status
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1 ;
            }
            // descrip if empty
            if(empty($data['ban_dec'])){
                $data['ban_dec'] = '';
            }
            // descrip if empty
            if(empty($data['link'])){
                $data['link'] = '';
            }
            $banner = new banner;
            $banner->image =$filename;
            $banner->Title =$data['ban_name'];
            $banner->description =$data['ban_dec'];
            $banner->link =$data['link'];
            $banner->status =$status;
            $banner->save();
        }
      return redirect()->back()->with("success"," your Data has been Inserted successfuly!!!");
    }

    public function viewbanner()
    {
        $views = banner::get();
        return view('admin/banners/viewbanner',compact('views'));
    }

    public function editbanner($id)
    {
        $banner =banner::where(['id'=>$id])->first();
        return view('admin/banners/editbanner',compact('banner'));
    }

    public function deletImage($id)
    {
        // to delet the Image path we have to do few steps 1-) get the image names

        $ProductImage = banner::where(['id'=>$id])->first();

        //2-) get the images paths
         $image_path = 'images/images_frontend/banners/';

         //3-) check if the image name is exists then delete it
         // delete larg image
         if(file_exists($image_path.$ProductImage->image)){
             // unlink uses to delete the image from the main file
             unlink($image_path.$ProductImage->image);
         }
        banner::where(['id' => $id])->update(['image' => '']);
        return redirect()->back()->with('success', 'Your Image has been Deleted');
    }

    public function updatebanner(Request $request,$id)
    {
            $data = $request->all();
              //Uplode Image and Create Image folders
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->clientExtension();
                    // add random number to image
                    $filename = rand(1, 1000000) . '.' . $extension;
                    // Create path
                    $image_path = 'images/images_frontend/banners/' . $filename;
                    // resize the images
                  Image::make($image_tmp)->resize(300, 300)->save($image_path); // change the size to be 300 ,300

                }
            }else{
                $filename = $data['currnt_image'];
            }

            // get the status
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1 ;
            }
            // descrip if empty
            if(empty($data['ban_dec'])){
                $data['ban_dec'] = '';
            }
            // descrip if empty
            if(empty($data['link'])){
                $data['link'] = '';
            }
            banner::where(['id'=>$id])->update([
            'image'=> $filename,
            'Title'=>$data['ban_name'],
            'description'=>$data['ban_dec'],
            'link'=>$data['link'],
            'status'=>$status
            ]);
            return redirect()->action('BannerController@viewbanner')->with('success',' Your banner has been updated');
    }

    public function deletebanner($id){
        if(!empty($id)){
            banner::where(['id'=>$id])->delete();
        }
        return redirect()->action('BannerController@viewbanner')->with('success',' Your banner has been deleted');

    }
}
