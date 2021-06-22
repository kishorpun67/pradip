<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Coupon;
use Session;
class CouponsController extends Controller
{
    public function Coupons()
    {
        $coupons = Coupon::all();
        Session::flash('page', 'coupon');
        return view('admin.coupons.coupon_view', compact('coupons'));
    }

    public function addCoupon(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Coupon";
            $button ="Add Coupon";
            $coupon = new Coupon;
            $message = "Coupon has been added sucessfully!";

        }else{
            $title = "Edit Coupon";
            $button ="Update Coupon";
            $coupon = Coupon::where('id',$id)->first();
            $coupons = Coupon::find($id);
            $message = "Coupon has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data= $request->all();
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_time = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = 1;
            $coupon->save();
            return redirect('admin/coupons')->with('success_message', $message);
        }
        return view('admin.coupons.add_coupons', compact('title','button','coupon'));
    }

    public function updateCouponStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Coupon::where('id', $data['coupon_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'coupon_id' =>$data['coupon_id']]);
        }

    }

 

    public function deleteCoupon($id)
    {
        $id= Coupon::find($id);
        $id->delete();
        return redirect()->back()->with('success_message','Coupons has been deleted successfully!');
    }

}
