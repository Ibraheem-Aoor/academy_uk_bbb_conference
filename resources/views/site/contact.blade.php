@extends('layouts.site.master')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endpush
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row mb-5">
                <div class="card border-light mb-3" style="max-width: 16rem; height: 200px;">

                    <div class="card-header"><i class="fa fa-map-marker-alt mr-2"></i>Britain</div>
                    <div class="card-body" style="height:300px;">

                        <p class="card-text">United Kingdom: Suite 3, 17 Universal Square Business Center, M12 6JH</p>
                        <p class="card-text">00447745760134</p>

                    </div>
                </div>
                <div class="card border-light mb-3" style="max-width: 16rem; height: 200px;">

                    <div class="card-header"><i class="fa fa-map-marker-alt mr-2"></i>Amman</div>
                    <div class="card-body" style="height:300px;">

                        <p class="card-text">3rd Floor Muneer Complex 383 Rania Road Amman Jordan</p>
                        <p class="card-text">00962792729988</p>

                    </div>
                </div>
                <div class="card border-light mb-3" style="max-width: 16rem; height: 200px;">

                    <div class="card-header"><i class="fa fa-map-marker-alt mr-2"></i>Egypt</div>
                    <div class="card-body" style="height:300px;">

                        <p class="card-text">Dr. El Sobky Street,Beside the Naval Academy</p>
                        <p class="card-text">00201008653722</p>

                    </div>
                </div>
                <div class="card border-light mb-3" style="max-width: 16rem; height: 200px;">

                    <div class="card-header"><i class="fa fa-map-marker-alt mr-2"></i>Palestine</div>
                    <div class="card-body" style="height:300px;">

                        <p class="card-text">Al-Karama district , Al-Naser Street </p>
                        <p class="card-text">0097297683328</p>

                    </div>
                </div>

            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="bg-light d-flex flex-column justify-content-center px-5" style="height: 450px;">
                        <div class="d-flex align-items-center mb-5">
                            <div class="btn-icon bg-primary mr-4">
                                <i class="fa fa-2x fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Our Location</h4>
                                <p class="m-0">3rd Floor Muneer Complex 383 Rania Road Amman Jordan</p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/user/js/user/master.js') }}"></script>
@endpush
