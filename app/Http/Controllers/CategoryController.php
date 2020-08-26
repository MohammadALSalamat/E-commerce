<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function create()
    {
        // security part to check if the user try to enter the password page through URl or login form
        if (Session::has('AdminSession')) {
            // run to dashboard
        } else {
            return redirect('/admin')->with('error', 'Sorry you have to Login First ');
        }

        // create levels for category such as " main category and sub catgory ,, OR ,, parent and child "
        $levels =Category::where(['parent_id'=> 0])->get();
        return view('admin.category.createCategory',compact('levels'));
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
            $data= $request->all();

            //check the status of the category if 1 or 0 to do the next action

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1 ;
            }

             if(empty($data['Meta_title'])){
                $data['Meta_title'] = "";
            }
            if(empty($data['Meta_dec'])){
                $data['Meta_dec'] = "";
            }
            if(empty($data['Meta_Keywords'])){
                $data['Meta_Keywords'] = "";
            }

            $category = new Category;
            $category->parent_id =$data['Level'] ;
            $category->name =$data['cat_name'];
            $category->descrption =$data['cat_dec'];
            $category->url =$data['url'];
            $category->meta_title = $data['Meta_title'];
            $category->meta_description = $data['Meta_dec'];
            $category->meta_Keywords = $data['Meta_Keywords'];
            $category->status =$status;
            $category->save();

        }
        return redirect('admin/category/createCategory')->with('success', 'Congrats You have add New Item to your Database ');
    }

    public function show()
    {
        // get all Records from database to shoe it in page
        $Categories = Category::get();
        return view('admin/category/viewCategory', compact('Categories'));
    }






    public function edit(\App\Category $item) // in this way get all records in the table
    {
        // create levels for category such as " main category and sub catgory ,, OR ,, parent and child "
        //This will help us to create the Category and then let other categories related to it as sub-category

        $levels =Category::where(['parent_id'=> 0])->get();

        return view('admin/category/edit', compact('item','levels'));

    }





    public function update(Request $request, $item) // in this way get id in the table
    {
        if ($request->isMethod('patch')) {
            $data= $request->all();


            //check the status of the category if 1 or 0 to do the next action

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1 ;
            }

             if(empty($data['Meta_title'])){
                $data['Meta_title'] = "";
            }
            if(empty($data['Meta_dec'])){
                $data['Meta_dec'] = "";
            }
            if(empty($data['Meta_Keywords'])){
                $data['Meta_Keywords'] = "";
            }

            Category::where(['id'=>$item])->update([
             'name'=>$data['cat_name'],
             'parent_id'=>$data['Level'],
             'descrption'=>$data['cat_dec'],
             'url'=>$data['url'],
            'meta_title' => $data['Meta_title'],
            'meta_description' => $data['Meta_dec'],
            'meta_Keywords' => $data['Meta_Keywords'],
             'status'=>$status
                          ]);
        }
        return redirect('admin/category/viewCategory')->with('success', 'Your item has been Updated');
    }




    public function delete($id)
    {
        if (!empty($id)) {
            Category::where(['id'=>$id])->delete();
        };
        return redirect()->back()->with('success', 'Your item has been Deleted');
    }
}
