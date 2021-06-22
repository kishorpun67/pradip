<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Session;
use Auth;
use App\Admin\Admin;
use App\Admin\Post;
use Image;
use DB;
use Notification;
use App\Notifications\SubscriberNotification;
use App\NewsletterSubscriber;


class AdminController extends Controller
{
    public function dashboard()
    {
        Session::flash('page', 'dashboard');
        return view('admin.admin_dashboard');
    }

    public function settings()
    {
        Session::flash('page', 'setting');
        return view('admin.admin_settings');
    }

    public function login(Request $request)
    {

        if($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'email' => 'required|eamil|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valild Email is required',
                'password.required' => 'Password is required',
            ];
            // $this->validate($request, $rules, $customMessages);

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            }else{
                Session::flash('error_message', 'Invalid Email or Password');
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }



    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password))
        {
            echo "true";
        }else{
            echo"false";
        }
    }

    public function updateCurrentPassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // return $data->id;
            // check current password
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {

                // check new password ana confirm password
                if($data['new_password']==$data['confirm_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    Session::flash('success_message', 'Password has been changed sucessfully');
                }else{
                    Session::flash('error_message', 'New Password and Confirm Password is not Match');
                }

            }else{
                Session::flash('error_message', 'Your Current Password is Incorrect');
            }
            return redirect()->back();
        }
    }

    public function updateAdminDetails(Request $request)
    {
        if($request->isMethod('post'))
            {
                $data = $request->all();
                // dd($data);
                $rules = [
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'number' =>'required|between:10,20',
                    'image' =>'image:jpeg, png, bmp, gif',
                ];

                $customMessages = [
                    'name.required' => 'Name is required',
                    'name.alpha' => 'alpha charcter is required',
                    'number.required' => 'number is required',
                    'number.between' => 'enter between 10 to 20 ',
                    'image.image' =>'file must be image',
                ];
                $this->validate($request, $rules, $customMessages);

                // upload images

                if(empty($data['image'])){
                    $data['image']='';
                    $imageName = Auth::guard('admin')->user()->image;
                }
                if($data['image']){
                    $image_tmp = $data['image'];
                    // dd($image_tmp);
                    if($image_tmp->isValid())
                    {
                        // get extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // generate new image name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'image/admin_image/admin_photos/'.$imageName;
                        $result = Image::make($image_tmp)->resize(1000,1000)->save($imagePath);
                        // dd($result);

                    }else if(!empty($data['current_admin_image'])) {
                        $imageName = $data['current_admin_image'];
                    }else{
                        $imageName = "";
                    }
                }


                Admin::where('email',Auth::guard('admin')->user()->email)->update([
                    'name'=>$data['name'],
                    'number' =>$data['number'],
                    'image' => $imageName,
                ]);
                Session::flash('success_message', 'Admin details update sucessfully');
                return redirect()->back();
            }

            Session::flash('page', 'updateAdminDetail');
            return view('admin.admin_update');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }
    public function adminMessage(Request $request)
    {
        $data = $request->all();
        $data = collect(['title'=>$data['title'], 'message' =>$data['message']]);
        // dd($data);
        $subscriber = NewsletterSubscriber::get();

        Notification::send($subscriber, new SubscriberNotification($data));
        return redirect()->back()->with('success_message', 'Notification has send successfully!');

    }
}
