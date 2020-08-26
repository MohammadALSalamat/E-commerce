<?php

namespace App\Http\Controllers;

use App\shipping_charge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    //view the shipping charge
    public function ViewShippingCharge(){
    $shippingCharge = shipping_charge::get();
    return view('admin.Shipping_Charge.view_shipping_charge',compact('shippingCharge'));
    }

    // edit page
    public function EditCharges($id){
        $getShipping = shipping_charge::where("id",$id)->first();
        return view("admin.Shipping_Charge.edit_shipping_charges",compact("getShipping"));
    }

    public function updateCharges( Request $request,$id){
        if($request->isMethod('patch')){
            $data = $request->all();
            shipping_charge::where("id",$id)->update([
                'shipping_charges0_500g' =>   $data['shipping500kg'],
                'shipping_charges501_1000g'=> $data['shipping1000kg'],
                'shipping_charges1001_2000g'=>$data['shipping2000kg'],
                'shipping_charges2001_5000g'=>$data['shipping5000kg'],
            ]);
        }
        return redirect()->action('ShippingChargeController@ViewShippingCharge')->with("success" , "Shipping Charge has been updated");
    }
}
