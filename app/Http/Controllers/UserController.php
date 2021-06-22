<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Str;
use App\User;
use App\Country;
use App\ProductsController;
use Auth;
use Session;
use Hash;
use DB;
use Mail;
use Notification;
use App\Notifications\UserRegisterNotification;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if($request->isMethod('post')) {
            $data= $request->all();
            $userCount = User::where('email',$data['email'])->count();
            if($userCount>0){
                return redirect()->back()->with('error_message', 'This Email has been already taken!');
            }else{
                // create new user
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->status = 0;
                $user->save();

                  $use_di = DB::getPdo()->lastInsertId();
                 $user = User::where('id', $use_di)->first();

                // send register email
                // $email = $data['email'];
                // $messageData = ['email'=>$data['email'], 'name'=>$data['name']];
                // Mail::send('emails.register', $messageData,function($message) use($email){
                //     $message->to($email)->subject('Registration with E-com Website');
                // });

                //send confirmation email
                // $email = $data['email'];
                // $messageData = ['email'=>$data['email'], 'name'=>$data['name'], 'code'=>base64_encode($data['email'])];
                // Mail::send('emails.confirmation', $messageData,function($message) use($email){
                //     $message->to($email)->subject('Confirm E-com Account');

                // });
                Notification::send($user, new UserRegisterNotification);

                return redirect()->back()->with('success_message', 'Please confirm your email to active your account!');

            }
        }
        return view('front.login_register');
    }
    public function Confirm($code)
    {
        $email = base64_decode($code);
        $data = User::where('email',$email)->update(['status'=>1]);

        return redirect('login-register')->with('success_message', 'Your email account is acitvated. You can login now.');
    }

    public function checkEmail(Request $request)
    {
        $data= $request->all();
        $userCount = User::where('email',$data['email'])->count();

        if($userCount>0){
            echo "false";
        }else{
            echo "true", die;
        }
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])) {
                Session::put('frontSession', $data['email']);

                // check user status
                $userStatus = User::where('email', $data['email'])->first();
                if($userStatus->status==0){
                    return redirect()->back()->with('error_message', 'Your account is  not acitve! Please contact Admin!');
                }

                if(!empty(Session::get('session_id'))){
                    $session_id = Session::get('session_id');
                    Cart::where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                    echo "kISHOR PUN"; die;
                }
                return redirect('/cart');
            }else {
                return redirect()->back()->with('error_message', 'Invalid Eamil or Password');
            }
        }
        return view('front.login_register');
    }
    public function account(Request $request)
    {
        $countries = Country::get();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if($request->isMethod('post')) {
            $data = $request->all();

            if(empty($data['name'])) {
                return redirect()->back()->with('error_message', 'Please enter your Name to upadate your account details!');
            }

            if(empty($data['address'])) {
                return redirect()->back()->with('error_message', 'Please enter your Address to upadate your account details!');
            }
            if(empty($data['city'])) {
                return redirect()->back()->with('error_message', 'Please enter your City to upadate your account details!');
            }
            if(empty($data['state'])) {
                return redirect()->back()->with('error_message', 'Please enter your State to upadate your account details!');
            }
            if(empty($data['country'])) {
                return redirect()->back()->with('error_message', 'Please enter your Country to upadate your account details!');
            }
            if(empty($data['mobile'])) {
                return redirect()->back()->with('error_message', 'Please enter your Mobile to upadate your account details!');
            }
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('success_message', 'Your account details has been updated successfully!');

        }
        return view('front.user_setting.account', compact('countries', 'user'));
    }


    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if(Hash::check($data['current_password'],Auth::user()->password))
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
            if(Hash::check($data['current_password'],Auth::user()->password)) {

                // check new password ana confirm password
                if($data['new_password']==$data['confirm_password']){
                    User::where('id',Auth::user()->id)->update(['password' => bcrypt($data['new_password'])]);
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

    public function userLogout()
    {
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }

    public function forgetPassword(Request $request)
    {
        $data = $request->all();
        if($request->isMethod('post')) {
            $userCount = User::where('email',$data['email'])->count();

            if($userCount==0) {
                return redirect()->back()->with('error_message', 'Email does not exists!');
            }

            $email = $data['email'];
            // return view('users.change_new_password', compact('email'));
            $userDetails = User::where('email',$data['email'])->first();

            // // generate random password
            // $radom_password = Str::random(8);

            // // bycrypt password
            // $new_password = bcrypt($radom_password);

            // // update password
            // User::where('email', $data['email'])->update(['password'=>$new_password]);

            // // send forget password eamil code

            $email = $data['email'];
            $name = $userDetails->name;
            $messageData = [
                'email'=>$email,
                'name'=>$name,
            ];
            Mail::send('emails.forgotPassword', $messageData, function($message)use($email){
                $message->to($email)->subject('New Password - E-com Website');
            });
            return redirect('login-register')->with('success_message', 'Please! check your email for new password');
        }

        return view('users.forget_password');
    }

    public function changePassword(Request $request, $email)
    {
        return view('users.change_new_password', compact('email'));
    }
}
