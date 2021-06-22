<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Session;
use App\Admin\Category;
use App\Admin\ProductsAttribute;
use App\User;
use App\OrdersProduct;


class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Admin\Category', 'category_id')->select('id','category_name');
    }
    public function section()
    {
        return $this->belongsTo('App\Admin\Section', 'section_id')->select('id','name');
    }

    public function attributes()
    {
        return $this->hasMany('App\Admin\ProductsAttribute', 'product_id');
    }

    public function images()
    {
        return $this->hasMany('App\Admin\ProductsImage', 'product_id');
    }

    public static function cartCount()
    {
        if(Auth::check()) {
            $user_email = Auth::user()->email;
            $cartCount = DB::table('cart')->where(['user_email'=>$user_email])->sum('quntity');
        }else {
            $session_id = Session::get('session_id');
            $cartCount = DB::table('cart')->where(['session_id'=>$session_id])->sum('quntity');
        }
        return $cartCount;
    }

    public static function productCount($cat_id)
    {
        $catCount = Product::where(['category_id'=>$cat_id, 'status'=>1])->count();
        return $catCount;
    }

    public static function getProductStock($product_id, $product_size)
    {
        $getProductStock = ProductsAttribute::where(['product_id'=>$product_id, 'size'=>$product_size])->first();
        return $getProductStock;
    }

    public static function deleteCartCount($card_id,$user_email)
    {
       DB::table('cart')->where(['id'=>$card_id,'user_email'=>$user_email])->delete();
    }

    public static function getCategoryStatus($category_id)
    {
        $getCategoryStatus = Category::select('status')->where('id',$category_id)->first();
        return $getCategoryStatus->status;
    }

    public static function getProductStatus($product_id)
    {
        $getProductStatus = Product::select('status')->where('id', $product_id)->first();
        return $getProductStatus->status;
    }

    public static function getAttributeCount($product_id, $product_size)
    {
        $getAttributeCount = ProductsAttribute::where(['product_id'=>$product_id, 'size'=>$product_size])->count();
        return $getAttributeCount;
    }

    public static function getProductPrice($product_id,$product_size)
    {
        $getProductPirce = ProductsAttribute::select('price')->where(['product_id'=>$product_id, 'size'=>$product_size])->first();
        return $getProductPirce->price;
    }

    public function brand()
    {
        return $this->belongsTo('App\Admin\Brand', 'brand_id')->select('id','name');
    }

    public static function getDiscountedPrice($product_id)
    {
        $productDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first()->toArray();
        $categoryDeatils = Category::select('category_discount')->where('id',$productDetails['category_id'])->first()->toArray();

        if($productDetails['product_discount'] > 0) {
            $discounted_price = $productDetails['product_price'] - ($productDetails['product_price'] * $productDetails['product_discount']/100);
        }else if($categoryDeatils['category_discount']){
                $discounted_price = $productDetails['product_price'] - ($productDetails['product_price'] * $categoryDeatils['category_discount']/100);
            }else{
                $discounted_price = 0;
            }
        return $discounted_price;
    }

    public static function getDiscountAttrPrice($product_id, $size)
    {
        $proAttrPrice = ProductsAttribute::where(['product_id'=>$product_id, 'size' => $size])->first()->toArray();
        $productDetails = Product::select('product_discount', 'category_id')->where('id', $product_id)->first()->toArray();
        $categoryDeatils = Category::select('category_discount')->where('id',$productDetails['category_id'])->first()->toArray();

        if($productDetails['product_discount'] > 0) {
            $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $productDetails['product_discount']/100);
        }else if($categoryDeatils['category_discount']){
                $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $categoryDeatils['category_discount']/100);
            }else{
                $discounted_price = 0;
            }
        return $discounted_price;
    }

    public static function orders()
    {
        $totalOrder = OrdersProduct::count();
        return $totalOrder;
    }

    public static function users()
    {
        $users = User::count();
        return $users;
    }

}
