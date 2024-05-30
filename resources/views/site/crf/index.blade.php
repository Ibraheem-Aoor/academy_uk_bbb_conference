@extends('layouts.site.master')
@push('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica,
                Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }

        .main-container {
            padding: 30px;
        }

        /* HEADING */

        .heading {
            text-align: center;
        }

        .heading__title {
            font-weight: 600;
        }

        .heading__credits {
            margin: 10px 0px;
            color: #888888;
            font-size: 25px;
            transition: all 0.5s;
        }

        .heading__link {
            text-decoration: none;
        }

        .heading__credits .heading__link {
            color: inherit;
        }

        /* CARDS */

        .cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            margin: 10px;

            width: 550px;
            height: 80px;
            display: grid;
            grid-template-rows: 20px 50px 1fr 50px;
            border-radius: 10px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
            /* transition: all 0.2s; */
        }

        .cardfirst {
            margin-bottom: 10px;
            margin-right: 30px;
            width: 600px;
            height: 90px;
            display: grid;
            grid-template-rows: 20px 50px 1fr 50px;
            border-radius: 10px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
            /* transition: all 0.2s; */
        }

        .cardfirst1 {
            margin-bottom: 10px;

            margin-left: 30px;
            width: 600px;
            height: 90px;
            display: grid;
            grid-template-rows: 20px 50px 1fr 50px;
            border-radius: 10px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
            /* transition: all 0.2s; */
        }

        .card:hover {
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
            transform: scale(1.01);
        }

        .card__link,
        .card__exit,
        .card__icon {
            position: relative;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.9);
        }

        .card__link::after {
            position: absolute;
            top: 25px;
            left: 0;
            content: "";
            width: 0%;
            height: 3px;
            background-color: rgba(255, 255, 255, 0.6);
            transition: all 0.5s;
        }

        .card__link:hover::after {
            width: 100%;
        }





        .card__title {
            grid-row: 1/4;
            color: #ffffff;
            padding-top: 25px;
            padding-bottom: 10px;
            padding-left: 10px;
            justify-content: center;
            text-align: center;
        }

        .card__apply {
            grid-row: 1/5;
            align-self: center;
            padding-left: 10px;
            justify-content: center;
            text-align: center;
        }

        /* CARD BACKGROUNDS */

        .card-1 {
            background: radial-gradient(#0d92ff, #3fbafe);
        }

        .card-2 {
            background: radial-gradient(#063879, #4820c2);
        }

        .card-3 {
            background: radial-gradient(#063879, #3020c2);
        }

        .card-4 {
            background: radial-gradient(#60efbc, #58d5c9);
        }

        .card-5 {
            background: radial-gradient(#f588d8, #c0a3e5);
        }

        /* RESPONSIVE */

        @media (max-width: 1600px) {
            .cards {
                justify-content: center;
            }


        }
    </style>
@endpush
@section('before_header')
    <section class="section section-default mt-none mb-none">
        <div class="container">
            <strong>
                <div class="row">

                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <div class="square-holder">
                            <a href="http://welcome.london-college.org.uk/" target="_blank">
                                <img alt="" src="{{ asset('assets/site/img/kkkk.png') }}" width="100px" /></a>
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-8">
                        <div class="container text-center my-2 ">
                            <h1 class="text-black mt-4 ">{{ $page_title }}</h1>

                        </div>

                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <div class="square-holder">
                            <a href="https://academy-uk.net/" target="_blank">
                                <img alt="" src="{{ asset('assets/site/img/LOGO ACADEMY.png') }}"
                                    width="180px" /></a>

                        </div>

                    </div>



                </div>
            </strong>
        </div>
    </section>
@endsection
@section('content')
    <div class="main-container">
        <div class="cards">
            @if (!request()->has('parent_crf'))
                <div class="cardfirst card-2" style="color: #60efbc;">
                    <h4 class="card__title">
                        APPLY NOW</h2>
                        <p class="card__apply">
                            <a class="card__link"
                                href="https://docs.google.com/forms/d/e/1FAIpQLSd-eFZ5WFTHbMJ-PAyU5oTjmXq1mSK8KEsv0dOnFonbvlWQKw/viewform"
                                target="_blank">GO <i class="fas fa-arrow-right"></i></a>
                        </p>
                </div>
                <div class="cardfirst1 card-3">
                    <h4 class="card__title">
                        General Registration Procedures</h2>
                        <p class="card__apply">
                            <a class="card__link" href="generalProcedure.html">GO <i class="fas fa-arrow-right"></i></a>
                        </p>
                </div>
            @endif
            @foreach ($crfs as $crf)
                <div class="card card-1">
                    <h4 class="card__title">
                        {{ $crf->name }}
                    </h4>
                    <p class="card__apply">
                        <a class="card__link"
                            @if ($crf->children()->count() > 0) href="{{ route('site.crf.index', ['parent_crf' => encrypt($crf->id)]) }}" @else href="{{ route('site.crf.show', encrypt($crf->id)) }}" @endif>Details
                            <i class="fas fa-arrow-right"></i></a>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
