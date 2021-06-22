<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Validation\Validator;
use App\Admin\Category;
use App\Admin\Section;
use App\Admin\Product;
use App\Admin\Brand;
use App\Order;
use Session;
use App\OrdersProduct;
use Image;
use App\User;
use App\NewsletterSubscriber;
use App\Notifications\OrderStatus;
use Notification;

class ProductsController extends Controller
{
    public function updateProductStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'product_id' =>$data['product_id']]);
        }

    }
    public function addEditProduct(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Product";
            $button ="Submit";
            $product = new Product;
            $products = array();
            $message = "Product has been added successfully!";


        }else{
            $title = "Edit Product";
            $button ="Update";
            // $products = Product::where('id', $id)->get();
            $product = Product::find($id);

            $products = Product::find($id);

            $message = "Product has been update successfully!";
        }

        if($request->isMethod('post')) {
            $data = $request->all();

            // count product_code
            if($id==0){
                $countProductCode = Product::where('product_code', $data['product_code'])->count();
                if($countProductCode==1){
                    return redirect()->back()->with('error_message', 'Product code code is already taken. Please! enter another product code.');
                }
            }else{
                $product_code = Product::where('id', $data['product_id'])->first();
                if($product_code->product_code!=$data['product_code']){
                    $countProductCode = Product::where('product_code', $data['product_code'])->count();
                    if($countProductCode==1){
                        return redirect()->back()->with('error_message', 'Product code code is already taken. Please! enter another product code.');
                    }
                }
            }

            // dd($data);
                // Product validations

            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_price' => 'required|numeric',
                'product_discount' => '',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_weight' =>'',
                'fabric' => '',
                'pattern' =>'',
                'occassion' => '',
                'description' => '',
                'meta_description' => '',
                'wash_care' => '',
                'sleeve' => '',
                'fit' => '',
                'meta_title' =>'',
                'meta_keywords' =>'',
                'is_feature' => '',
            ];
            $customMessages = [
                'category_id.required'=> 'Category is required',
                'product_name.required'=> 'Product Name is required',
                'product_name.regex'=> 'Valid Product Name is required',
                'product_price.required'=> 'Valid Product Price is required',
                'product_price.regex'=> 'Valid Product Price is required',
                'product_color.required'=> 'Valid Product Color is required',
                'product_color.regex'=> 'Valid Product Color is required',
                'product_code.required'=> 'Valid Product Code is required',
                'product_code.numeric'=> 'Valid Product Code is required',
            ];
            $this->validate($request, $rules, $customMessages);


            if(empty($data['product_image']))
            {
                $data['product_image'] = "";
            }
            if(empty($data['product_video']))
            {
                $data['product_video'] = "";
            }
            if($data['product_image']){
                $image_tmp = $data['product_image'];
                // dd($image_tmp);

                if($image_tmp->isValid())
                {
                    // get extension
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;
                    $large_image_path = 'image/product_image/large/'.$imageName;
                    $medium_image_path = 'image/product_image/medium/'.$imageName;
                    $small_image_path = 'image/product_image/small/'.$imageName;

                    Image::make($image_tmp)->resize(1040,1200)->save($large_image_path);
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);

                    $product->product_image = $imageName;

                    // dd($result);
                }
            }
            if($data['product_video']){
                $video_tmp = $data['product_video'];
                // dd($image_tmp);

                if($video_tmp->isValid())
                {
                    // get extension
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    // generate new image name
                    $videoName = $video_name.'-'.rand(111,991).'.'.$extension;
                    $video_path = 'videos/product_video/';
                    $video_tmp->move($video_path,$videoName);
                    $product->product_video = $videoName;

                    // dd($result);
                }
            }

            if(empty($data['product_color1']))
            {
                $data['product_color1'] = "";
            }
            if(empty($data['product_color2']))
            {
                $data['product_color2'] = "";
            }
            if(empty($data['product_color3']))
            {
                $data['product_color3'] = "";
            }
            if(empty($data['product_color4']))
            {
                $data['product_color4'] = "";
            }

            if(empty($data['product_discount']))
            {
                $data['product_discount'] = "";
            }

            if(empty($data['description']))
            {
                $data['description'] = "";
            }

            if(empty($data['product_weight']))
            {
                $data['product_weight'] = "";
            }

            if(empty($data['wash_care']))
            {
                $data['wash_care'] = "";
            }

            if(empty($data['meta_title']))
            {
                $data['meta_title'] = "";
            }

            if(empty($data['meta_keywords']))
            {
                $data['meta_keywords'] = "";
            }

            if(empty($data['meta_description']))
            {
                $data['meta_description'] = "";
            }

            if($data['sleeve']=="Select")
            {
                $data['sleeve'] = "";
            }

            if($data['pattern']=="Select")
            {
                $data['pattern'] = "";
            }

            if($data['fabric']=="Select")
            {
                $data['fabric'] = "";
            }

            if($data['fit']=="Select")
            {
                $data['fit'] = "";
            }

            if($data['occassion']=="Select")
            {
                $data['occassion'] = "";
            }

            if(empty($data['is_feature']))
            {
                $is_feature ="No";
            }else{
                $is_feature ="Yes";
            }

            $categoryDetalils = Category::find($data['category_id']);
            $product->section_id = $categoryDetalils->section_id;
            $product->category_id = $data['category_id'];
            $product->brand_name = $data['brand_name'];
            $product->product_name = $data['product_name'];
            $product->product_price = $data['product_price'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_color1 = $data['product_color1'];
            $product->product_color2 = $data['product_color2'];
            $product->product_color3 = $data['product_color3'];
            $product->product_color4 = $data['product_color4'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->ocassion = $data['occassion'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->meta_title = $data['meta_title'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->meta_description = $data['meta_description'];
            $product->is_feature =$is_feature ;
            $product->status = 1;
            $product->save();
            return redirect('admin/products')->with('success_message', $message);
        }
        $fabric = array('Cotton', 'Polyserter', 'Woll');
        $sleeve = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        $pattern = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $fit = array('Regular', 'Slim');
        $occassion = array('Casual', 'formal');
        $getSection = Section::with('categories')->get();
        $brands = Brand::get();
        return view('admin.products.add-edit-product', compact('title','button','getSection', 'products','brands','fabric','sleeve','pattern','fit','occassion'));
    }

    public function products()
    {
        $results = Product::with(['category','section'])->get();
        Session::flash('page', 'product');
        return view('admin.products.products_view', compact('results'));
    }

    public function deleteProduct($id)
    {
      $id = Product::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Product has been delete successfully!');

    }

    public function deleteProductImage($id)
    {
        // Get product image
        $product_image= Product::select('product_image')->where('id',$id)->first();

        // Get image path
        $product_image_small = 'image/product_image/small/';
        $product_image_medium = 'image/product_image/medium/';
        $product_image_large = 'image/product_image/large/';
        if(file_exists($product_image_small.$product_image->product_image)) {
            unlink($product_image_small.$product_image->product_image);
        }
        if(file_exists($product_image_medium.$product_image->product_image)) {
            unlink($product_image_medium.$product_image->product_image);
        }
        if(file_exists($product_image_large.$product_image->product_image)) {
            unlink($product_image_large.$product_image->product_image);
        }
        return redirect()->back()->with('success_message', 'Product Image has been delete successfully!');

    }

    public function deleteProductVideo($id)
    {
        $product_video_path= Product::select('product_video')->where('id',$id)->first();
        $product_video = 'videos/product_video/';
        if(file_exists($product_video.$product_video_path->product_video)) {
            unlink($product_video.$product_video_path->product_video);
        }
        return redirect()->back()->with('success_message', 'Product Video has been delete successfully!');
    }

    public function viewOrders()
    {
        $orders = Order::with('orders')->get();
        Session::flash('page', 'order');
        return view('admin.orders.view_orders', compact('orders'));
    }

    public function viewOrderDetails($order_id)
    {
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        // $orderDetails = json_decode(json_encode($orderDetails));
        // dd($orderDetails);
        // foreach($orderDetails as $product) {
        //  $id = $product->user_id;
        // }
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        // dd($orderDetails);
        Session::flash('page', 'order');
        return view('admin.orders.order_details', compact('orderDetails', 'userDetails'));
    }

    public function viewOrderInvoice($order_id)
    {
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        // dd($orderDetails);
        // foreach($orderDetails as $product) {
        //  $id = $product->user_id;
        // }
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        Session::flash('page', 'order');
        return view('admin.orders.order_invoice', compact('orderDetails', 'userDetails')) ;
    }

    public function updateOrderStatus(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
           Order::where('id', $id)->update(['status'=>$data['order_status']]);
           $order = Order::where('id', $id)->first();
           $user = User::where('id',$order->user_id)->first();
            $data = collect(['status'=>$order->status,  'title'=>'Your oder has been', 'user'=>$user->name]);
            Notification::send($user, new OrderStatus($data));
            return redirect()->back()->with('success_message', 'Order Satatus has been updated sucessfully!');
        }
    }

    public function viewUsers()
    {
        $usersDetails = User::get();
        Session::flash('page', 'user');
        return  view('admin.users.view_users', compact('usersDetails'));
    }

    public function deleteUsers($id)
    {
        $id = User::where('id',$id)->first();
        $id->delete();
        return redirect()->back()->with('success_message', 'User has Deleted succussfully!');
    }
    public function deleteOrder($id)
    {
        $id = Order::where('id',$id)->first();
        $id->delete();
        return redirect()->back()->with('success_message', 'Order has Deleted succussfully!');
    }

    public function updateUserStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            User::where('id', $data['user_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'user_id' =>$data['user_id']]);
        }
    }

}

