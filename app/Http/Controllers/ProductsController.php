<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Admin\Product;
use App\Admin\Category;
use App\User;
use App\Admin\Section;
use App\Admin\ProductsAttribute;
use App\Admin\ProductsImage;
use App\Admin\Coupon;
use App\Admin\Brand;
use App\Admin\Post;
use DB;
use Session;
use Auth;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use Carbon\Carbon;
use Notification;
use App\Notifications\OrderNotification;
use App\Admin\Admin;

class ProductsController extends Controller
{
    public function products($url=null, Request $reqeust)
    {
        if($reqeust->ajax())
        {
            $data = $reqeust->all();
            $sort = $data['sort'];
            $url = $data['url'];
            // dd($data);
            $countCategory = Category::where(['url'=>$url, 'status'=>1])->count();
            if($countCategory==0){
                return view('front.error.error');
            }
            $categoryAll = Category::where(['url'=>$url])->first();
            if($categoryAll->parent_id==0) {
                $subCategories = Category::where(['parent_id'=>$categoryAll->id, 'status'=>1])->get();
                $cat_ids=array();
                foreach($subCategories as $subcat){
                    array_push($cat_ids, $subcat->id);
                }
                $products = Product::whereIn('category_id', $cat_ids)->orderBy('product_price', 'DESC')->where(['status'=>1]);

            } else {
                $products = Product::where(['category_id'=>$categoryAll->id, 'status'=>1]);
            }


            if(isset($data['sort'])&& !empty($data['sort'])){
                if($data['sort'] =="product_lastest"){
                    $products->orderBy('id', 'Desc');
                }
                if($data['sort'] =="product_name_a_z"){
                    $products->orderBy('product_name', 'Asc');
                }
                if($data['sort'] =="product_name_z_a"){
                    $products->orderBy('product_name', 'Desc');
                }
                if($data['sort'] =="product_name_price_high_low"){
                    $products->orderBy('product_price', 'Desc');
                    // dd($products);
                }
                if($data['sort'] == "product_name_price_low_high"){
                    $products->orderBy('product_price', 'Asc');
                    // dd($products);
                }
            }
            if(!empty($data['sleeve']) && !empty($data['sleeve'])) {
                $products = $products->whereIn('products.sleeve', $data['sleeve']);
                    // dd($products);
            }
            if(!empty($data['fabric']) && !empty($data['fabric'])) {
                $products = $products->whereIn('products.fabric', $data['fabric']);
                    // dd($products);
            }
            if(!empty($data['pattern']) && !empty($data['pattern'])) {
                $products = $products->whereIn('products.pattern', $data['pattern']);
                    // dd($products);
            }
            if(!empty($data['brand']) && !empty($data['brand'])) {
                $products = $products->whereIn('products.brand_name', $data['brand']);
                    // dd($products);
            }


            $products = $products->paginate(6);

            return view('front.products.ajax_product_listing', compact('products'));
        }
        else{
            $countCategory = Category::where(['url'=>$url, 'status'=>1])->count();
            if($countCategory==0){
                return view('front.error.error');
            }
            $categoryAll = Category::where(['url'=>$url])->first();
            $section_id = $categoryAll->section_id;
            // echo $section_id, die;
            $categories = Category::with(['subcategories'])->where(['parent_id'=>0, 'section_id'=>$section_id, 'status'=>1])->get();
            // dd($categories);
            $categoryAll = Category::where(['url'=>$url])->first();
            if($categoryAll->parent_id==0) {
                $subCategories = Category::where(['parent_id'=>$categoryAll->id, 'status'=>1])->get();
                $cat_ids=array();
                foreach($subCategories as $subcat){
                    array_push($cat_ids, $subcat->id);
                }
                $products = Product::whereIn('category_id', $cat_ids)->orderBy('product_price', 'DESC')->where(['status'=>1]);

                $countCategoryDetalis = Category::where(['url'=>$url])->first();
                $breadcrumb = "<a  href='/'>Home</a> > <a  href='".$countCategoryDetalis->url."'>".$countCategoryDetalis->url."</a>";
                $meta_title = $countCategoryDetalis->meta_title;
                $meta_keywords = $countCategoryDetalis->meta_keywords;
                $meta_description = $countCategoryDetalis->meta_description;
            } else {
                $products = Product::where(['category_id'=>$categoryAll->id, 'status'=>1]);

                $countCategoryDetalis = Category::where(['url'=>$url])->first();
                $mainCategory = Category::where('id',$countCategoryDetalis->parent_id)->first();

                $breadcrumb = "<a href='/'>Home</a> > <a href='".$mainCategory->url."'>".$mainCategory->url."</a> > <a href='".$countCategoryDetalis->url."'>".$countCategoryDetalis->url."</a>";
                $meta_title = $countCategoryDetalis->meta_title;
                $meta_keywords = $countCategoryDetalis->meta_keywords;
                $meta_description = $countCategoryDetalis->meta_description;
            }
            $products = $products->paginate(6);

            $banner = Post::where('status',1)->get();
            $sleeveArray = Product::where('section_id',$section_id)->select('sleeve')->groupBy('sleeve')->get();
            $colorArray = Product::where('section_id',$section_id)->select('product_color')->groupBy('product_color')->get();
            $patternArray = Product::where('section_id',$section_id)->select('pattern')->groupBy('pattern')->get();
            $fabricArray = Product::where('section_id',$section_id)->select('fabric')->groupBy('fabric')->get();

            $brands = Brand::get();

            return view('front.products.listing', compact('products', 'categories','countCategoryDetalis', 'banner','meta_title','meta_description','meta_keywords','fabricArray','colorArray','sleeveArray','patternArray','breadcrumb','brands', 'url'));

        }


        // if(!empty($_GET['color'])) {
        //     $colorAarray = explode('-',$_GET['color']);
        //     $products = $products->whereIn('product_color', $colorAarray);
        // }



        // if(!empty($_GET['pattern'])) {
        //     $patternAarray = explode('-',$_GET['pattern']);
        //     $products = $products->whereIn('pattern', $patternAarray);
        // }

        // if(!empty($_GET['brand'])) {
        //     $brandAarray = explode('-',$_GET['brand']);
        //     $products = $products->whereIn('brand_name', $brandAarray);
        // }


    }

    public function filter(Request $reqest)
    {
        $data =$reqest->all();

        $brandUrl = "";
        if(!empty($data['brandFilter'])) {
            foreach($data['brandFilter'] as $brand) {
                if(empty($brandUrl)) {
                    $brandUrl = "&brand=".$brand;
                }else{
                    $brandUrl .="-".$brand;
                }
            }
        }
        $colorUrl = "";
        if(!empty($data['colorFilter'])) {
            foreach($data['colorFilter'] as $color) {
                if(empty($colorUrl)) {
                    $colorUrl = "&color=".$color;
                }else{
                    $colorUrl .="-".$color;
                }
            }
        }

        $sleeveUrl = "";
        if(!empty($data['sleeveFilter'])) {
            foreach($data['sleeveFilter'] as $sleeve) {
                if(empty($sleeveUrl)) {
                    $sleeveUrl = "&sleeve=".$sleeve;
                }else{
                    $sleeveUrl .="-".$sleeve;
                }
            }
        }
        $patternUrl = "";
        if(!empty($data['patternFilter'])) {
            foreach($data['patternFilter'] as $pattern) {
                if(empty($patternUrl)) {
                    $patternUrl = "&pattern=".$pattern;
                }else{
                    $patternUrl .="-".$pattern;
                }
            }
        }

    $finalUrl = "products/".$data['url']."?".$colorUrl.$sleeveUrl.$patternUrl.$brandUrl;
        return redirect($finalUrl);
    }

    public function searchProducts(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            $searchProduct = $data['product'];
            // $products = Product::where('product_name', 'like', '%'.$searchProduct.'%')->orwhere('product_code', $searchProduct)->paginate(9);

            $products = Product::where(function($query) use($searchProduct){
                $query->where('product_name', 'like', '%'.$searchProduct.'%')->orwhere('product_code', 'like', '%'.$searchProduct.'%')->orwhere('product_color', 'like', '%'.$searchProduct.'%');
            })->where('status',1)->get();
            $breadcrumb = "<a  href='/'>Home >  </a>".$searchProduct;
            return view('front.products.listing', compact('products', 'searchProduct','breadcrumb'));
        }
    }

    public function product($id=null)
    {
        $countProduct = Product::where(['id'=>$id, 'status'=>1])->count();
        if($countProduct==0){
            return view('front.error.error');
        }
        $categories = Category::with(['subcategories', 'section'])->where(['parent_id'=>0, 'status'=>1])->get();
        $productDetails = Product::with(['attributes'])->where(['id'=>$id, 'status'=>1])->first();
        $relatedProducts = Product::where('id','!=', $id)->where(['category_id'=>$productDetails->category_id, 'status'=>1])->get();
        $productImages = ProductsImage::where(['product_id'=>$id, 'status'=>1])->get();
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');

        $categoryAll = Category::where(['id'=>$productDetails->category_id])->first();
        if($categoryAll->parent_id==0) {
            $breadcrumb = "<a style='color:#333;' href='/'>Homes</a> / <a style='color:#333;' href='".$categoryAll->url."'>".$categoryAll->url."</a>".$productDetails->product_name;
        } else {
            $mainCategory = Category::where('id',$categoryAll->parent_id)->first();
            $breadcrumb = "<a  href='/'>Homes </a> > <a  href='/products/".$mainCategory->url."'>".$mainCategory->url."</a> > <a  href='/products/".$categoryAll->url."'>".$categoryAll->url."</a>"." > ".$productDetails->product_name;
        }

        $countProductDetails = Product::where(['id'=>$id])->first();
        $meta_title = $countProductDetails->meta_title;
        $meta_keywords = $countProductDetails->meta_keywords;
        $meta_description = $countProductDetails->meta_description;
        return view('front.products.details', compact('productDetails', 'categories', 'productImages', 'total_stock','relatedProducts','meta_title','meta_description','meta_keywords','breadcrumb'));

    }

    public function getProductPrice(Request $reqest)
    {
        $data = $reqest->all();
        // dd($data);
        // return response()->json($data);
        $proArr = explode("-",$data['idSize']);

        $proArr = ProductsAttribute::where(['product_id'=>$proArr[0], 'size'=>$proArr[1]])->first();
            // return response()->json($proArr->product_id);
        $discounted_price = Product::getDiscountAttrPrice($proArr->product_id, $proArr->size);
        $data =array('discount'=>$discounted_price, 'price'=>$proArr->price,'stock'=>$proArr->stock);
        return response()->json($data);

    }

    public function addtoCart(Request $request)
    {

        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        // dd($data);
        if(!empty($data['wishListButton']) && $data['wishListButton']=="wishListButton")  {

            if($data['size']== "") {
                return redirect()->back()->with('error_message', 'Please! Select the size of product!');
            }

            $sizeArr = explode("-",$data['size']);
            $product_size = $sizeArr[1];
            $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'], 'size'=>$product_size])->first();

            // get user email
            $user_email = Auth::user()->email;


            // quantiy must be one
            $quantity = 1;

            // get current date
            $created_at = Carbon::now();

            // count wish list
            $countwishlist = DB::table('wish_list')->where([
                'product_id'=>$data['product_id'],
                'product_color'=>$data['product_color'],
                'size'=>$product_size,
                'user_email'=>$user_email,
            ])->count();
            if($countwishlist>0){
                return redirect()->back()->with('error_message', 'Product already exist in wish list!');
            }else {
                //  now insert product into wish list

                DB::table('wish_list')->insert(['product_id'=>$data['product_id'], 'product_name'=>$data['product_name'],
                'product_code'=>$getProductStock->sku, 'product_color'=>$data['product_color'], 'product_price'=>$data['product_price'],
                'size'=>$product_size,'quntity'=>$data['quantity'],'user_email'=>$user_email,'created_at'=>$created_at]);

                return redirect()->back()->with('success_message','Product has been added in wish list successfully!');
            }


        }else{
            if(!empty($data['addCart']) && $data['addCart']=="Add To Cart") {
                if($data['size']== "") {
                    return redirect()->back()->with('error_message', 'Please! Select the size of product!');
                }

                $sizeArr = explode("-",$data['size']);
                $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'], 'size'=>$sizeArr[1]])->first();

                if($getProductStock->stock<$data['quantity']){
                    return redirect()->back()->with('error_message', 'Required Quantiy is not available!');
                }
                if(empty(Auth::user()->email)) {
                    $data['user_email']= "";
                }else{
                    $data['user_email']= Auth::user()->email;
                }
                $session_id = Session::get('session_id');
                if(empty($session_id)) {
                    $session_id = Str::random(40);
                    Session::put('session_id', $session_id);
                }

                if(empty(Auth::check())) {
                    $countProduct = DB::table('cart')->where([
                        'product_id'=>$data['product_id'],
                        'product_color'=>$data['product_color'],
                        'size'=>$sizeArr[1],
                        'session_id'=>$session_id,
                    ])->count();
                }else{
                    $countProduct = DB::table('cart')->where([
                        'product_id'=>$data['product_id'],
                        'product_color'=>$data['product_color'],
                        'size'=>$sizeArr[1],
                        'user_email'=>Auth::user()->email,
                    ])->count();
                }

                if($countProduct>0){
                    return redirect()->back()->with('error_message', 'Product already exist in cart!');
                }

                $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'], 'size'=>$sizeArr[1]])->first();
                DB::table('cart')->insert([
                    'product_id'=>$data['product_id'],
                    'product_name'=>$data['product_name'],
                    'product_code'=>$getSKU->sku,
                    'product_color'=>$data['product_color'],
                    'product_price'=>$data['product_price'],
                    'size'=>$sizeArr[1],
                    'quntity'=>$data['quantity'],
                    'user_email'=>$data['user_email'],
                    'session_id'=>$session_id,
                ]);
                if(!empty($data['wish_list'])){
                    $id = $data['wish_list'];
                    DB::table('wish_list')->where('id', $id)->delete();
                }
                Session::flash('success_message', 'Product has been added in Cart!');
                return redirect('cart');
            }
        }
    }

    public function addWishList()
    {
        $user_email = Auth::user()->email;
        $userwishlist = DB::table('wish_list')->where('user_email',$user_email)->get();
        foreach($userwishlist as $key => $product) {
            $productDetails = Product::where('id', $product->product_id)->first();
            $userwishlist[$key]->image = $productDetails->product_image;
        }
        $meta_title = "wish list - E-shop Website";
        $meta_keywords="View wihs list - E-shop Websiet";
        $meta_description ="wish list- E-shop Websiet";

        return view('front.products.list_wish', compact('userwishlist', 'meta_title','meta_description','meta_keywords'));
    }

    public function cart()
    {
        if(Auth::check()) {
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        }else {
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
        foreach($userCart as $key => $product) {
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->product_image;
        }
        // meta tags
        $meta_title = "Shopping Cart - E-com  Website";
        $meta_keywords="View Shopping cart of E-com Website";
        $meta_description ="shopping cart, e-com webiste";
        return view('front.products.cartS', compact('userCart', 'meta_title','meta_description','meta_keywords'));
    }


    public function deleteWishListProduct($id)
    {
        DB::table('wish_list')->where('id', $id)->delete();
        Session::flash('success_message', 'Product has been Deleted in Wish List!');
        return redirect()->back();
    }
    public function deleteCartProduct($id)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id', $id)->delete();
        Session::flash('success_message', 'Product has been Deleted in Cart!');
        return redirect()->back();
    }

    public function updateCartQuantity(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        // return response()->json($request->all(), 200);

        $data = $request->all();
        // echo "test";

        $getCartDetails = DB::table('cart')->where('id',$data['id'])->first();
        $quantity = ($data['quantity'] - $getCartDetails->quntity);
        $getAttributeStock = ProductsAttribute::where('sku', $getCartDetails->product_code)->first();
        if($getAttributeStock->stock >= $data['quantity'] ) {
            DB::table('cart')->where('id',$data['id'])->increment('quntity', $quantity);
            return redirect()->back()->with('success_message', 'Product has been update successfully!');

        }else {
            return redirect()->back()->with('error_message', 'Required Product Quantity is not available!');
        }
    }

    public function applyCoupon(Request $reqest)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $reqest->all();

        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();

        if($couponCount==0){
            return redirect()->back()->with('error_message', 'This Coupon is doesnont exists');
        }else{
            $coupondetails = Coupon::where( 'coupon_code',$data['coupon_code'])->first();

            if($coupondetails->status==0) {

                return redirect()->back()->with('error_message', 'This Coupon is inactive');
            }
            // if coupn is expired
            $expiryDate = $coupondetails->expiry_date;
            $currentDate= date('yy-m-d');
            if($expiryDate<$currentDate) {

                return redirect()->back()->with('error_message', 'This Coupon is expired!');
            }

            // coupon is valid for discount

            // get cart total amount
            $session_id = Session::get('session_id');
            if(Auth::check()) {
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
            }else {
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }
            foreach($userCart as $key => $product) {
                $productDetails = Product::where('id', $product->product_id)->first();
                $userCart[$key]->image = $productDetails->product_image;
            }
            $total_amount = 0;
            foreach($userCart as $item) {
             $total_amount = $total_amount+($item->product_price*$item->quntity);
            }

            if($coupondetails->amount_time=="fixed"){
                $couponAmount = $coupondetails->amount;

            }else {
                $couponAmount = $total_amount * ($coupondetails->amount/100);
            }
            Session::put('CouponAmount', $couponAmount);
            Session::put('CouponCode', $data['coupon_code']);
            Session::flash('success_message', 'Coupon code successfully applied. You are availing discount!');
            // echo "Coupon code successfully applied. You are availing discount"; die;
            return redirect()->back();
        }
    }

    public function checkout(Request $reqest)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $countries = Country::get();

        // check if shipping address already exists

        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount>0) {
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }
        if($reqest->isMethod('post')) {
            $data = $reqest->all();
            if(empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country']) || empty($data['shipping_mobile'])) {
                Session::flash('error_message', 'Please! fill all fields to checkout!');
                return redirect()->back();
            }else{
                // update user details
                User::where('id', $user_id)->update([
                    'name'=> $data['billing_name'],
                    'address' => $data['billing_address'],
                    'city' => $data['billing_city'],
                    'state' => $data['billing_state'],
                    'country' => $data['billing_country'],
                    'mobile' =>$data['billing_mobile']
                ]);

                if($shippingCount>0) {
                    // update shipping address
                    DeliveryAddress::where('user_id', $user_id)->update([
                        'name'=> $data['shipping_name'],
                        'address' => $data['shipping_address'],
                        'city' => $data['shipping_city'],
                        'state' => $data['shipping_state'],
                        'country' => $data['shipping_country'],
                        'mobile' =>$data['shipping_mobile'],
                    ]);
                }else {
                    // add new shipping address
                    $shipping = new DeliveryAddress;
                    $shipping->user_id = $user_id;
                    $shipping->user_email = Auth::user()->email;
                    $shipping->name = $data['shipping_name'];
                    $shipping->address = $data['shipping_address'];
                    $shipping->city = $data['shipping_city'];
                    $shipping->state = $data['shipping_state'];
                    $shipping->country = $data['shipping_country'];
                    $shipping->mobile = $data['shipping_mobile'];
                    $shipping->save();
                }
                return redirect()->action('ProductsController@orderReview');
            }
        }
        // meta tags
        $meta_title = "Checkout - E-com  Website";
        $meta_keywords="View checkout cart of E-com Website";
        $meta_description ="checkout, e-com webiste";
        return view('front.products.checkout', compact('user', 'countries', 'shippingDetails','meta_title','meta_description','meta_keywords'));
    }

    public function orderReview()
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $userDetails = User::where('id', $user_id)->first();
        $userDetails= json_decode(json_encode($userDetails));
        if(Auth::check()) {
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        }else {
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
        foreach($userCart as $key => $product) {
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->product_image;
        }
        // meta tags
        $meta_title = "Order - E-com  Website";
        $meta_keywords="View Order,  E-com Website";
        $meta_description ="view order, e-com webiste";
        return view('front.products.order_review', compact('shippingDetails', 'userDetails', 'userCart', 'meta_title','meta_description','meta_keywords'));
    }

    public function placeOrder(Request $reqest)
    {
        if($reqest->isMethod('post')) {
            $data = $reqest->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            // check payment method is null or not
            if(empty($data['payment_method'])){
                return redirect()->back()->with('error_message','Please! select payment method.');
            }

            // prevent out of stock products form ordering
            $userCart = DB::table('cart')->where('user_email', $user_email)->get();
            foreach($userCart as $cart) {

                // get attribute of product is availabel or not
                $getAttributeCount = Product::getAttributeCount($cart->product_id,$cart->size);
                if($getAttributeCount==0) {
                    Product::deleteCartCount($cart->id, $user_email);
                    return redirect('/cart')->with('error_message','One of the product is not avaliable. Please try agin.');
                }

                // get the stock of status
                $product_stock = Product::getProductStock($cart->product_id,$cart->size);
                if($product_stock->stock==0) {
                    Product::deleteCartCount($cart->id, $user_email);
                    return redirect('/cart')->with('error_message','Sold out product removed from cart. Please try placing order again.');
                }

                // check the stock quantity  an order quantity
                if($product_stock->stock<$cart->quntity) {
                    return redirect('/cart')->with('error_message','Reduce Product stock and try again.');
                }

                // get the product of status
                $product_status = Product::getProductStatus($cart->product_id);
                if($product_status==0) {
                    Product::deleteCartCount($cart->id, $user_email);
                    return redirect('/cart')->with('error_message','Disable product removed from cat. Please try placin order agin.');
                }

                // check category is disable or not
                $getCatgoryId = Product::select('category_id')->where('id',$cart->product_id)->first();
                $getCagtegoryStatus = Product::getCategoryStatus($getCatgoryId->category_id);
                if($getCagtegoryStatus == 0) {
                    Product::deleteCartCount($cart->id, $user_email);
                    return redirect('/cart')->with('error_message','Disable Product Category removed from cat. Please try placin order agin.');
                }
            }
            // get shipping address of user
            $shippingDetails = DeliveryAddress::where(['user_email' => $user_email])->first();
            // dd($shippingDetails);
            // $shippingDetails = json_decode(json_encode($shippingDetails));

            if(empty(Session::get('CouponCode'))) {
                $couponCode = "";
            }else {
                $couponCode = Session::get('CouponCode');
            }

            if(empty(Session::get('CouponAmount'))) {
                $couponAmount = "";
            }else {
                $couponAmount = Session::get('CouponAmount');
            }
            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->stat = $shippingDetails->state;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile ;
            $order->shipping_charges = $data['shipping_charges'];
            $order->coupon_code = $couponCode;
            $order->coupon_amount = $couponAmount;
            $order->status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'] ;
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProduct = DB::table('cart')->where(['user_email'=> $user_email])->get();
            foreach($cartProduct as $pro) {
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_size = $pro->size;
                $price = Product::getProductPrice($pro->product_id, $pro->size);
                $cartPro->product_price = $price;
                $cartPro->product_qty = $pro->quntity;
                $cartPro->save();

                // Reduce stock scripts stats
                $getProductStock = ProductsAttribute::where('sku', $pro->product_code)->first();
                $quantity = $getProductStock->stock-$pro->quntity;
                if($quantity<0) {
                    $quantity = 0;
                }
                ProductsAttribute::where('sku', $pro->product_code)->update(['stock'=>$quantity]);
            }
            Session::put('order_id', $order_id);
            Session::put('grand_total', $data['grand_total']);

            if($data['payment_method'] == "COD"){

                // get products details order by user
                $productDetails = Order::with('orders')->where('id', $order_id)->first();

                // get user details
                $userDetails = User::where('id', $user_id)->first();

                // code for order email
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'userDetails' => $userDetails,
                    'productDetails' => $productDetails,
                ];
                Mail::send('emails.order', $messageData, function ($message) use ($email){
                    $message->to($email)->subject('Order Place - E-com Website');
                });
                $admin = Admin::first();
                $data = collect(['productDetails'=>$productDetails, 'title'=>'order']);
                // code for order email
                $email = $admin->email;
                $messageData = [
                    'email' => $email,
                    'admin_name' => $admin->name,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'userDetails' => $userDetails,
                    'productDetails' => $productDetails,
                ];
                Mail::send('emails.admin_order', $messageData, function ($message) use ($email){
                    $message->to($email)->subject('Order Place - E-com Website');
                });
                // dd($admin);
                Notification::send($admin, new OrderNotification($data));

                // COD redirect user to thanks page after saving order
                return redirect()->action("ProductsController@thanks");
            }else {
                // COD redirect user to khalti page after saving order
                return redirect()->action("ProductsController@khalti");
            }
        }
    }
    public function thanks(Request $reqest)
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        return view('front.products.thanks');
    }

    public function khalti(){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        return view('front.payment.khalti');
    }

    public function userOrders()
    {
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('user_id', $user_id)->orderBy('id','DESC')->get();
        // dd($orderDetails);
    // $orderDetails = json_encode(json_decode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;
        return view('front.orders.user_orders', compact('orderDetails'));
    }

    public function userOrderDetails($id)
    {
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id', $id)->first();
        return view('front.orders.user_order_details', compact('orderDetails'));
    }
}
