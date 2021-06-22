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
            <div class="row">
                <div class="col-12">
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
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="hiraola-product-remove">remove</th>
                                        <th class="hiraola-product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="cart-product-name">Color</th>
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
                                        <td class="hiraola-product-remove"><a href="{{route('cart/delet.product', $cart->id)}}" id="delete"><i class="fa fa-trash"
                                            title="Remove"></i></a></td>
                                        <td class="hiraola-product-thumbnail"><a href="javascript:void(0)"><img style="height: 100px; width:100px;" src="{{asset('image/product_image/small/'.$cart->image)}}" alt="product image"></a></td>

                                        <td class="hiraola-product-name"><a href="javascript:void(0)">{{$cart->product_name}}</a></td>
                                        <td class="hiraola-product-name"><a href="javascript:void(0)">{{$cart->product_color}}</a></td>
                                        <span ></span>
                                        <td class="hiraola-product-name"><a href="javascript:void(0)">{{$cart->size}}</a></td>
                                        <td class="hiraola-product-price"><span class="amount">
                                                Rs.{{$cart->product_price}}.00
                                            </span></td>
                                        <td class="quantity" >
                                        <form action="{{route('cart/update.quantity')}}" class="change" method="post">
                                            <input type="hidden" name="code" class="code" value="{{$cart->product_code}}">
                                            <input type="hidden" name="size" class="size" value="{{$cart->size}}">
                                            <input type="hidden" name="id" class="id" value="{{$cart->id}}">
                                            <label>Quantity</label>
                                                <div class="cart-plus-minus ">
                                                    <input class="cart-plus-minus-box quntity"  id="quantity"  name="quantity" value="{{$cart->quntity}}" type="text">

                                                    <div class="dec qtybutton"> <a href=""><i class="fa fa-angle-down"></i></a> </div>
                                                    <div class="inc qtybutton"> <a href=""><i class="fa fa-angle-up"></i></a></div>
                                                </div>
                                                <button class="btn btn-primary" style="margin-top:3px;">Update</button>

                                        </form>
                                        </td>
                                        <td class="product-subtotal"><span class="amount">
                                            @if($cart->product_price )
                                            Rs.{{($cart->product_price * $cart->quntity)}}.00
                                            @endif
                                        </span></td>
                                    </tr>
                                    <?php $total_amount= $total_amount + ($cart->product_price*$cart->quntity);
                                    ?>
                                    @endforeach
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form method="post" action="{{route('apply.coupon')}}" >
                                    @csrf
                                    <div class="coupon-all">
                                        <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                            <input type="submit" value="Apply" class="button" autocomplete="off">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
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
                                            <li> Grand Total <span>Rs.{{$total_amount+($cartCount*50) }}.00</span></li>
                                        @endif
                                    </ul>
                                    <a href="{{route('checkout')}}">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hiraola's Cart Area End Here --
@endsection
