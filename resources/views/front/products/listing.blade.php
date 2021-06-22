@extends('layouts.front_layout.front_layout')


@section('content')

@include('layouts.front_layout.front1_header')
<div class="hiraola-content_wrapper">
    <div class="container">
        <div class="row">
            @if (!empty($searchProduct))
              <?php
                $botNum = 12;
              ?>
            @else
            <?php
            $botNum = 9;
          ?>
          @include('front.products.sider_bar')
            @endif
            <div class="col-lg-{{$botNum}} order-1 order-lg-2 ">
              @if (!empty($searchProduct))

              @else
                <div class="shop-toolbar">
                    <div class="product-view-mode">
                        <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="fa fa-th"></i></a>
                        <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top" title="List View"><i class="fa fa-th-list"></i></a>
                    </div>
                    <div class="product-item-selection_area">
                        <form name="sortProducts" id="sortProducts" method="get">
                        <div class="product-short">
                            <input type="hidden" name="url" id="url" value="{{$url}}">
                            <label class="select-label">Short By:</label>
                            <select name="sort" id="sort" class="nice-select sorts">
                                <option value="">Select</option>
                                <option value="product_lastest"
                                @if (isset($_GET['sort']) && $_GET == "product_lastest") selected="" @endif
                                >Latest Products</option>
                                <option value="product_name_a_z"
                                @if (isset($_GET['sort']) && $_GET == "product_name_a_z") selected="" @endif
                                >Name, A to Z</option>
                                <option value="product_name_z_a"
                                @if (isset($_GET['sort']) && $_GET == "product_name_z_a") selected="" @endif
                                >Name, Z to A</option>
                                <option value="product_name_price_low_high"
                                @if (isset($_GET['sort']) && $_GET == "product_name_price_low_high") selected="" @endif
                                >Price, low to high</option>
                                <option value="product_name_price_high_low"
                                @if (isset($_GET['sort']) && $_GET == "product_name_price_high_low") selected="" @endif
                                >Price, high to low</option>
                            </select>
                        </div>
                        </form>
                    </div>
                </div>
              @endif


                <div class="filter_products">
                    @include('front.products.ajax_product_listing')
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hiraola-paginatoin-area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <ul class="hiraola-pagination-box">
                                        @if(empty($searchProduct))
                                        {{$products->links()}}
                                        @endif
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="product-select-box">
                                        <div class="product-short">
                                            <p>
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hiraola's Content Wrapper Area End Here -->
@endsection

