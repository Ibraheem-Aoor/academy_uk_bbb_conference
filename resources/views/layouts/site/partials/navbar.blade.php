<div class="container-fluid bg-dark">
    <div class="row py-2 px-lg-5">
        <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center text-white">
                <small><i class="fa fa-phone-alt mr-2"></i>00447745760134</small>
                <small class="px-3">|</small>
                <small><i class="fa fa-phone-alt mr-2"></i>00962792729988</small>
                <small class="px-3">|</small>
                <small><i class="fa fa-envelope mr-2"></i>info@london-college.org.uk</small>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-white px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-white px-2" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-white px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-white px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-white pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-3">
        <a href="index.html" class="navbar-brand ml-lg-3">
            <img src="{{  asset('assets/site/img/LOGO ACADEMY.png')}}" alt="" width="350px" />
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-9" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ areActiveRoutes(['home']) }}">Home</a>
                <a href="{{ route('site.about') }}"
                    class="nav-item nav-link {{ areActiveRoutes(['site.about']) }}">About</a>
                <a href="{{ route('site.programs.index') }}"
                    class="nav-item nav-link {{ areActiveRoutes(['site.programs.index']) }}">Courses</a>
                <a href="{{ route('site.partners') }}"
                    class="nav-item nav-link {{ areActiveRoutes(['site.partners']) }}">Partners</a>
                <a href="{{ route('site.crf.index') }}"
                    class="nav-item nav-link {{ areActiveRoutes(['site.crf.index']) }}">Certified Remote Freelancer</a>
                <a href="{{ route('site.etraining') }}"
                    class="nav-item nav-link {{ areActiveRoutes(['site.etraining']) }}">E-Training</a>

                <!-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0">
                    <a href="detail.html" class="dropdown-item">Course Detail</a>
                    <a href="feature.html" class="dropdown-item">Our Features</a>
                    <a href="team.html" class="dropdown-item">Instructors</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                </div>
            </div> -->
                <a href="{{ route('site.contact') }}"
                    class="nav-item nav-link {{ areActiveRoutes(['site.contact']) }}">Contact</a>
            </div>
            <a href="https://srs.academy-uk.net/application"  target="_blank" class="btn btn-primary py-2 px-4 d-none d-lg-block">APPLY NOW</a>
        </div>
    </nav>
</div>
@yield('before_header')
<!-- Header Start -->
<div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 50px">
    <div class="container text-center my-5">
        <h2 class="text-white mt-4">Learn From Home</h2>
        <h2 class="text-white display-1">{{ $page_title }}</h2>
    </div>
</div>
<!-- Header End -->
