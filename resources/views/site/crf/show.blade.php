@extends('layouts.site.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
                            <h1 class="text-black mt-4 ">{{ $crf->name }}</h1>

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
            <a class="card__link"
                href="https://docs.google.com/forms/d/1K9qm3fCKCo0X0v6UuF1FNJvEaZmAqHiQNwM5CqavBZo/viewform?edit_requested=true"
                target="_blank">
                <div class="card card-1">
                    <h4 class="card__title">APPLY NOW</h2>

                </div>
            </a>
        </div>
    </div>
    <div class="accordion" id="accordionExample" style="width: 90%; margin: auto;">
        @foreach ($crf->levels as $level)
            <div class="accordion-item">
                <h2 class="accordion-header" id="{{ $level->id }}-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#{{ $level->id }}-collapseOne" aria-expanded="false"
                        aria-controls="{{ $level->id }}-collapseOne">
                        {{ $level->name }}
                    </button>
                </h2>
                <div id="{{ $level->id }}-collapseOne" class="accordion-collapse collapse"
                    aria-labelledby="{{ $level->id }}-headingOne">
                    <div class="accordion-body">
                        {!! $level->description !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
@endpush
