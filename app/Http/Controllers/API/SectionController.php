<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Section;
class SectionController extends Controller
{
    public function section()
    {
        $getSections = Section::where('status', 1)->get();
        return response()->json($getSections, 200);
    }
}
