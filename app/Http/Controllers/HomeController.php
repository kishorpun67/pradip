<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Admin\Product;
use App\Admin\Category;
use App\User;
use App\Admin\Section;
use App\Admin\Post;
use App\Admin\Contact;

use Session;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::inRandomOrder()->where(['status'=>1])->paginate(9);
        $categories = Category::with(['subcategories', 'section'])->where(['parent_id'=>0, 'status'=>1])->get();
        $banner = Post::where('status',1)->get();
        $newArrival = Product::orderBy('id', 'Desc')->where('status', 1)->get();
        $menProduct = Product::where(['section_id' =>1,'status'=>1])->get();
        $womenProduct = Product::where(['section_id' =>2,'status'=>1])->get();
        $kidProduct = Product::where(['section_id' =>3, 'status'=>1])->get();
        $featureProducts = Product::where(['is_feature' =>'Yes','status'=>1])->get();

        Session::flash('page', 'home');
        // meta tags
        $meta_title = "E-shop Laskusha Website";
        $meta_keywords="eshop website, online shopping , men clothing";
        $meta_description ="Online Shopping Stie Men, Women and Kids Clothing";
        return view('front.homes', compact('menProduct','womenProduct','kidProduct','featureProducts','newArrival','products', 'categories', 'banner', 'meta_title','meta_description','meta_keywords'))->with('page','home');
    }
}
