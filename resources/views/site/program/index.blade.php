@extends('layouts.site.master')
@section('content')
    <!-- Courses Start -->
    <div class="container-fluid py-5">
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
                @foreach ($programs  as $program)
                    <div class="col-lg-3 col-md-6 pb-4">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                            href="{{ route('site.programs.courses' , $program->id) }}">
                            <img class="img-fluid" src="{{ getImageUrl($program->image) }}" alt="{{ $program->name }}" />
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3 pb-5">
                                    {{ $program->name }}
                                </h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Courses End  --}}
@endsection
