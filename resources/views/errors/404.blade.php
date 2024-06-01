
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>404 Not Found</title>


    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('assets/user/images/favicon.ico')}}" />
    <!-- Css -->
    <link href="{{asset('assets/user/libs/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/user/css/bootstrap.min.css')}}" class="theme-opt" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/user/libs/@mdi/font/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/user/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/user/libs/@iconscout/unicons/css/line.css')}}" type="text/css" rel="stylesheet" />
    <!-- Style Css-->
    <link href="{{asset('assets/user/css/style.min.css')}}" class="theme-opt" rel="stylesheet" type="text/css" />


</head>

    <body>
        <!-- Loader -->
        <!-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div> -->
        <!-- Loader -->

        <!-- ERROR PAGE -->
        <section class="bg-home d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12 text-center">
                        <img src="{{asset('assets/common/logo.png')}}" style="max-width: 500px;" alt="">
                        <div class="text-uppercase mt-4 display-5 fw-semibold">Page Not Found</div>
                        <div class="text-capitalize text-dark mb-4 error-page"></div>
                        {{-- <p class="text-muted para-desc mx-auto">Our design projects are fresh and simple and will benefit your business greatly. Learn more about our work!</p> --}}
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="{{ previousUrl() }}" class="btn btn-primary mt-4">Go To Previous</a>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- ERROR PAGE -->



    </body>

</html>
