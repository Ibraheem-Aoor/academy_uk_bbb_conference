@extends('layouts.admin.master')
@section('page-title', $page_title)
@section('content')
    <div class="modal fade" id="meeting-modal" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded shadow border-0">
                <form action="{{ $form_url }}" method="POST" class="custom-form">
                    <div class="modal-header border-bottom">
                        <img src="{{ asset('assets/common/logo.png') }}" alt="" width="15%"> &nbsp;
                        <h5 class="modal-title" id="modal-title">
                            {{ __('general.join_bbb_meeting', ['meeting' => $meeting->name]) }}</h5>
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
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                </div><!--end col-->

                            </div><!--end row-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('general.close') }}</button> --}}
                        <button type="submit" class="btn btn-primary">{{ __('general.join') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#meeting-modal').modal('show');
        });
    </script>
@endpush
