@extends('layouts.front_layout.front_layout')
@section('content')
<?php
	use App\Admin\Product;

	$cartCount= Product::cartCount();
   ?>
   @include('layouts.front_layout.front1_header')

    <!--Begin Hiraola's Wishlist Area -->
        <div class="hiraola-wishlist_area">
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
                    <div class="col-12">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="hiraola-product_remove">remove</th>
                                            <th class="hiraola-product-thumbnail">images</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="cart-product-name">color</th>
                                            <th class="cart-product-name">Size</th>
                                            <th class="hiraola-product-price">Unit Price</th>
                                            <th class="hiraola-product-stock-status">Quantity</th>
                                            <th class="hiraola-cart_btn">add to cart</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($userwishlist as $wishlist)
                                        <tr>
                                            <td class="hiraola-product_remove"><a href="{{route('wish.delete.product', $wishlist->id)}}"><i class="fa fa-trash"
                                                title="Remove"></i></a></td>
                                            <td class="hiraola-product-thumbnail"><a href="javascript:void(0)"><img style="width: 100px; height:100px;" src="{{asset('image/product_image/small/'.$wishlist->image)}}" alt="Hiraola's Wishlist Thumbnail"></a>
                                            </td>
                                            <td class="hiraola-product-name"><a href="javascript:void(0)">{{$wishlist->product_name}}</a></td>
                                            <td class="hiraola-product-name"><a href="javascript:void(0)">{{$wishlist->product_color}}</a></td>
                                            <td class="hiraola-product-name"><a href="javascript:void(0)">{{$wishlist->size}}</a></td>
                                            <td class="hiraola-product-price"><span class="amount">
                                                Rs.{{$wishlist->product_price}}.00
                                                </span></td>
                                            <td class="hiraola-product-stock-status"><span class="in-stock">{{$wishlist->quntity}}</span></td>
                                            <form  name="addtoCartForm" id="addtoCartForm" action="{{route('add.cart')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                    <input type="hidden" name="wish_list" value="{{$wishlist->id}}">
                                                    <input type="hidden" name="product_id" value="{{$wishlist->product_id}}">
                                                    <input type="hidden" name="product_name" value="{{$wishlist->product_name}}">
                                                    <input type="hidden" name="product_code" value="{{$wishlist->product_code}}">
                                                    <input type="hidden" name="product_color" value="{{$wishlist->product_color}}">
                                                    <input type="hidden" name="size" value="{{$wishlist->id}}-{{$wishlist->size}}">
                                                    <input type="hidden" name="quantity" value="{{$wishlist->quntity}}">
                                                    <input type="hidden" id="product_price" name="product_price" value="{{$wishlist->product_price}}">
                                                <td class="hiraola-cart_btn"><a href="{{url('add-cart')}}" > <button name="addCart" name="addcart" value="Add To Cart"> Add To Cart</button></a></td>
                                            </form>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Hiraola's Wishlist Area End Here -->
@endsection
