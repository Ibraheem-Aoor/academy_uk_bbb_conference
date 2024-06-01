@extends('layouts.admin.master')
@section( 'page-title',__('general.dashbaord'))
@section('content')
<div class="d-flex align-items-center justify-content-between">
    <div>
        <h6 class="text-muted mb-1">Welcome back, {{ getAuthUser('admin')->name }}</h6>
        <h5 class="mb-0">Dashboard</h5>
    </div>
</div>

<div class="row row-cols-xl-5 row-cols-md-2 row-cols-1">
    <div class="col mt-4">
        <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
            <div class="d-flex align-items-center">
                <div class="icon text-center rounded-pill">
                    <i class="uil uil-user-circle fs-4 mb-0"></i>
                </div>
                <div class="flex-1 ms-3" onclick='window.location.href="{{ route("admin.meeting.index") }}"'>
                    <h6 class="mb-0 text-muted">Meetings</h6>
                    <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $meetings_count }}">{{ $meetings_count }}</span></p>
                </div>
            </div>

        </a>
    </div><!--end col-->

    <div class="col mt-4">
        <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
            <div class="d-flex align-items-center">
                <div class="icon text-center rounded-pill">
                    <i class="uil uil-user-circle fs-4 mb-0"></i>
                </div>
                <div class="flex-1 ms-3" onclick='window.location.href="{{ route("admin.meeting.index") }}"'>
                    <h6 class="mb-0 text-muted">Participants</h6>
                    <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $participants_count }}">{{ $participants_count }}</span></p>
                </div>
            </div>

        </a>
    </div><!--end col-->
</div><!--end row-->


@endsection
