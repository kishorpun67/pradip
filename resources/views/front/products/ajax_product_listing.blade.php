<?php
	use App\Admin\Product;

   ?>
<div class="shop-product-wrap grid gridview-3 row filter_products">
    @foreach($products as $product)
    <div class="col-lg-4">
        <div class="slide-item">
            <div class="single_product">
                <div class="product-img">
                    <a href="{{url('product', $product->id)}}">
                        <img class="primary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                        <img class="secondary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                    </a>
                    <div class="add-actions">
                        <ul>
                            <li><a class="hiraola-add_cart" href="{{url('product', $product->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="hiraola-product_content">
                    <?php
                    $getPrice = Product::getDiscountedPrice($product['id']);
                ?>
                    <div class="product-desc_info">
                        <h6><a class="product-name" href="single-product.html">{{$product['product_name']}}</a></h6>
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
        <div class="list-slide_item">
            <div class="single_product">
                <div class="product-img">
                    <a href="{{url('product', $product->id)}}">
                        <img  class="primary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                        <img class="secondary-img" src="{{asset('image/product_image/large/'.$product->product_image)}}" alt="Hiraola's Product Image">
                    </a>
                </div>
                <div class="hiraola-product_content">
                    <div class="product-desc_info">
                        <h6><a class="pdrouct-name" href="{{url('product', $product->id)}}">{{$product['product_name']}}</a></h6>
                        <div class="price-box">
                            <span class="new-price">Rs.{{$product['product_price']}}.00</span>
                        </div>
                        <div class="product-short_desc">
                            <p>{{$product['description']}}</p>
                        </div>
                    </div>
                    <div class="add-actions">
                        <ul>
                            <li><a class="hiraola-add_cart" href="{{url('product', $product->id)}}" data-toggle="tooltip" data-placement="top" title="Add To Cart">Add To Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

