<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('page-title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
    <meta name="keywords" content="Saas, Software, multi-uses, HTML, Clean, Modern" />
    <meta name="author" content="Shreethemes" />
    <meta name="email" content="support@shreethemes.in" />
    <meta name="website" content="https://shreethemes.in" />
    <meta name="Version" content="v4.7.0" />
    <meta name="csrf" content="{{ csrf_token() }}">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/user/images/favicon.ico') }}" />
    <!-- Css -->
    <link href="{{ asset('assets/user/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/user/css/bootstrap.min.css') }}" class="theme-opt" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/user/libs/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/user/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet" />
    <!-- Style Css-->
    <link href="{{ asset('assets/user/css/style.min.css') }}" class="theme-opt" rel="stylesheet" type="text/css" />
    {{-- Toastr Css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')

</head>

<body>
    @include('layouts.admin.partials.loader')
    <div class="page-wrapper toggled">
        <!-- sidebar-wrapper -->
        @if (!isset($is_login_page))
            @include('layouts.admin.partials.sidebar')
        @endif
        <!-- sidebar-wrapper  -->

        <!-- Start Page Content -->
        <main class="page-content bg-light">
            <!-- Top Header -->
            @if (!isset($is_login_page))
                @include('layouts.admin.partials.top-header')
            @endif
            <!-- Top Header -->

            <div class="container-fluid">
                <div class="layout-specing">
                    @yield('content')
                </div>
            </div><!--end container-->

            <!-- Footer Start -->
            @include('layouts.footer')
            <!--end footer-->
            <!-- End -->
        </main>
        <!--End page-content" -->
    </div>
    <!-- page-wrapper -->



    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/user/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/user/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Main Js -->
    <script src="{{ asset('assets/user/js/plugins.init.js') }}"></script>
    <script src="{{ asset('assets/user/js/app.js') }}"></script>
    {{-- Toaster Js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/user/js/user/master.js') }}?v=1.0"></script>

    @stack('js')

</body>

</html>
