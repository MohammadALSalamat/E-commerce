<?php

namespace App\Http\Controllers;

use App\coupon;
use DB;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function Addcoupon()
    {
        return view('admin/coupons/addcoupon');
    }

    public function storeCoupon(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();
            // insert data from the form to coupon table
            $coupon = new coupon;
            $coupon->coupon_code =$data['cop_code'];
            $coupon->amount_type =$data['cop_type'];
            $coupon->coupon_amount =$data['cop_amount'];
            $coupon->expiry_date =$data['cop_exp'];
            $coupon->status =$data['status'];
            $coupon->save();
        }
        return redirect()->action('CouponController@viewCoupon')->with('success','Your Coupon has been added ');
    }

    public function viewCoupon(){
        $viewCoupon = coupon::get();
        return view('admin/coupons/viewcoupon',compact('viewCoupon'));
    }

    public function editCoupon($id)
    {
            $getdata = coupon::where(['id'=>$id])->first();

        return view('admin/coupons/editcoupon',compact('getdata'));

    }

    public function update(Request $request ,$id)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            if (empty($data['status'])) {
               $data['status'] = 0;
            };
            coupon::where(['id'=>$id])->update([
            'coupon_code' => $data['cop_code'],
            'amount_type' =>$data['cop_type'],
            'coupon_amount' =>$data['cop_amount'],
            'expiry_date' =>$data['cop_exp'],
            'status' =>$data['status']

            ]);

        }
         return redirect()->action('CouponController@viewCoupon')->with('success', 'Your Coupon has been Updated');
    }
     public function couponDelete($id)
    {
        if (!empty($id)) {
            coupon::where(['id' => $id])->delete();
        };
        return redirect()->back()->with('success', 'Your Coupon has been Deleted');
    }
}
