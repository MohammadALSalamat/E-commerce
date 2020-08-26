<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    //create new currency
    public function createCurrency(){

        return view('admin.currency.createCurrency');
    }


    // insert data
    public function storeCurreny(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
             if(empty($data['status'])){
                 $data['status'] = 0;
             }
            $createCurrency = new Currency;
            $createCurrency->currency_code = $data['cur_code'];
            $createCurrency->exchange_rate = $data['Ex_rate'];
            $createCurrency->status = $data['status'];
            $createCurrency->save();
        }
        return redirect()->back()->with('success','Your Currency has been Add Successfully!!');
    }

    //view curreny page
    public function ViewCurrencyTable(){
        $ViewCurrencyData = Currency::get();
        return view('admin.currency.viewCurrency',compact('ViewCurrencyData'));
    }

    // edit the curreny

    public function EditCurrency($id){

        $getCurrency = Currency::where('id',$id)->first();

        return view('admin.currency.EditCurrency',compact('getCurrency'));

    }

    public function updatecurrency(Request $request ,$id){
        if($request->isMethod('post')){
            $data = $request->all();
             if(empty($data['status'])){
                 $data['status'] = 0;
             }
             Currency::where('id',$id)->update([
            'currency_code' => $data['cur_code'],
            'exchange_rate'=> $data['Ex_rate'],
            'status'=> $data['status'],

             ]);
             return redirect()->action('CurrencyController@ViewCurrencyTable')->with('success','Your Currency has been Updated');
        }
    }

    public function Deletecurrency($id){
        if(!empty($id)){
            Currency::where('id',$id)->delete();
        }
         return redirect()->action('CurrencyController@ViewCurrencyTable')->with('success','Your Currency has been Deleted');

    }
}
