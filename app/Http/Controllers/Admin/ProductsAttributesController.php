<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Product;
use App\Admin\ProductsAttribute;
use App\Admin\ProductsImage;
use Session;
use Image;

class ProductsAttributesController extends Controller
{
    public function addAttributes(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            foreach($data['sku'] as $key => $val) {
                if(!empty($val)) {
                    // Prevent duplicate sku check
                    $attrCount = ProductsAttribute::where('sku',$val)->count();
                    if($attrCount>0){
                        return redirect()->back()->with('error_message', 'SKU already exits! Please another SKU.');
                    }
                      // Prevent duplicate sku check
                      $attrCount = ProductsAttribute::where(['product_id'=>$id,  'size'=>$data['size'][$key]])->count();
                      if($attrCount>0){
                          return redirect()->back()->with('error_message', $data['size'][$key]."\n".'fSize already exits! Please another SKU.');
                      }
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status=1;
                    $attribute->save();
                    return redirect()->back()->with('success_message', 'Attributes has been added successfully!');
                }
            }
        }
        $productDetails = Product::with('attributes')->find($id);
        // $productDetails = json_decode(json_encode($productDetails));
        // dd($productDetails);
        Session::flash('page', 'product');
        return view('admin.products.add_product_attributes', compact('productDetails'));
    }

    public function addImages(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            if($request->hasFile('image')) {
                $file =  $request->file('image');
                    // get extension
                    $extension = $file->getClientOriginalExtension();
                    // generate new image name

                    $image = New ProductsImage;
                    $imageName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'image/product_image/large/'.$imageName; 
                    $medium_image_path = 'image/product_image/medium/'.$imageName; 
                    $small_image_path = 'image/product_image/small/'.$imageName; 

                    Image::make($file)->resize(1040,1200)->save($large_image_path);
                    Image::make($file)->resize(520,600)->save($medium_image_path);
                    Image::make($file)->resize(260,300)->save($small_image_path);

                    $image->product_id = $data['product_id'];
                    $image->image = $imageName;
                    $image->status=1;
                    $image->save();
            }
            return redirect()->back()->with('success_message', 'Image has been added successfully!');
        }
        $productDetails = Product::with('images')->find($id);
        Session::flash('page', 'product');
        return view('admin.products.add_product_images', compact('productDetails'));
    }

    public function editAttributes(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            foreach($data['idAttr'] as $key => $attr) {
                if(!empty($attr)) {
                    ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key], 'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_message', 'Attributes has been updated successfully!');
        }
    }

    public function deleteAttribute($id)
    {
        $id = ProductsAttribute::find($id);
        $id->delete();
        return redirect()->back()->with('success_message', 'Attribute has been delete successfully!');

    }

    public function deleteImages($id) 
    {
        // Get product image 
        $product_image= ProductsImage::select('image')->where('id',$id)->first();

        // Get image path
        $product_image_small = 'image/product_image/small/';
        $product_image_medium = 'image/product_image/medium/';
        $product_image_large = 'image/product_image/large/';

        $image_path = 'image/product_image/small/'.$product_image->image;
     
        if(!empty($product_image->image) && file_exists($image_path)){

            if(file_exists($product_image_small.$product_image->image)) {
                unlink($product_image_small.$product_image->image);
            }     
            if(file_exists($product_image_medium.$product_image->product_image)) {
                unlink($product_image_medium.$product_image->image);
            }     
            if(file_exists($product_image_large.$product_image->image)) {
                unlink($product_image_large.$product_image->image);
            }
        }
        $id = ProductsImage::find($id);
        $id->delete();
        return redirect()->back()->with('success_message', 'Product Image has been delete successfully!');
    }

    public function updateProductAttributeStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            ProductsAttribute::where('id', $data['productAttr_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'productAttr_id' =>$data['productAttr_id']]);
        }
    }

    public function updateProductImageStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            ProductsImage::where('id', $data['productImg_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'productImg_id' =>$data['productImg_id']]);
        }
    }
    
    
}
