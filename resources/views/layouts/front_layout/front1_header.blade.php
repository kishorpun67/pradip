

      <?php
      use App\Http\Controllers\Controller;

          $mainCategories = Controller::mainCategories();
          $mainCategoires = json_decode(json_encode($mainCategories),true);

      ?>
      <!-- Begin Hiraola's Header Main Area -->
        <header class="header-main_area">
            <div class="header-top_area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="ht-left_area">
                                <div class="header-shipping_area">
                                    <ul>
                                        <li>
                                            <span>Telephone Enquiry:</span>
                                            <a href="callto://+123123321345">(+123) 123 321 345</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="ht-right_area">
                                <div class="ht-menu">
                                    <ul>
                                        <li>
                                            @if(!empty(Auth::user()))
                                            <a href="{{route('account')}}">My Account</a>
                                            @endif
                                        </li>
                                        <li>
                                            @if(!empty(Auth::user()))
                                                <a href="{{route('user.logout')}}">Logout</a>
                                            @else
                                                <a href="{{route('user.login')}}">Login</a>
                                            @endif

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle_area d-none d-lg-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="header-logo">
                                <a href="{{url('/')}}">
                                    <img src="{{asset('frontend/assets/images/menu/logo/logo.png')}}" alt="Hiraola's Header Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="hm-form_area">
                                <form action="{{route('search.products')}}" method="POST" class="hm-searchbox">
                                    @csrf
                                     <select class="nice-select select-search-category">
                                        <option value="0">All</option>
                                        @foreach ($mainCategories as $category)
                                            @foreach ($category['categories'] as $item)
                                                <option value="">{{$item['category_name']}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <input type="text" name="product" placeholder="Enter your search key ...">
                                    <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom_area header-sticky stick">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 d-lg-none d-block">
                            <div class="header-logo">
                            <a href="{{url('/')}}">
                                    <img src="{{asset('frontend/assets/images/menu/logo/2.png')}}" alt="Hiraola's Header Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 d-none d-lg-block position-static">
                            <div class="main-menu_area">
                                <nav>
                                    <ul>
                                        <li class="active"><a href="{{url('')}}">Home </a></li>
                                        </li>
                                        <li class="megamenu-holder"><a href="">Shop</a>
                                            <ul class="hm-megamenu">
                                                @foreach($mainCategoires as $section)

                                                        @foreach($section['categories'] as $category)
                                                        <li><span class="megamenu-title"><a href="{{route('products' , $category['url'])}}">{{$category['category_name']}}</a></span>
                                                            <ul>
                                                                @foreach($category['subcategories'] as $subCategory)
                                                                <li><a href="{{route('products' , $subCategory['url'])}}">{{$subCategory['category_name']}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        @endforeach

                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="">Account</a>
                                            <ul class="hm-dropdown">
                                                <li><a href="{{route('account')}}">My Account</a></li>
                                                <li><a href="{{route('user.login')}}">Login | Register</a></li>
                                                <li><a href="{{route('add.wish.list')}}">Wishlist</a></li>
                                                <li><a href="{{route('cart')}}">Cart</a></li>
                                                <li><a href="{{route('checkout')}}">Checkout</a></li>
                                                <li><a href="{{route('orders')}}">Order</a></li>

                                            </ul>
                                        </li>
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
            <div class="mobile-menu_wrapper" id="mobileMenu">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                        <div class="offcanvas-inner_search">
                            <form action="{{route('search.products')}}"  method="POST" class="hm-searchbox">
                                @csrf
                                <input type="text" name="product" placeholder="Search for item...">
                                <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <nav class="offcanvas-navigation">
                            <ul class="mobile-menu">
                                <li class="menu-item active"><a href="{{url('/')}}"><span class="mm-text">Home</span></a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Shop</span>
                                    </a>
                                    <ul class="sub-menu">
                                     @foreach($mainCategoires as $section)
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
                                    @endforeach

                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Account</span>
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
        <!-- Hiraola's Header Main Area End Here -->

        <!-- Begin Hiraola's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>
                        @if(!empty($path))
                            <?php echo $path; ?>
                        @endif
                    </h2>
                    <ul>
                        <li class="active">
                            @if(!empty($breadcrumb))
                                    <?php echo $breadcrumb; ?>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Hiraola's Breadcrumb Area End Here -->
