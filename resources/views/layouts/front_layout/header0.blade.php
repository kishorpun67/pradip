<!-- Begin Hiraola's Header Main Area Two -->
<?php
use App\Http\Controllers\Controller;

    $mainCategories = Controller::mainCategories();
    $mainCategoires = json_decode(json_encode($mainCategories),true);

?>
<header class="header-main_area header-main_area-2">
    <div class="header-bottom_area header-bottom_area-2 header-sticky stick">
        <div class="container-fliud">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="header-logo">
                        <a href="{{url('/')}}">
                            <img src="{{asset('frontend/assets/images/menu/logo/logo.png')}}" alt="Hiraola's Header Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block position-static">
                    <div class="main-menu_area">
                        <nav>
                            <ul>

                                @foreach($mainCategoires as $section)
                                <li class="megamenu-holder"><a href="">{{$section['name']}}</a>
                                    <ul class="hm-megamenu">
                                        @foreach($section['categories'] as $category)
                                        <li><span class="megamenu-title"> <a href="{{route('products' , $category['url'])}}">{{$category['category_name']}}</a></span>
                                            <ul>
                                                @foreach($category['subcategories'] as $subCategory)
                                            <li><a href="{{route('products' , $subCategory['url'])}}">{{$subCategory['category_name']}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                                {{-- <li><a href="">Pages</a>
                                    <ul class="hm-dropdown">
                                        <li><a href="{{route('account')}}">My Account</a></li>
                                        <li><a href="{{route('user.login')}}">Login | Register</a></li>
                                        <li><a href="{{route('add.wish.list')}}">Wishlist</a></li>
                                        <li><a href="{{route('cart')}}">Cart</a></li>
                                        <li><a href="{{route('orders')}}">Order</a></li>
                                    </ul>
                                </li> --}}
                                <li><a href="{{route('about')}}">About Us</a>
                                <li><a href="{{route('contact')}}">Contact</a>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 col-md-8 col-sm-8">
                    <div class="header-right_area">
                        <ul>
                            <li>
                                <a href="{{route('add.wish.list')}}" class="wishlist-btn">
                                    <i class="ion-android-favorite-outline"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#searchBar" class="search-btn toolbar-btn">
                                    <i class="ion-ios-search-strong"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white d-lg-none d-block">
                                    <i class="ion-navicon"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('cart')}}" class="minicart-btn ">
                                    <i class="ion-bag"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-search_wrapper" id="searchBar">
        <div class="offcanvas-menu-inner">
            <div class="container">
                <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                <!-- Begin Offcanvas Search Area -->
                <div class="offcanvas-search">
                    <form action="{{route('search.products')}}" method="POST" class="hm-searchbox">
                        @csrf
                        <input type="text" name="product" placeholder="Search for item...">
                        <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
                <!-- Offcanvas Search Area End Here -->
            </div>
        </div>
    </div>
    <div class="mobile-menu_wrapper" id="mobileMenu">
        <div class="offcanvas-menu-inner">
            <div class="container">
                <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                <div class="offcanvas-inner_search">
                    <form action="{{route('search.products')}}" method="POST" class="hm-searchbox">
                        @csrf
                        <input type="text" name="product" placeholder="Search for item...">
                        <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
                <nav class="offcanvas-navigation">
                    <ul class="mobile-menu">
                        <li class="menu-item active"><a href="{{url('/')}}"><span class="mm-text">Home</span></a>
                        </li>
                        @foreach($mainCategoires as $section)
                        <li class="menu-item-has-children">
                            <a href="#">
                                <span class="mm-text">{{$section['name']}}</span>
                            </a>
                            <ul class="sub-menu">
                                @foreach($section['categories'] as $category)
                                <li class="menu-item-has-children">
                                    <a href="{{route('products' , $category['url'])}}">
                                        <span class="mm-text">{{$category['category_name']}}</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                        @foreach($category['subcategories'] as $subCategory)
                                            <a href="{{route('products' , $subCategory['url'])}}">
                                                <span class="mm-text">{{$subCategory['category_name']}}</span>
                                            </a>
                                        @endforeach
                                        </li>
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                        <li class="menu-item-has-children">
                            <a href="#">
                                <span class="mm-text">Pages</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{route('account')}}">
                                        <span class="mm-text">My Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('user.login')}}">
                                        <span class="mm-text">Login | Register</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('add.wish.list')}}">
                                        <span class="mm-text">Wishlist</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('cart')}}">
                                        <span class="mm-text">Cart</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('checkout')}}">
                                        <span class="mm-text">Checkout</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('orders')}}">
                                        <span class="mm-text">Order</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{route('about')}}">About Us</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </nav>
                <nav class="offcanvas-navigation user-setting_area">
                    <ul class="mobile-menu">
                        @if(!empty(Auth::user()))
                        <li>
                            <a href="{{route('account')}}">
                                <span class="mm-text">My Account
                            </span>
                            </a>
                        </li>
                        @endif
                        @if(!empty(Auth::user()))
                        <li >
                            <a href="{{route('user.logout')}}"><span class="mm-text">Logout</span></a>
                        @else
                            <a href="{{route('user.login')}}"><span class="mm-text">Login</span></a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
