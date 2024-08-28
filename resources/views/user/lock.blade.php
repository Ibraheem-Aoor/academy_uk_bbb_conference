@extends('layouts.user.master')
@section('content')
    <!-- Hero Start -->
    <section class="bg-home bg-light d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="text-center">
                        <div class="icon d-flex align-items-center justify-content-center bg-soft-primary rounded-circle mx-auto"
                            style="height: 90px; width:90px;">
                            <i class="uil uil-lock align-middle h1 mb-0"></i>
                        </div>
                        <h1 class="my-4 fw-bold">Account Locked</h1>
                        <p class="text-muted para-desc mx-auto">{{ $message }}</p>
                        {{-- <a href="index.html" class="btn btn-soft-primary mt-3">Go To Home</a> --}}
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div> <!--end container-->
    </section><!--end section-->
    <!-- Hero End -->
@endsection
