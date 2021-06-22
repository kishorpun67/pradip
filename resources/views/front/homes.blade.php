@extends('layouts.front_layout.front_layout')

@section('content')
@include('layouts.front_layout.header0')
<?php
    use App\Admin\Product;
    use App\Admin\Post;
    $image1 = Post::where('id', 1)->where('status',1)->first();
    $image2 = Post::where('id', 2)->where('status',1)->first();
    $image3 = Post::where('id', 3)->where('status',1)->first();

?>
<style>
     .bg-4,
        .bg-5, .bg-6 {
          background-image: url({{asset('frontend/assets/images/slider/'.$image1->image )}});
          background-repeat: no-repeat;
          background-position: center center;
          background-size: cover;
          min-height: 825px;
        }

        @media (max-width: 1199px) {
          .bg-4,
          .bg-5, .bg-6 {
            min-height: 520px;
          }
        }

        @media (max-width: 575px) {
          .bg-4,
          .bg-5, .bg-6 {
            min-height: 410px;
          }
        }

        .bg-5 {
          background-image: url({{asset('frontend/assets/images/slider/'. $image2->image)}});
        }
        .bg-6 {
            background-image: url({{asset('frontend/assets/images/slider/'. $image3->image)}});

        }
</style>
<div class="hiraola-slider_area-2">
    <div class="main-slider">
        <!-- Begin Single Slide Area -->
            <div class="single-slide animation-style-01 bg-4">
                <div class="container">
                    <div class="slider-content">
                    </div>
                    <div class="slider-progress"></div>
                </div>
            </div>


        <!-- Single Slide Area End Here -->
        <!-- Begin Single Slide Area -->
        <div class="single-slide animation-style-02 bg-5">
            <div class="container">
                <div class="slider-content">
                </div>
                <div class="slider-progress"></div>
            </div>
        </div>
        <!-- Single Slide Area End Here -->
        <!-- Begin Single Slide Area -->
        <div class="single-slide animation-style-02 bg-6">
            <div class="container">
                <div class="slider-content">

                </div>
                <div class="slider-progress"></div>
            </div>
        </div>
        <!-- Single Slide Area End Here -->
    </div>
</div>

<!-- Begin Hiraola's Shipping Area Two -->
<div class="hiraola-shipping_area hiraola-shipping_area-2">
    <div class="container">
        <div class="shipping-nav">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="shipping-item">
                        <div class="shipping-icon">
                            <img src="{{asset('frontend/assets/images/shipping-icon/1.png')}}" alt="Hiraola's Shipping Icon">
                        </div>
                        <div class="shipping-content">
                            <h6>Free Uk Standard Delivery</h6>
                            <p>Designated day delivery</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="shipping-item">
                        <div class="shipping-icon">
                            <img src="{{asset('frontend/assets/images/shipping-icon/2.png')}}" alt="Hiraola's Shipping Icon">
                        </div>
                        <div class="shipping-content">
                            <h6>Freshyly Prepared Ingredients</h6>
                            <p>Made for your delivery date</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="shipping-item">
                        <div class="shipping-icon">
                            <img src="{{asset('frontend/assets/images/shipping-icon/3.png')}}" alt="Hiraola's Shipping Icon">
                        </div>
                        <div class="shipping-content">
                            <h6>98% Of Anta Clients</h6>
                            <p>Reach their personal goals set</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="shipping-item">
                        <div class="shipping-icon">
                            <img src="{{asset('frontend/assets/images/shipping-icon/4.png')}}" alt="Hiraola's Shipping Icon">
                        </div>
                        <div class="shipping-content">
                            <h6>Winner Of 15 Awards</h6>
                            <p>Healthy food and drink 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hiraola's Shipping Area Two End Here -->

<!-- Begin Hiraola's Product Area -->
<div class="hiraola-product_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hiraola-section_title">
                    <h4>New Arrival</h4>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="hiraola-product_slider">
                    @foreach ($newArrival as $newitem)
                    <div class="slide-item">
                        <div class="single_product">
                            <div class="product-img">
                                <a href="{{url('product', $newitem->id)}}">
                                    <img class="primary-img" src="{{asset('image/product_image/large/'.$newitem->product_image)}}" alt="Hiraola's Product Image">
                                    <img class="secondary-img" src="{{asset('image/product_image/large/'.$newitem->product_image)}}" alt="Hiraola's Product Image">
                                </a>
                                <span class="sticker">New</span>
                                <div class="add-actions">
                                    <ul>
                                        <li><a class="hiraola-add_cart" href="{{url('product', $newitem->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hiraola-product_content">
                                <div class="product-desc_info">
                                    <h6><a class="product-name" href="">{{$newitem->product_name}}</a></h6>
                                    <?php
                                    $getPrice = Product::getDiscountedPrice($newitem['id']);
                                    ?>
                                    @if (!empty($getPrice))
                                        <div class="price-box">
                                            <span class="new-price"> <del>Rs.{{$newitem['product_price']}}.00 </del> </span>
                                        </div>
                                        <div class="price-box">
                                            <span class="new-price" style="color: red;">Discount: Rs.{{$getPrice}}.00</span>
                                        </div>
                                    @else
                                        <div class="price-box">
                                            <span class="new-price">Rs.{{$newitem['product_price']}}.00 {{$getPrice}}</span>
                                        </div>
                                    @endif
                                    <div class="additional-add_action">
                                        <ul>
                                            <li><a class="hiraola-add_compare" href="{{url('product', $newitem->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hiraola's Product Area End Here -->

<div class="static-banner_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="static-banner-image"></div>
                <div class="static-banner-content">
                    <p><span>-25% Off</span>This Week</p>
                    <h2>Featured Product</h2>
                    <h3>Meito Accessories 2019</h3>
                    <p class="schedule">
                        Starting at
                        <span> £1209.00</span>
                    </p>
                    <div class="hiraola-btn-ps_left">
                        <a href="#" class="hiraola-btn">Shopping Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Begin Hiraola's Product Tab Area -->
<div class="hiraola-product-tab_area-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-tab">
                    <div class="hiraola-tab_title">
                        <h4>New Products</h4>
                    </div>
                    <ul class="nav product-menu">
                        <li><a class="active" data-toggle="tab" href="#men"><span>Men</span></a></li>
                        <li><a data-toggle="tab" href="#women"><span>Womem</span></a></li>
                        <li><a data-toggle="tab" href="#kids"><span>Kids</span></a></li>
                    </ul>
                </div>
                <div class="tab-content hiraola-tab_content">
                    <div id="men" class="tab-pane active show" role="tabpanel">
                        <div class="hiraola-product-tab_slider-2">
                            @foreach ($menProduct as $product)
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="{{url('product', $product->id)}}">
                                            <img class="primary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                                        </a>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="{{url('product', $product->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i
                                                        class="ion-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="{{url('product', $product->id)}}">{{$product->product_name}}
                                                </a></h6>
                                                <?php
                                                $getPrice = Product::getDiscountedPrice($product['id']);
                                                ?>
                                                @if (!empty($getPrice))
                                                    <div class="price-box">
                                                        <span class="new-price"> <del>Rs.{{$product['product_price']}}.00 </del> </span>
                                                    </div>
                                                    <div class="price-box">
                                                        <span class="new-price" style="color: red;">Discount: Rs.{{$getPrice}}.00</span>
                                                    </div>
                                                @else
                                                    <div class="price-box">
                                                        <span class="new-price">Rs.{{$product['product_price']}}.00 {{$getPrice}}</span>
                                                    </div>
                                                @endif
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="{{url('product', $product->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                            class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="women" class="tab-pane " role="tabpanel">
                        <div class="hiraola-product-tab_slider-2">
                            @foreach ($womenProduct as $product)
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="{{url('product', $product->id)}}">
                                            <img class="primary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                                        </a>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="{{url('product', $product->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i
                                                        class="ion-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">{{$product->product_name}}
                                                </a></h6>
                                                <?php
                                                $getPrice = Product::getDiscountedPrice($product['id']);
                                                ?>
                                                @if (!empty($getPrice))
                                                    <div class="price-box">
                                                        <span class="new-price"> <del>Rs.{{$product['product_price']}}.00 </del> </span>
                                                    </div>
                                                    <div class="price-box">
                                                        <span class="new-price" style="color: red;">Discount: Rs.{{$getPrice}}.00</span>
                                                    </div>
                                                @else
                                                    <div class="price-box">
                                                        <span class="new-price">Rs.{{$product['product_price']}}.00 {{$getPrice}}</span>
                                                    </div>
                                                @endif
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="{{url('product', $product->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                            class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="kids" class="tab-pane " role="tabpanel">
                        <div class="hiraola-product-tab_slider-2">
                            @foreach ($kidProduct as $product)
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="{{url('product', $product->id)}}">
                                            <img class="primary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                                        </a>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="{{url('product', $product->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i
                                                        class="ion-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">{{$product->product_name}}
                                                </a></h6>
                                                <?php
                                                $getPrice = Product::getDiscountedPrice($product['id']);
                                                ?>
                                                @if (!empty($getPrice))
                                                    <div class="price-box">
                                                        <span class="new-price"> <del>Rs.{{$product['product_price']}}.00 </del> </span>
                                                    </div>
                                                    <div class="price-box">
                                                        <span class="new-price" style="color: red;">Discount: Rs.{{$getPrice}}.00</span>
                                                    </div>
                                                @else
                                                    <div class="price-box">
                                                        <span class="new-price">Rs.{{$product['product_price']}}.00 {{$getPrice}}</span>
                                                    </div>
                                                @endif
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="{{url('product', $product->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                            class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hiraola's Product Tab Area End Here -->


<!-- Begin Hiraola's Product Tab Area Three -->
<div class="hiraola-product_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hiraola-section_title">
                    <h4>Feature Product</h4>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="hiraola-product_slider">
                    @foreach ($featureProducts as $newitem)
                    <div class="slide-item">
                        <div class="single_product">
                            <div class="product-img">
                                <a href="{{url('product', $newitem->id)}}">
                                    <img class="primary-img" src="{{asset('image/product_image/large/'.$newitem->product_image)}}" alt="Hiraola's Product Image">
                                    <img class="secondary-img" src="{{asset('image/product_image/large/'.$newitem->product_image)}}" alt="Hiraola's Product Image">
                                </a>
                                <span class="sticker">New</span>
                                <div class="add-actions">
                                    <ul>
                                        <li><a class="hiraola-add_cart" href="{{url('product', $newitem->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hiraola-product_content">
                                <div class="product-desc_info">
                                    <h6><a class="product-name" href="">{{$newitem->product_name}}</a></h6>
                                    <?php
                                    $getPrice = Product::getDiscountedPrice($newitem['id']);
                                    ?>
                                    @if (!empty($getPrice))
                                        <div class="price-box">
                                            <span class="new-price"> <del>Rs.{{$newitem['product_price']}}.00 </del> </span>
                                        </div>
                                        <div class="price-box">
                                            <span class="new-price" style="color: red;">Discount: Rs.{{$getPrice}}.00</span>
                                        </div>
                                    @else
                                        <div class="price-box">
                                            <span class="new-price">Rs.{{$newitem['product_price']}}.00 {{$getPrice}}</span>
                                        </div>
                                    @endif
                                    <div class="additional-add_action">
                                        <ul>
                                            <li><a class="hiraola-add_compare" href="{{url('product', $newitem->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hiraola's Product Tab Area Three End Here -->
@endsection
