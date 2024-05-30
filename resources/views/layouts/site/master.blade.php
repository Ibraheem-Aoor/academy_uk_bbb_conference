<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} - {{ $page_title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="keywords" content="online university, distance learning, higher education, e-learning, accredited courses, virtual classrooms, flexible study options, academic programs, degree courses, continuing education, digital learning platform, remote education, interactive learning, career advancement, professional development, skill enhancement, academic excellence, student support services, global education, affordable tuition fees">
    <meta content="Welcome to Academy-UK, your gateway to accredited online education. Explore a wide range of degree courses, flexible study options, and interactive learning experiences. With virtual classrooms and dedicated student support services, we empower you to achieve academic excellence and career advancement from anywhere in the world. Discover affordable tuition fees and global opportunities for professional development. Start your journey with us today." name="description" />
    <meta name="csrf" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/site/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/style.css') }}" rel="stylesheet" />

    @stack('css')
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    {{-- Site Nav Bar --}}
    @include('layouts.site.partials.navbar')

    {{-- Site Content --}}
    @yield('content')


    {{-- Footer --}}
    @include('layouts.site.partials.footer')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/site/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/site/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/site/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/site/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/site/js/main.js') }}"></script>

    @stack('js')
</body>

</html>
