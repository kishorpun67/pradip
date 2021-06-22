<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Category;
use App\Admin\Section;
use App\Admin\Post;
use App\Admin\Admin;
use Session;
use Image;
use Auth;
class PostController extends Controller
{
    public function posts()
    {
        $results = Post::all();
        Session::flash('page', 'banner');
        return view('admin.banner.banner_view', compact('results'));
    }

    public function updatePostStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
        Post::where('id', $data['post_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'post_id' =>$data['post_id']]);
        }
    }

    public function addEditPost(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Post";
            $button = "Submit";
            $message = "Post has been added succussfully!";
            $posts = new Post;
            $post = array();
        }
        else {
            $title = "Edit Post";
            $button = "Update";
            $post  = Post::where('id',$id)->first();
            $posts = Post::find($id);
            $message = "Post has been updated successfully!";
         }
         if(empty($data['image']))
         {
            $data['image'] = "";
         }
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if($request->hasFile('image')){
                $image_tmp = $data['image'];
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                        // generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'frontend/assets/images/slider/'.$imageName;
                    $result = Image::make($image_tmp)->save($imagePath);
                    $posts->image = $imageName;

                }
            }
            $posts->admin_id = Auth::guard('admin')->user()->id;
            $posts->title = $data['title'];
            $posts->description = $data['description'];
            $posts->status = 1;
            $posts->save();
            return redirect('admin/posts')->with('success_message', $message);

        }
        Session::flash('page', 'banner');
        return view('admin.banner.add-edit-banner', compact('title', 'button', 'post'));


    }

    public function deletePostImage($id)
    {
        // Get psot image
        $post_image= Post::select('image')->where('id',$id)->first();

        // Get image path
        $post_image_path = 'frontend/images/home/';
        if(file_exists($post_image_path.$post_image->image)) {
            unlink($post_image_path.$post_image->image);
            return redirect()->back()->with('success_message', 'Post image has been delete successfully!');
        }
    }

    public function deletePost($id)
    {
        $id = Post::find($id);
        $id->delete();
        return redirect()->back()->with('success_message', 'Post has been delete successfully!');

    }
}
