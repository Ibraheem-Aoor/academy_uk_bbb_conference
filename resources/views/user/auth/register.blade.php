@extends('layouts.admin.master')
@section('content')
    <!-- Hero Start -->
    <section class="cover-user">
        <div class="container-fluid px-0">
            <div class="row g-0 position-relative">
                <div class="col-lg-4 cover-my-30 order-2">
                    <div class="cover-user-img d-lg-flex align-items-center">
                        <div class="row">
                            <div class="col-12">
                                <div class="card border-0" style="z-index: 1">
                                    <div class="card-body p-0">
                                        <h4 class="card-title text-center">{{ __('auth.signup') }}</h4>
                                        <form action="{{ route('register') }}" method="POST"
                                            class="login-form mt-4 custom-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('auth.name') }} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-icon position-relative">
                                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                                            <input name="name" type="text" class="form-control ps-5"
                                                                placeholder="{{ __('auth.first_name_placeholder') }}"
                                                                name="first_name" required="">
                                                        </div>
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('auth.your_email') }} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-icon position-relative">
                                                            <i data-feather="mail" class="fea icon-sm icons"></i>
                                                            <input name="email" type="email" class="form-control ps-5"
                                                                placeholder="{{ __('auth.email_placeholder') }}"
                                                                name="email" required="">
                                                        </div>
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('auth.password') }} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-icon position-relative">
                                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                                            <input name="password" type="password" class="form-control ps-5"
                                                                placeholder="{{ __('auth.password_placeholder') }}"
                                                                required="">
                                                        </div>
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-md-12 d-none">
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckDefault" name="terms_and_condtions">
                                                            <label class="form-check-label" id="check-terms"
                                                                for="flexCheckDefault">{{ __('auth.accept_terms') }} <a
                                                                    href="#"
                                                                    class="text-primary">{{ __('auth.terms_and_conditions') }}</a></label>
                                                        </div>
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-md-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary">{{ __('auth.register') }}</button>
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-12 mt-4 text-center d-none">
                                                    <h6>{{ __('auth.signup_with') }}</h6>
                                                    <div class="row d-none">
                                                        <div class="col-6 mt-3">
                                                            <div class="d-grid">
                                                                <a href="javascript:void(0)" class="btn btn-light"><i
                                                                        class="mdi mdi-facebook text-primary"></i>
                                                                    Facebook</a>
                                                            </div>
                                                        </div><!--end col-->

                                                        <div class="col-6 mt-3">
                                                            <div class="d-grid">
                                                                <a href="javascript:void(0)" class="btn btn-light"><i
                                                                        class="mdi mdi-google text-danger"></i> Google</a>
                                                            </div>
                                                        </div><!--end col-->
                                                    </div>
                                                </div><!--end col-->

                                                <div class="mx-auto">
                                                    <p class="mb-0 mt-3"><small
                                                            class="text-dark me-2">{{ __('auth.already_have_account') }}</small>
                                                        <a href="{{ route('login') }}"
                                                            class="text-dark fw-bold">{{ __('auth.sign_in') }}</a>
                                                    </p>
                                                </div>
                                            </div><!--end row-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div> <!-- end about detail -->
                </div> <!-- end col -->

                <div class="col-lg-8 offset-lg-4 padding-less img order-1 jarallax" data-jarallax data-speed="0.5"
                    style="background-image:url('{{ asset('assets/user/images/user/02.jpg') }}')"></div><!-- end col -->
            </div><!--end row-->
        </div><!--end container fluid-->
    </section><!--end section-->
    <!-- Hero End -->
@endsection


