@extends('layouts.site.master')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endpush
@section('content')
    <!-- About Start -->
    <div class="container-fluid">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('assets/site/img/about_2.jpg') }}"
                            style="object-fit: cover" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">
                            About Us
                        </h6>
                        <h3>WHO ARE WE</h3>
                    </div>
                    <p style="font-size: small">
                        The London Virtual College Is An Independent Academic Higher
                        Education Institution, Registered In Britain; Aims To Provide
                        British-Accredited Programs And To Serve Students Worldwide. It Is
                        Also Recognized By Foreign Governmental Institutions, Including
                        AMIDEAST. The College Offers All Its Programs Through E-Learning
                        (Online), With The Latest Technology, And With Very High Quality
                        Controls The Curricula Have Been Prepared In A Way That Allows The
                        Student To Be Creative And Develop The Level Of Thinking And
                        Knowledge At Record Speeds. All Educational Materials Are Prepared
                        By Experts In Higher Education, With Controls That Lead To
                        Educational Outcomes In An Applied Methodological Order
                    </p>
                    <div class="section-title position-relative mb-4">
                        <h3>OUR VISION</h3>
                    </div>
                    <p style="font-size: small">
                        Leadership And Excellence In Providing Cognitive And Applied
                        Sciences, Through E-Learning Systems And Methodologies, As Well As
                        In Applied Scientific Research To Build A Knowledgeable And Modern
                        Society.
                    </p>
                    <div class="row pt-3 mx-0">
                        <div class="col-3 px-0">
                            <div class="bg-success text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">68</h1>
                                <h6 class="text-uppercase text-white">
                                    Available<span class="d-block">Subjects</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-primary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">17</h1>
                                <h6 class="text-uppercase text-white">
                                    Online<span class="d-block">Courses</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-secondary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">40</h1>
                                <h6 class="text-uppercase text-white">
                                    Skilled<span class="d-block">Instructors</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-warning text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">200</h1>
                                <h6 class="text-uppercase text-white">
                                    Happy<span class="d-block">Students</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Courses Start -->
    <div class="container-fluid px-0">
        <div class="container-fluid">
            <div class="container py-5">
                <div class="row mx-0 justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center position-relative mb-5">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">
                                Our Courses
                            </h6>
                            <h2>Checkout New Releases Of Our Courses</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 pb-4">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                            href="ukundergraduate.html">
                            <img class="img-fluid" src="{{ asset('assets/site/img/courses-1.jpg') }}" alt="" />
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3 pb-5">
                                    UK - Undergraduate Programmes
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 pb-4">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                            href="PostgraduateProgrammes.html">
                            <img class="img-fluid" src="{{ asset('assets/site/img/courses-2.jpg') }}" alt="" />
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3 pb-5">
                                    UK - Postgraduate Programmes
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 pb-4">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                            href="ExecutiveEducation.html">
                            <img class="img-fluid" src="{{ asset('assets/site/img/courses-3.jpg') }}" alt="" />
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3 pb-5">
                                    Executive Education
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 pb-4">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="#">
                            <img class="img-fluid" src="{{ asset('assets/site/img/courses-4.jpg') }}" alt="" />
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3 pb-5">
                                    US-UK Other Programmes Through Partners
                                </h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center bg-image mx-0 mb-5">
            <div class="col-lg-6 py-5">
                <div class="bg-white p-5 my-5">
                    <h1 class="text-center mb-4">70% Off For New Students</h1>
                    <form class="custom-form" action="{{ route('site.interest.submit') }}" method="POST">
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Your Name"
                                        style="padding: 30px 20px" name="name" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="email" class="form-control bg-light border-0" placeholder="Your Email"
                                        style="padding: 30px 20px" name="email" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="custom-select bg-light border-0 px-3" style="height: 60px"
                                        name="program" required>
                                        <option selected="">Select A courses</option>
                                        <option value="1">UK - Undergraduate Programmes</option>
                                        <option value="2">UK - Postgraduate Programmes</option>
                                        <option value="3">Executive Education</option>
                                        <option value="3">
                                            US-UK Other Programmes Through Partners
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary btn-block"
                                    style="height: 60px">
                                    Sign Up Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses End -->

    <div class="container-fluid" style="margin: auto">
        <div class="container">
            <div class="row mx-0 justify-content-center align-items-center">
                <div class="col-lg-8">
                    <div class="section-title text-center position-relative mb-5">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">
                            Our Professional Certificate
                        </h6>
                        <h1 class="display-5">
                            Checkout New Releases Of Our Professional Certificate
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-3 col-md-6 pb-4">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                        href="otherProgrammes2.html">
                        <img class="img-fluid" src="{{ asset('assets/site/img/courses-3.jpg') }}" alt="" />
                        <div class="courses-text">
                            <h4 class="text-center text-white px-3 pb-5">
                                US-UK Other Programmes Through Partners
                            </h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 pb-4">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                        href="CertifiedRemote.html">
                        <img class="img-fluid" src="{{ asset('assets/site/img/courses-2.jpg') }}" alt="" />
                        <div class="courses-text">
                            <h4 class="text-center text-white px-3 pb-5">
                                Certified Remote Freelancer (CRF)
                            </h4>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 pb-4">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="">
                        <img class="img-fluid" src="{{ asset('assets/site/img/courses-4.jpg') }}" alt="" />
                        <div class="courses-text">
                            <h4 class="text-center text-white px-3 pb-5">
                                Certification Programmes
                            </h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="bg-light d-flex flex-column justify-content-center px-5" style="height: 450px">
                        <div class="d-flex align-items-center mb-5">
                            <div class="btn-icon bg-primary mr-4">
                                <i class="fa fa-2x fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Our Regional Office</h4>
                                <p class="m-0">
                                    3rd Floor Muneer Complex 383 Rania Road Amman Jordan
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="btn-icon bg-secondary mr-4">
                                <i class="fa fa-2x fa-phone-alt text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Call Us</h4>
                                <p class="m-0">00962792729988</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="btn-icon bg-warning mr-4">
                                <i class="fa fa-2x fa-envelope text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Email Us</h4>
                                <p class="m-0">info@london-college.org.uk</p>
                            </div>
                        </div>
                    </div>
                </div>
                @include('site.partials.contact_form')

            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@push('js')
    <script src="{{ asset('assets/user/js/user/master.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endpush
