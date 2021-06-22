@extends('layouts.front_layout.front_layout')
@section('content')
@include('layouts.front_layout.front1_header')
        <!-- Begin Hiraola's Login Register Area -->
        <div class="hiraola-login-register_area">
            <div class="container">
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>{{ Session::get('success_message') }}</strong>
                    </div>
                @endif
                @if(Session::has('error_message'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ Session::get('error_message') }}</strong>
                    </div>
                @endif
                <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6">

                        <!-- Login Form s-->
                        <form action="{{url('update-current-password')}}" method="post">
                            @csrf
                            <div class="login-form">
                                <h4 class="login-title">Change Password</h4>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <label>Email Address*</label>
                                        <input type="email" name="email" placeholder="Email Address" value="{{Auth::user()->name}}" readonly>
                                    </div>
                                    <div class="col-12 mb--20">
                                        <label>Current Password</label>
                                        <input type="current_password" id="current_password" name="current_password" placeholder="Password">
                                        <span id="checkCurrentPassword"></span>
                                    </div>
                                    <div class="col-12 mb--20">
                                        <label>New Password</label>
                                        <input type="new_password" id="new_password" name="new_password" placeholder="Password">
                                    </div>
                                    <div class="col-12 mb--20">
                                        <label>Confirm Password</label>
                                        <input type="confirm_password" id="confirm_password" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="hiraola-login_btn">Change</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <form action="{{url('account')}}" method="post">
                            @csrf
                            <div class="login-form">
                                <h4 class="login-title">Update Acccount</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{$user->name}}" placeholder=" Name">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Email Address*</label>
                                        <input type="email" name="email"value="{{$user->email}}" placeholder="Email Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{$user->address}}"  placeholder="Password">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Contact</label>
                                        <input type="number" name="mobile"value="{{$user->mobile}}" placeholder="Confirm Password">
                                    </div>
                                    <div class="col-md-6">
                                        <label>City</label>
                                        <input type="text" name="city" value="{{$user->city}}" placeholder="Confirm Password">
                                    </div>
                                    <div class="col-md-6">
                                        <label>State</label>
                                        <input type="state" name="state" value="{{$user->state}}" placeholder="Confirm Password">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Country</label>
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->country_name}}" @if($country->country_name == $user->country) selected @endif>{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button class="hiraola-register_btn">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Login Register Area  End Here -->
@endsection
