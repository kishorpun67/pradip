<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Brand;

class BrandController extends Controller
{
    public function brands()
    {
        $getBrands = Brand::where('status',1)->get();
        return response()->json($getBrands, 200);

    }
}
