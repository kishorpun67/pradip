<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Section;
use Session;

class SectionController extends Controller
{
    public function sections()
    {
        $results = Section::all();
        Session::flash('page', 'section');
        return view('admin.sections.sections', compact('results'));
    }

    public function updateSectionStatus(Request $request)
    { 
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'section_id' =>$data['section_id']]);
        }

    }
}
