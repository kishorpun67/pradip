@extends('layouts.front_layout.front_layout')


@section('content')
@include('layouts.front_layout.front1_header')
<?php
	use App\Admin\Product;

   ?>
<!-- Begin Hiraola's Single Product Area -->
<div class="sp-area">
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
        <div class="sp-nav">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="sp-img_area">
                        <div class="zoompro-border">
                            <img class="zoompro"  src="{{asset('image/product_image/large/'.$productDetails->product_image)}}" data-zoom-image="{{asset('image/product_image/large/'.$productDetails->product_image)}}" alt="Hiraola's Product Image" />
                        </div>
                        <div id="gallery" class="sp-img_slider">
                            <a class="active" data-image="{{asset('image/product_image/large/'.$productDetails->product_image)}}" data-zoom-image="{{asset('image/product_image/large/'.$productDetails->product_image)}}">
                                <img src="{{asset('image/product_image/large/'.$productDetails->product_image)}}" alt="Hiraola's Product Image">
                            </a>
                            @foreach($productImages as $image)
                            <a data-image="{{asset('image/product_image/large/'.$image->image)}}" data-zoom-image="{{asset('image/product_image/large/'.$image->image)}}">
                                <img src="{{asset('image/product_image/large/'.$image->image)}}" alt="Hiraola's Product Image">
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <form name="addtoCartForm" id="addtoCartForm" action="{{route('add.cart')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                        <input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
                        <input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
                        <input type="hidden" id="product_price" name="product_price" value="{{$productDetails->product_price}}">
                        <div class="sp-content">
                            <div class="sp-heading">
                                <h5><a href="#">{{$productDetails->product_name}}</a></h5>
                            </div>
                            <?php
                            $getPrice = Product::getDiscountedPrice($productDetails['id']);
                            ?>
                            <div class="sp-essential_stuff">
                                <ul>
                                    @if (!empty($getPrice))
                                        <li>Price: <a href="javascript:void(0)"><span><span id="getPrice"><del>Rs.{{$productDetails->product_price}}.00</del> </span></span></a></li>
                                        <li style="color: red;"> Discount Price: <a href="javascript:void(0)"><span><span id="dicsount" style="color: red;">Rs.{{$getPrice}}.00</span></span></a></li>
                                    @else
                                        <li>Price: <a href="javascript:void(0)"><span><span id="getPrice">Rs.{{$productDetails->product_price}}.00 </span></span></a></li>
                                    @endif
                                    <li>Brands <a href="javascript:void(0)">{{$productDetails->brand_name}}</a></li>
                                    <li>Product Code: <a href="javascript:void(0)">{{$productDetails->product_code}}</a></li>
                                    <li>Availability: <a href="javascript:void(0)"><span id="availability">@if($total_stock>0) In Stock @else Oute of Stock @endif</span></a></li>
                                </ul>
                            </div>
                            <div  class="product-size_box">
                                <span>Select Size</span>
                                <select class="myniceselect nice-select" name="size" id="selSize">
                                    <option value="">Select Size</option>
                                    @foreach($productDetails->attributes as $size)
                                    <option value="{{$productDetails->id}}-{{$size->size}}">{{$size->size}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="color-list_area">
                                <div class="color-list_heading">
                                    <h4>Available Options</h4>
                                </div>
                                <span class="sub-title">Select Color</span>

                                <div class="color-list">
                                    <select class="myniceselect nice-select" name="product_color" id="selSize">
                                        <option value="{{$productDetails->product_color}}">{{$productDetails->product_color}}</option>
                                        <option value="{{$productDetails->product_color1}}">{{$productDetails->product_color1}}</option>
                                        <option value="{{$productDetails->product_color2}}">{{$productDetails->product_color2}}</option>
                                        <option value="{{$productDetails->product_color3}}">{{$productDetails->product_color3}}</option>
                                        <option value="{{$productDetails->product_color4}}">{{$productDetails->product_color4}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="quantity">
                                <label>Quantity</label>
                                <div class="cart-plus-minus ">
                                    <input class="cart-plus-minus-box" id="check_quantity" name="quantity" value="1" type="text" >
                                   <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                </div>
                            </div>
                            @if($total_stock>0)
                            <div class="qty-btn_area carButton">
                                <ul>
                                    <li><a  ><input type="submit" class="qty-cart_btn" name="addCart" value="Add To Cart"  style="background-color: #fff; border:none;"> </a></li>
                                    <li><a class="qty-wishlist_btn" href="" ><button type="submit" name="wishListButton" value="wishListButton">
                                        <i class="ion-android-favorite-outline"></i>
                                </button></a></li>
                                </ul>
                            </div>
                            @endif
                            <div class="hiraola-social_link">
                                <ul>
                                    <li class="facebook">
                                        <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank" title="Facebook">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="https://twitter.com" data-toggle="tooltip" target="_blank" title="Twitter">
                                            <i class="fab fa-twitter-square"></i>
                                        </a>
                                    </li>
                                    <li class="youtube">
                                        <a href="https://www.youtube.com" data-toggle="tooltip" target="_blank" title="Youtube">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li class="google-plus">
                                        <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                            <i class="fab fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li class="instagram">
                                        <a href="https://rss.com" data-toggle="tooltip" target="_blank" title="Instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hiraola's Single Product Area End Here -->

<!-- Begin Hiraola's Single Product Tab Area -->
<div class="hiraola-product-tab_area-2 sp-product-tab_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sp-product-tab_nav ">
                    <div class="product-tab">
                        <ul class="nav product-menu">
                            <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a>
                            </li>
                            <li><a data-toggle="tab" href="#specification"><span>Specification</span></a></li>
                        </ul>
                    </div>
                    <div class="tab-content hiraola-tab_content">
                        <div id="description" class="tab-pane active show" role="tabpanel">
                            <div class="product-description">
                                <ul>
                                    <li>
                                        <span>{{$productDetails->description}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="specification" class="tab-pane" role="tabpanel">
                            @if (!empty($productDetails->wash_care))
                                <label for="" style="font-weight: bold">Wash/Care : </label>&nbsp;{{$productDetails->wash_care}} <br>
                            @endif
                            @if (!empty($productDetails->fabric))
                                <label for="" style="font-weight: bold">Fabric : </label>&nbsp;{{$productDetails->fabric}} <br>
                            @endif
                            @if (!empty($productDetails->sleeve))
                                <label for="" style="font-weight: bold">Sleeve : </label>&nbsp;{{$productDetails->sleeve}} <br>
                            @endif
                            @if (!empty($productDetails->pattern))
                                <label for="" style="font-weight: bold">Pattern : </label>&nbsp;{{$productDetails->pattern}} <br>
                            @endif
                            @if (!empty($productDetails->fit))
                                <label for="" style="font-weight: bold">Fit : </label>&nbsp;{{$productDetails->fit}} <br>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hiraola's Single Product Tab Area End Here -->
<!-- Begin Hiraola's Product Area Two -->
<div class="hiraola-product_area hiraola-product_area-2 section-space_add">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="hiraola-section_title">
                    <h4>Related Products</h4>
                </div>

            </div>
            <div class="col-lg-12">
                <div class="hiraola-product_slider-3">

                    <!-- Begin Hiraola's Slide Item Area -->
                    @foreach($relatedProducts as $item)
                    <div class="slide-item">
                        <div class="single_product">
                            <div class="product-img">
                                <a href="{{url('product', $item->id)}}">
                                    <img class="primary-img" src="{{asset('image/product_image/small/'.$item->product_image)}}" alt="Hiraola's Product Image">
                                    <img class="secondary-img" src="{{asset('image/product_image/small/'.$item->product_image)}}" alt="Hiraola's Product Image">
                                </a>
                                <span class="sticker-2">Sale</span>
                                <div class="add-actions">
                                    <ul>
                                        <li><a class="hiraola-add_cart" href="{{url('product', $item->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                            $getPrice = Product::getDiscountedPrice($item['id']);
                            ?>
                            <div class="hiraola-product_content">
                                <div class="product-desc_info">
                                    <h6><a class="product-name" href="">{{$item->product_name}}</a></h6>
                                    @if (!empty($getPrice))
                                        <div class="price-box">
                                            <span class="new-price"> <del>Rs.{{$item['product_price']}}.00 </del> </span>
                                        </div>
                                        <div class="price-box">
                                            <span class="new-price" style="color: red;">Discount: Rs.{{$getPrice}}.00</span>
                                        </div>
                                    @else
                                        <div class="price-box">
                                            <span class="new-price">Rs.{{$item['product_price']}}.00 {{$getPrice}}</span>
                                        </div>
                                    @endif
                                    <div class="additional-add_action">
                                        <ul>
                                            <li><a class="hiraola-add_compare" href="{{url('product', $item->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                    class="ion-android-favorite-outline"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- Hiraola's Slide Item Area End Here -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hiraola's Product Area Two End Here -->
@endsection
