<?php

namespace App\Http\Controllers\API;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'address' =>'required',
            'email' =>'required',
            'phone' =>'required|between:10,20',
            'vehicle_no' =>'required|',
            'password' =>'required|between:8,20',

        ];

        $customMessages = [
            'name.required' => 'Name is required',
            'name.alpha' => 'alpha charcter is required',
            'address.required' => 'address is required',
            'phone.required' => 'phone is required',
            'phone.between' => 'enter between 10 to 20 ',
            'password.between' => 'your password at lest 8 charater is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data = $request->all();

        $phoneCount = User::where('email', $data['email'])->count();
        if($phoneCount==1) {
            return response()->json('This phone has been already has taken. Please! try another phone.',200);
        }
        $emailCount = User::where('email', $data['email'])->count();
        if($emailCount==1) {
            return response()->json('This email has been already has taken. Please! try another email.',200);
        }
        // dd($data);
        $client = User::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'vehicle_no' => $data['vehicle_no'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login(Request $request)
    {
        $user=  User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

                $token = $user->createToken('my-app-token')->plainTextToken;
                // $response = \Session::put('token', $token);
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response()->json($response, 200);
    }


}
