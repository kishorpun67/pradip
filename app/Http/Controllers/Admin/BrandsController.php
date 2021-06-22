<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Admin\Brand;
class BrandsController extends Controller
{
    public function viewBrands()
    {
        $brands = Brand::get();
        Session::flash('page', 'brand');
        return view('admin.brands.view_brand', compact('brands'));
    }

    public function addEditBrand(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Brand";
            $button = "Submit";
            $message = "Brand has been added successfully!";
            $brands = new Brand;
            $brand = array();
        }
        else {
            $title = "Edit Brand";
            $button = "Update";
            $brand  = Brand::where('id',$id)->first();
            $brands = Brand::find($id);
            $message = "Brand has been updated successfully!";
         }

         if($request->isMethod('post'))
         {
            $data = $request->all();
            $brands->name = $data['brand'];
            $brands->status = 1;
            $brands->save();
            return redirect('admin/brand')->with('success_message', $message);
         }
         return view('admin.brands.add_edit_brand', compact('title','button','brand'));
    }

    public function updateBrandStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'brand_id' =>$data['brand_id']]);
        }
    }
    public function deleteBrand($id)
    {
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Brand has been deleted successfully!');
    }
}
