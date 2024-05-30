@extends('layouts.site.master')
@section('content')
    <div class="container-fluid">
        <div class="container py-5">

            <div class="row">
                <div class="col-lg-4 col-md-6 pb-4 mt-5">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="https://iaula.edu/">
                        <img class="img-fluid" src="{{ asset('assets/site/img/FormGEN-logo_header-200727-01-5.png') }}"
                            alt="">

                    </a>
                </div>
                <div class="col-lg-4 col-md-6 pb-4">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                        href="https://magnacartacollege.ac.uk/">
                        <img class="img-fluid" src="{{ asset('assets/site/img/MCC-final-horz.png') }}" alt="">

                    </a>
                </div>
                <div class="col-lg-4 col-md-6 pb-4 mt-5">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                        href="https://academy-uk.net/">
                        <img class="img-fluid" src="{{ asset('assets/site/img/logo.png') }}" alt="">

                    </a>
                </div>



            </div>
        </div>
    </div>
@endsection
