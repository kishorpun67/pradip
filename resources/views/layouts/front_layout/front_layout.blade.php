<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="noindex, follow" />
    <meta name="author" content="">
    <title> @if(!empty($meta_title)){{$meta_title}} @else Home | E-Shopper @endif</title>
    @if(!empty($meta_description))
        <meta name="description" content="{{$meta_description}}">
    @endif
    @if(!empty($meta_keywords))
        <meta name="keywords" content="{{$meta_keywords}}">
    @endif

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/vendor/bootstrap.min.css')}}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/vendor/font-awesome.css')}}">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/vendor/fontawesome-stars.css')}}">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/vendor/ion-fonts.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/slick.css')}}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/animate.css')}}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/jquery-ui.min.css')}}')}}">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/lightgallery.min.css')}}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/nice-select.css')}}">
    <!-- Timecircles -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/timecircles.css')}}">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from the above)-->
    <script src="{{asset('frontend/assets/js/vendor/vendor.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/plugins.min.js')}}"></script>

    <!-- Main Style CSS (Please use minify version for better website load performance) -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.min.css')}}">

</head><!--/head-->

<body class="template-color-2">

    <div class="main-wrapper">

        <!-- Begin Loading Area -->
        <div class="loading">
            <div class="text-center middle">
                <div class="lds-ellipsis">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
                <!-- Loading Area End Here -->

        @yield('content')

        @include('layouts.front_layout.footer')
    </div>
</body>
<!-- jQuery JS -->
    <script src="{{asset('frontend/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Modernizer JS -->
    <script src="{{asset('frontend/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <!-- Popper JS -->
    <script src="{{asset('frontend/assets/js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('frontend/assets/js/vendor/bootstrap.min.js')}}"></script>

    <!-- Slick Slider JS -->
    <script src="{{asset('frontend/assets/js/plugins/slick.min.js')}}"></script>
    <!-- Countdown JS -->
    <script src="{{asset('frontend/assets/js/plugins/countdown.js')}}"></script>
    <!-- Barrating JS -->
    <script src="{{asset('frontend/assets/js/plugins/jquery.barrating.min.js')}}"></script>
    <!-- Counterup JS -->
    <script src="{{asset('frontend/assets/js/plugins/jquery.counterup.js')}}"></script>
    <!-- Nice Select JS -->
    <script src="{{asset('frontend/assets/js/plugins/jquery.nice-select.js')}}"></script>
    <!-- Sticky Sidebar JS -->
    <script src="{{asset('frontend/assets/js/plugins/jquery.sticky-sidebar.js')}}"></script>
    <!-- Jquery-ui JS -->
    <script src="{{asset('frontend/assets/js/plugins/jquery-ui.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.ui.touch-punch.min.js')}}"></script>
    <!-- Lightgallery JS -->
    <script src="{{asset('frontend/assets/js/plugins/lightgallery.min.js')}}"></script>
    <!-- Scroll Top JS -->
    <script src="{{asset('frontend/assets/js/plugins/scroll-top.js')}}"></script>
    <!-- Theia Sticky Sidebar JS -->
    <script src="{{asset('frontend/assets/js/plugins/theia-sticky-sidebar.min.js')}}"></script>
    <!-- Waypoints JS -->
    <script src="{{asset('frontend/assets/js/plugins/waypoints.min.js')}}"></script>
    <!-- Instafeed JS -->
    <script src="{{asset('frontend/assets/js/plugins/instafeed.min.js')}}"></script>
    <!-- ElevateZoom JS -->
    <script src="{{asset('frontend/assets/js/plugins/jquery.elevateZoom-3.0.8.min.js')}}"></script>
    <!-- Timecircles JS -->
    <script src="{{asset('frontend/assets/js/plugins/timecircles.js')}}"></script>

    <!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe)-->
<script src="{{asset('frontend/assets/js/vendor/vendor.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/plugins/plugins.min.js')}}"></script>

    <!-- Main JS -->
<script src="{{asset('frontend/assets/js/front_script.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

</body>
</html>
