<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use Session;
use App\Admin\CmsPage;
use App\Admin\Category;
use App\Admin\Post;

class CmsController extends Controller
{
    public function viewCmsPages()
    {
        $cmsPageDetalils = CmsPage::all();
        Session::flash('page', 'cmspages');
        return view('admin.cmspages.view_cms_page', compact('cmsPageDetalils'));
    }
    public function updateCmsStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            CmsPage::where('id', $data['cms_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'cms_id' =>$data['cms_id']]);
        }
    }

    public function addEditCmsPage(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Cms Page";
            $button = "Submit";
            $message = "Cms Page has been added succussfully!";
            $cmspages = new CmsPage;
            $cmspage = array();
        }
        else {
            $title = "Edit Cms Page";
            $button = "Update";
            $cmspage  = CmsPage::where('id',$id)->first();
            $cmspages = CmsPage::find($id);
            $message = "Cms Page has been updated successfully!";
         }
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
            if(empty($data['meta_description']))
            {
                $data['meta_description'] = "";
            }
            if(empty($data['meta_title']))
            {
                $data['meta_title'] = "";
            }
            if(empty($data['meta_keywords']))
            {
                $data['meta_keywords'] = "";
            }

            $cmspages->title = $data['title'];
            $cmspages->url = $data['url'];
            $cmspages->description = $data['description'];
            $cmspages->meta_description = $data['meta_description'];
            $cmspages->meta_title = $data['meta_title'];
            $cmspages->meta_keywords = $data['meta_keywords'];
            $cmspages->status = 1;
            $cmspages->save();
            return redirect('admin/view-cms-page')->with('success_message',$message);
        }
        Session::flash('page', 'cmspages');
        return view('admin.cmspages.add_edit_cms_page', compact('title','button','cmspage'));
    }

    public function delteCmsPage($id)
    {
        $id = CmsPage::where('id',$id)->first();
        $id->delete();
        return redirect()->back()->with('success_message', 'Cms Page has Deleted succussfully!');
    }

    public function cmsPage($url)
    {
        // check if cms page is disable or does not exists
        $cmsPageCount = CmsPage::where(['url'=>$url, 'status'=>1])->count();
        if($cmsPageCount>0){
            $cmsPageDetalils = CmsPage::where('url', $url)->first();
        }else{
            return view('front.error.error');
        }
        $cmsPageDetalils = CmsPage::where('url',$url)->first();
        $meta_title = $cmsPageDetalils->meta_title;
        $meta_keywords = $cmsPageDetalils->meta_keywords;
        $meta_description = $cmsPageDetalils->meta_description;

        $banner = Post::where('status',1)->get();
        $categories = Category::with(['subcategories', 'section'])->where(['parent_id'=>0, 'status'=>1])->get();
        return view('pages.cms_page', compact('cmsPageDetalils', 'categories', 'banner', 'meta_title','meta_description','meta_keywords'));
    }


    public function about()
    {
        $path = "About Us" ;
        $breadcrumb = "<a  href='/'>Home >  </a>"."About";
        return view('front.about.about', compact('path','breadcrumb'));
    }

}
