@extends('layouts.front_layout.front_layout')

@section('content')
<?php
	use App\Admin\Product;

	$cartCount= Product::cartCount();
   ?>
@include('layouts.front_layout.front1_header')

    <!-- Begin Hiraola's Cart Area -->
    <div class="hiraola-cart-area">
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
                <div class="col-sm-4">
                    <div class="">
                        <h2>Shipping Details</h2>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">Name : </label>
                            <label for="">{{$shippingDetails->name}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">Address : </label>

                            <label for="">{{$shippingDetails->address}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">City : </label>

                            <label for="">{{$shippingDetails->city}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">State : </label>

                            <label for="">{{$shippingDetails->state}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">Country : </label>

                            <label for="">{{$shippingDetails->country}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">Phone : </label>

                            <label for="">{{$shippingDetails->mobile}}</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-4">
                    <div class="">
                        <h2>Bill Details</h2>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">Name : </label>
                            <label for="">{{$userDetails->name}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">Adddress : </label>
                            <label for="">{{$userDetails->address}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">City : </label>
                            <label for="">{{$userDetails->city}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">State : </label>
                            <label for="">{{$userDetails->state}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">Country : </label>
                            <label for="">{{$userDetails->country}}</label>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: bold;">Phone : </label>
                            <label for="">{{$userDetails->mobile}}</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="hiraola-product-thumbnail">images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="cart-product-name">Size</th>
                                    <th class="hiraola-product-price">Unit Price</th>
                                    <th class="hiraola-product-quantity">Quantity</th>
                                    <th class="hiraola-product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_amount = 0;
                                ?>
                                @foreach($userCart as $cart)
                                <tr>
                                    <td class="hiraola-product-thumbnail"><a href="javascript:void(0)"><img style="width: 100px; height:100;" src="{{asset('image/product_image/small/'.$cart->image)}}" alt="product image"></a></td>

                                    <td class="hiraola-product-name"><a href="javascript:void(0)">{{$cart->product_name}}</a></td>
                                    <td class="hiraola-product-name"><a href="javascript:void(0)">{{$cart->size}}</a></td>
                                    <td class="hiraola-product-price"><span class="amount">
                                            Rs.{{$cart->product_price}}.00
                                        </span></td>
                                    <td class="quantity">
                                        <label>{{$cart->quntity}}</label>
                                    </td>
                                    <td class="product-subtotal"><span class="amount">
                                        Rs.{{$cart->product_price*$cart->quntity}}.00
                                    </span></td>
                                </tr>
                                <?php $total_amount= $total_amount + ($cart->product_price*$cart->quntity);
                                ?>
                                @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        @if(!empty(Session::get('CouponAmount')))
                                            <li>Shipping Cost(+) <span>Rs.{{ $cartCount*50 ??''}}.00</span></li>
                                            <li> Sub Total <span>Rs.{{$total_amount}}.00</span></li>
                                            <li> Coupon Discount(-)  <span>Rs.{{Session::get('CouponAmount')}}.00</span></li>
                                            <li> Grand Total <span><?php $grand_total = $total_amount-Session::get('CouponAmount')+( $cartCount*50); echo"Rs.$grand_total.00"?></span></li>
                                        @else
                                            <li> Sub Total <span>Rs.{{$total_amount }}.00</span></li>
                                            <li>Shipping Cost(+)  <span>Rs.{{ $cartCount*50 ??''}}.00</span></li>
                                            <li> Grand Total <span>Rs.{{$total_amount+($cartCount*50) }}.00 <?php $grand_total = $total_amount+($cartCount*50); ?></span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <form id="paymentForm" class="paymentForm" action="{{route('place.order')}}" method="post">
                    @csrf
                        <div class="col-12">
                            <input type="hidden" name="shipping_charges" value="{{$cartCount*50}}">
                            <input type="hidden" name="grand_total" value="{{$grand_total}}">
                              <div style="margin-left: 100px;">
                                <span>
                                    <label><strong>Select Payment Method:</strong></label>
                                </span>
                                <span>
                                    <label><input type="radio" id="COD" name="payment_method" value="COD"> COD</label>
                                </span>
                            </div>
                            <a href=""> <button class="btn btn-primary" style="float: right; m margin-left : 100px;">Proceed to checkout</button> </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Hiraola's Cart Area End Here --
@endsection
