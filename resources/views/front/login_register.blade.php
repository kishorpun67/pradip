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
                        <form action="{{url('user-login')}}" method="post">
                            @csrf
                            <div class="login-form">
                                <h4 class="login-title">Login</h4>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <label>Email Address*</label>
                                        <input type="email" name="email" placeholder="Email Address">
                                    </div>
                                    <div class="col-12 mb--20">
                                        <label>Password</label>
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="check-box">
                                            <input type="checkbox" id="remember_me">
                                            <label for="remember_me">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="forgotton-password_info">
                                            <a href="{{route('forget.password')}}"> Forgotten pasward?</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="hiraola-login_btn">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <form action="{{url('login-register')}}" method="post" id="registerForm">
                            @csrf
                            <div class="login-form">
                                <h4 class="login-title">Register</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder=" Name">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Email Address*</label>
                                        <input type="email" name="email" placeholder="Email Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Password</label>
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                    <div class="col-12">
                                        <button class="hiraola-register_btn">Register</button>
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
