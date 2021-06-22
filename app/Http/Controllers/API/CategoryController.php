<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Category;
use App\Admin\Product;

class CategoryController extends Controller
{
    public function categories()
    {
        $getCategory = Category::with(['subcategories', 'section'])->where(['parent_id'=>0, 'status'=>1])->get();
        return response()->json($getCategory, 200);
    }

    public function mainCategory()
    {
	    $mainCategories = Controller::mainCategories();
        return response()->json($mainCategories,200);
    }
}
