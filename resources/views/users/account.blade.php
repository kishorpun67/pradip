@extends('layouts.front_layout.front_layout')
@section('content')
<section id="form" style="margin-top:10px;"><!--form-->
    <div class="container">
        <div class="row">
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
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Update Acccount</h2>
                    <form id="accountForm" name="accountForm" action="{{url('account')}}" method="post">
                        @csrf
                        <input type="text" name="name" value="{{$user->name}}"/>
                        <input type="text" id="address" value="{{$user->address}}" name="address" placeholder="address"/>
                        <input type="text" name="city" value="{{$user->city}}" placeholder="city"/>
                        <input type="text" name="state" value="{{$user->state}}" placeholder="state"/>
                        <select name="country" id="country">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                            <option value="{{$country->country_name}}" @if($country->country_name == $user->country) selected @endif>{{$country->country_name}}</option>
                            @endforeach
                        </select>
                        <input style="margin-top:10px;" type="text" value="{{$user->pincode}}" name="pincode" placeholder="pincode"/>
                        <input type="number" name="mobile" value="{{$user->mobile}}" placeholder="mobile"/>
         
                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div><!--/sign up form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Upadate User Password</h2>
                    <form id="updatePasswordForm" name="updatePasswordForm" action="{{url('update-current-password')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control"  placeholder="Enter Current Password" required>
                            <span id="checkCurrentPassword"></span>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" name="new_password" id="new_password" placeholder="Enter New Password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control"  placeholder="Confirm New Password" required>
                        </div>
                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div><!--/sign up form-->
            </div>
   
        </div>
    </div>
</section><!--/form-->
	
@endsection