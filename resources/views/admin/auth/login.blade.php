<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hyper Systems Demo" />
    <meta name="keywords" content="Saas, Software, multi-uses, HTML, Clean, Modern ,Hyper Systems" />
    <meta name="author" content="Ibraheem AlAwoor" />
    <meta name="email" content="support@hyper-sys.com" />
    <meta name="website" content="hyper-sys.com" />
    <meta name="Version" content="v1.0.0" />
    <meta name="csrf" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/user/images/favicon.ico') }}" />
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

</head>

<body>
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- Loader -->

    <!-- Hero Start -->
    <section class="bg-home bg-circle-gradiant d-flex align-items-center">
        <div class="bg-overlay bg-overlay-white"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card form-signin p-4 rounded shadow">
                        <form class="custom-form" action="{{ route('login') }}" method="POST">
                            <input type="hidden" name="guard" value="admin">
                            @csrf
                            <a href="index.html">
                                <img loading="lazy" src="{{ asset('assets/user/images/logo-icon.png') }}"
                                    class="avatar avatar-small mb-4 d-block mx-auto" alt="">
                            </a>
                            <h5 class="mb-3 text-center">{{ __('auth.sign_in') }}</h5>

                            <div class="form-floating mb-2">
                                <input type="email" name="email" class="form-control" id="floatingInput"
                                    placeholder="{{ __('auth.email_address') }}">
                                <label for="floatingInput">{{ __('auth.email_address') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingPassword"
                                    placeholder="{{ __('auth.password') }}">
                                <label for="floatingPassword">{{ __('auth.password') }}</label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label"
                                            for="flexCheckDefault">{{ __('auth.remember_me') }}</label>
                                    </div>
                                </div>
                                {{-- <p class="forgot-pass mb-0"><a href="#"
                                        class="text-dark small fw-bold">{{ __('auth.forgot_password') }}</a></p> --}}
                            </div>

                            <button class="btn btn-primary w-100" type="submit">{{ __('auth.sign_in') }}</button>

                            <div class="col-12 text-center mt-3 d-none">
                                {{-- <p class="mb-0 mt-3"><small
                                        class="text-dark me-2">{{ __('auth.dont_have_account') }}</small> <a
                                        href="{{ route('register') }}"
                                        class="text-dark fw-bold">{{ __('auth.sign_up') }}</a></p> --}}
                            </div><!--end col-->
                            <p class="mb-0 text-muted mt-3 text-center">©
                                {{ date('Y') . ' ' . config('app.name') }}
                            </p>
                        </form>


                    </div>
                </div>
            </div>
        </div> <!--end container-->
    </section><!--end section-->
    <!-- Hero End -->



    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/user/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/user/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Main Js -->
    <script src="{{ asset('assets/user/js/plugins.init.js') }}"></script>
    {{-- Toaster Js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/user/js/app.js') }}"></script>
    <script src="{{ asset('assets/user/js/user/master.js') }}"></script>

</body>

</html>
