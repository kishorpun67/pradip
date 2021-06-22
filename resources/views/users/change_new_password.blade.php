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
                        <form action="{{route('change.password')}}" method="post">
                            @csrf
                            <div class="login-form">
                                <h4 class="login-title">Forget Password ? </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Current Password</label>
                                        <input type="passwrod" name="current_password" placeholder="Current Password">
                                    </div>
                                    <div class="col-md-6">
                                        <label> New Password</label>
                                        <input type="password" name="new_password" id="new_password" placeholder="New Password">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                                    </div>

                                    <div class="col-md-12">
                                        <button class="hiraola-login_btn">Send</button>
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
