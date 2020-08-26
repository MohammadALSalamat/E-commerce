<?php

namespace App\Exports;

use App\Category;
use App\Products;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportProducts implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // this function use to get the data from 2 tables
        $getProducts = Products::select("id","cat_id" ,'proc_name' ,'price','proc_code','color')->get();
        foreach($getProducts as $key => $product){
            $catName = Category::select("name")->where("id",$product->cat_id)->first();
            $getProducts[$key]->cat_id = $catName->name;
        }
        return $getProducts;
    }
    public function Headings():array{
        return ["id","Category_Name",'Procduct_name' ,'Price','Procduct_Code','Color'];
    }
}
