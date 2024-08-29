@extends('layouts.admin.master')
@section('page-title', __('general.dashboard'))

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h6 class="text-muted mb-1">Welcome back, {{ getAuthUser('admin')->name }}</h6>
            <h5 class="mb-0">Dashboard</h5>
        </div>
    </div>

    <div class="row row-cols-xl-3 row-cols-md-2 row-cols-1">

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-meeting-board fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3" onclick='window.location.href="{{ route('admin.meeting.index') }}"'>
                        <h6 class="mb-0 text-muted">My Meetings</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $meetings_count }}">{{ $meetings_count }}</span></p>
                    </div>
                </div>
            </a>
        </div><!--end col-->

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-users-alt fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">My Participants</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $participants_count }}">{{ $participants_count }}</span></p>
                    </div>
                </div>
            </a>
        </div><!--end col-->

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-user-circle fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">User Meetings</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $users_meeting_count }}">{{ $users_meeting_count }}</span></p>
                    </div>
                </div>
            </a>
        </div><!--end col-->

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-user-check fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">User Meeting Participants</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $user_meeting_participants_count }}">{{ $user_meeting_participants_count }}</span>
                        </p>
                    </div>
                </div>
            </a>
        </div><!--end col-->

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-building fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">User Meeting Rooms</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $user_room_count }}">{{ $user_room_count }}</span></p>
                    </div>
                </div>
            </a>
        </div><!--end col-->

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-user-md fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">User Room Managers</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $user_room_manager_count }}">{{ $user_room_manager_count }}</span></p>
                    </div>
                </div>
            </a>
        </div><!--end col-->

    </div><!--end row-->
@endsection
