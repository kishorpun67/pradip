@extends('layouts.front_layout.front_layout')

@section('content')
@include('layouts.front_layout.front1_header')

<!-- Begin Hiraola's Checkout Area -->
<div class="checkout-area">
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
        <form id="checkoutForm" name="checkoutForm" action="{{route('checkout')}}" method="post" style="display: :inline;">
            @csrf
            <div class="row">
                <div class="col-lg-5 col-12">
                    <div class="checkbox-form">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label> Name <span class="required">*</span></label>
                                    <input placeholder="" id="billing_name" name="billing_name" value="{{$user->name}}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label> <span class="required">* Address</span></label>
                                    <input placeholder="Address" id="billing_address" name="billing_address" value="{{$user->address}}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>City / Town <span class="required">*</span></label>
                                    <input type="text" placeholder="Town or City" id="billing_city" name="billing_city" value="{{$user->city}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>State <span class="required">*</span></label>
                                    <input placeholder="State" type="text" id="billing_state" name="billing_state" name="billing_state" value="{{$user->state}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Country <span class="required">*</span></label>
                                    <input placeholder="Country" type="text" id="billing_country" name="billing_country" name="billing_country" value="{{$user->country}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" id="billing_mobile" name="billing_mobile" value="{{$user->mobile}}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <label>Shipping Address same as Billing Address</label>
                                <input id="ship-to-bill" type="checkbox">
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-5 col-12">
                    <div class="checkbox-form">
                        <h3>Shipping Details</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label> Name <span class="required">*</span></label>
                                    <input placeholder="Name" name="shipping_name" id="shipping_name" type="text"
                                    @if(!empty($shippingDetails->name)) value ="{{$shippingDetails->name}}" @else value="{{old('title')}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label> <span class="required">* Address</span></label>
                                    <input placeholder="Address" name="shipping_address" id="shipping_address" type="text"
                                    @if(!empty($shippingDetails->address)) value ="{{$shippingDetails->address}}" @else value="{{old('title')}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>City / Town <span class="required">*</span></label>
                                    <input type="text" placeholder="Town or City" name="shipping_city" id="shipping_city"
                                    @if(!empty($shippingDetails->city)) value ="{{$shippingDetails->city}}" @else value="{{old('title')}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>State <span class="required">*</span></label>
                                    <input placeholder="State" type="text" name="shipping_state" id="shipping_state"
                                    @if(!empty($shippingDetails->state)) value ="{{$shippingDetails->state}}" @else value="{{old('title')}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Country <span class="required">*</span></label>
                                    <input placeholder="Country" type="text" name="shipping_country" id="shipping_country"
                                    @if(!empty($shippingDetails->country)) value ="{{$shippingDetails->country}}" @else value="{{old('Country')}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Phone <span class="required" >*</span></label>
                                    <input type="text" placeholder="Phone" name="shipping_mobile" id="shipping_mobile"
                                    @if(!empty($shippingDetails->mobile)) value ="{{$shippingDetails->mobile}}" @else value="{{old('title')}}" @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <input type="submit" value="Checkout" class="btn btn-primary">
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- Hiraola's Checkout Area End Here -->
@endsection
