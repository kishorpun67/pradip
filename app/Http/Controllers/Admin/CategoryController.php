<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Category;
use App\Admin\Section;
use App\Admin\Post;
use App\Admin\Admin;
use URL;
use Session;
use Image;


class CategoryController extends Controller
{
    public function categories()
    {
        $results = Category::with(['section', 'parentcategory'])->get();

        // $results = json_decode(json_encode($results));
        // echo "<pre>"; dd($results);
        Session::flash('page', 'category');
        return view('admin.categories.categories', compact('results'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'category_id' =>$data['category_id']]);
        }

    }

    public function addEditCategory(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Category";
            $button ="Submit";
            $category = new Category;
            $categorydata = array();
            $categories = array();
            $message = "Category has been added sucessfully";
        }else{
            $title = "Edit Category";
            $button ="Update";
            $categorydata = Category::where('id',$id)->first();
            $categorydata= json_decode(json_encode($categorydata),true);
            // dd($categorydata);
            $categories = Category::with('subcategories')->where(['parent_id' =>0, 'section_id' =>$categorydata['section_id']])->get();
            $categories= json_decode(json_encode($categories),true);
            // dd($categories);
            $category = Category::find($id);
            $message = "Category has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            if(empty($data['category_image']))
            {
                $data['category_image'] = "";
            }
            if($data['category_image']){
                $image_tmp = $data['category_image'];

                if($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'image/category_image/'.$imageName;
                    $result = Image::make($image_tmp)->save($imagePath);
                    $category->category_image = $imageName;

                }
            }

            if(empty($data['category_discount']))
            {
                $data['category_discount'] = "";
            }
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
            if(empty($data['meta_title']))
            {
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description']))
            {
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords']))
            {
                $data['meta_keywords'] = "";
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            Session::flash('success_message', $message);
            return redirect('admin/categories');

        }

        // Get All Section

        $getSection = Section::all();
        return view('admin.categories.add_edit_category', compact('title','button', 'getSection','categorydata','categories'));
    }

    public function appendCategoryLevel(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            $categories = Category::with('subcategories')->where(['section_id'=>$data['section_id'], 'parent_id' =>0, 'status' =>1])->get();
           $categories=json_decode(json_encode($categories),true);
        //    echo "<pre>"; print_r($getCategories); die;
           return view('admin.categories.append_categoreis_level', compact('categories'));

        }
    }


    public function deleteCategory($id)
    {
        // if(!request()->hasValidSignature()){
        //     abort(401);
        // }
        // $admin = Admin::find(0);
        // dd(URL::signedRoute('delete-category', ['admin'=>$admin]));
      $id =Category::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Category has been delete successfully!');

    }

    public function deleteCategoryImage($id)
    {
        // Get category image
        $category_image= Category::select('category_image')->where('id',$id)->first();

        // Get image path
        $category_image_path = 'image/category_image/';
        if(file_exists($category_image_path.$category_image->category_image)) {
            unlink($category_image_path.$category_image->category_image);
        }
        return redirect()->back()->with('success_message', 'Category Image has been delete successfully!');
    }
}
