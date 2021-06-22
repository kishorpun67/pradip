<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Product;
use App\Admin\Category;
use App\Admin\ProductsImage;
use App\Admin\ProductsAttribute;


class ProtuctsController extends Controller
{
    public function products($url=null)
    {
        if(!empty($url)) {
            $countCategory = Category::where(['url'=>$url, 'status'=>1])->count();
            if($countCategory==0){
                return response()->json('Page not found', 404);
                // return view('front.error.error');
            }

            $categories = Category::with(['subcategories', 'section'])->where(['parent_id'=>0, 'status'=>1])->get();

            $categoryAll = Category::where(['url'=>$url])->first();
            if($categoryAll->parent_id==0) {
                $subCategories = Category::where(['parent_id'=>$categoryAll->id, 'status'=>1])->get();
                foreach($subCategories as $subcat){
                    $cat_ids[] = $subcat->id;
                }

                $products = Product::whereIn('category_id', $cat_ids)->orderBy('product_price', 'DESC')->where(['status'=>1])->get();
                $countCategoryDetalis = Category::where(['url'=>$url])->first();
                $meta_title = $countCategoryDetalis->meta_title;
                $meta_keywords = $countCategoryDetalis->meta_keywords;
                $meta_description = $countCategoryDetalis->meta_description;
            } else {

                $products = Product::where(['category_id'=>$categoryAll->id, 'status'=>1])->get();

                $countCategoryDetalis = Category::where(['url'=>$url])->first();
                $mainCategory = Category::where('id',$countCategoryDetalis->parent_id)->first();

                $meta_title = $countCategoryDetalis->meta_title;
                $meta_keywords = $countCategoryDetalis->meta_keywords;
                $meta_description = $countCategoryDetalis->meta_description;
            }

            return response()->json($products, 200);

        }else{
            $getAllPorducts = Product::where('status', 1)->get();
            return response()->json($getAllPorducts, 200);
        }
    }

    public function product($id=null)
    {
        $countProduct = Product::where(['id'=>$id, 'status'=>1])->count();
        if($countProduct==0){
            return response()->json('page not found', 404);
        }
        $productDetails = Product::with(['attributes'])->where(['id'=>$id, 'status'=>1])->first();
        $relatedProducts = Product::where('id','!=', $id)->where(['category_id'=>$productDetails->category_id, 'status'=>1])->get();
        $productImages = ProductsImage::where(['product_id'=>$id, 'status'=>1])->get();
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');


        $countProductDetails = Product::where(['id'=>$id])->first();
        $meta_title = $countProductDetails->meta_title;
        $meta_keywords = $countProductDetails->meta_keywords;
        $meta_description = $countProductDetails->meta_description;
        return response()->json($productDetails,200);

    }
}
