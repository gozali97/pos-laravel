
<!DOCTYPE html>
<html lang="en">
<head>
    <!--  Title -->
    <title>Apps</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta name="csrf-token" content="{{csrf_token()}}"
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{url('/assets/images/logos/favicon.ico')}}" />
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{url('/assets/libs/owl-corousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/libs/datatables-net-bs5/css/dataTables.bootstrap5.min.css')}}">

    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="{{url('/assets/css/style.min.css')}}" />
    <script src="{{url('/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('/assets/libs/owl.carousel.min.js')}}"></script>
    <script src="{{url('/assets/js/dashboard.js')}}"></script>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <img src="{{url('/assets/images/logos/favicon.png')}}" alt="loader" class="lds-ripple img-fluid" />
</div>
<!-- Preloader -->
<div class="preloader">
    <img src="{{url('/assets/images/logos/favicon.png')}}" alt="loader" class="lds-ripple img-fluid" />
</div>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('layouts.main-sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
    @include('layouts.main-header')
        <!--  Header End -->

        @yield('content')

    </div>
</div>

<!--  Shopping Cart -->
@include('layouts.main-cart')

<!--  Mobilenavbar -->
@include('layouts.main-app-nav')
<!--  Search Bar -->
@include('layouts.main-search')

<!--  Import Js Files -->
<script src="{{url('assets/libs/simplebar/dist/simplebar.min.js')}}"></script>
<script src="{{url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!--  core files -->
<script src="{{url('assets/js/app.min.js')}}"></script>
<script src="{{url('assets/js/app.init.js')}}"></script>
<script src="{{url('ssets/js/app-style-switcher.js')}}"></script>
<script src="{{url('assets/js/sidebarmenu.js')}}"></script>
<script src="{{url('assets/js/custom.js')}}"></script>
<script src="{{url('dist/libs/prismjs/prism.js')}}"></script>
<!--  current page js files -->

<script src="{{url('assets/libs/datatables-net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-basic.init.js')}}"></script>
<script src="{{url('assets/js/validator.min.js')}}"></script>
@stack('scripts')
</body>
</html>
