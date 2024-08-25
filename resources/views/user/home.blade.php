@extends('layouts.user.master')
@section('page-title', __('general.dashbaord'))
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h6 class="text-muted mb-1">Welcome back, {{ getAuthUser('web')->name }}</h6>
            <h5 class="mb-0">Recent Rooms </h5>
        </div>
    </div>

    <div class="row ">
        @foreach ($rooms as $room)
            <div class="col-lg-6 mt-4 order-md-1 order-lg-2 order-1">
                <div class="card border-0 shadow rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            {{-- <img src="{{  getImageUrl('assets/images/client/05.jpg')}}" class="avatar avatar-md-sm rounded-circle border shadow"
                        alt=""> --}}
                            <div class="flex-1 ms-2">
                                <h6 class="mb-0">{{ $room->name }}</h6>
                                @if (!$room->meetings->isEmpty())
                                    <small class="text-muted">Last Meeting at: {{ $room->getLastMeeting() }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="dropdown dropdown-primary">
                            <button type="button" class="btn btn-icon btn-soft-primary dropdown-toggle p-0"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="ti ti-dots-vertical"></i></button>
                            <div class="dropdown-menu dd-menu dropdown-menu-end shadow border-0 mt-3 py-3" style="">
                                <a class="dropdown-item text-dark" href="#" data-bs-toggle="modal"
                                    data-bs-target="#room-modal" data-name="{{ $room->name }}"
                                    data-action="{{ route('user.update_room', encrypt($room->id)) }}"><span
                                        class="mb-0 d-inline-block me-1">
                                        <i class="ti ti-settings"></i></span> Edit</a>
                                <a class="dropdown-item text-dark" href="#" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight"
                                    data-action="{{ route('user.update_room', encrypt($room->id)) }}"><span
                                        class="mb-0 d-inline-block me-1">
                                        <i class="ti ti-plus"></i></span> Quick Meeting</a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="javascript:void(0)" class="text-center" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight">
                            <img src="{{ asset('assets/common/create_meeting.png') }}" class="img-fluid rounded m-auto"
                                width="50%" alt="">
                        </a>
                    </div>

                    <div class="mt-4">
                        <div class="post-meta d-flex justify-content-between">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item me-2 mb-0" title="Max No of Participants"><a
                                        href="javascript:void(0)" class="text-muted like"><i
                                            class="ti ti-users me-1"></i>{{ $room->max_participants }}</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"
                                        title="Max No of Meetings"><i
                                            class="ti ti-video me-1"></i>{{ $room->max_meetings }}</a></li>
                            </ul>
                            <a href="javascript:void(0)" class="text-muted d-none"><i class="ti ti-share"></i></a>
                        </div>

                    </div>
                </div>


                <div class="mt-4 text-center d-none">
                    <span class="h6 mb-0">Loading.. <i class="mdi mdi-loading mdi-spin h4 mb-0 align-middle"></i></span>
                </div>
            </div>
        @endforeach
    </div><!--end row-->


    <div class="modal fade" id="room-modal" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded shadow border-0">
                <form class="custom-form" method="POST">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title" id="modal-title">{{ __('general.edit_room') }}</h5>
                        <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                                class="uil uil-times fs-4 text-dark"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="p-3 rounded box-shadow">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('general.name') }}<span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <input type="text" name="name" id="name" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('general.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('general.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#room-modal').on('show.bs.modal', function(e) {
            var btn = e.relatedTarget;
            var action = btn.getAttribute('data-action');
            $(this).find('form').attr('action', action);
            $(this).find('#name').val(btn.getAttribute('data-name'));
        });
    </script>
@endpush
