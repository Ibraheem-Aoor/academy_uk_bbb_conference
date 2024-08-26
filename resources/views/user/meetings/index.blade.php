@extends('layouts.user.master')
@section('page-title', __('general.meetings'))
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
    <style>
        div.dt-container .dt-paging .dt-paging-button.current,
        div.dt-container .dt-paging .dt-paging-button.current {
            color: #fff !important;
            background: #2f55d4 !important;
            border-color: #2f55d4 !important;
            cursor: not-allowed !important;
        }

        div.dt-container .dt-paging .dt-paging-button {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        div.dt-container .dt-paging .dt-paging-button:hover {
            color: #fff;
            background: rgba(47, 85, 212, .9);
            border-color: rgba(47, 85, 212, .9);
        }
    </style>
@endpush
@section('content')
    @include('user.partials.page_header', [
        'current_page_name' => __('general.meetings'),
        'sub_pages' => [
            __('general.meetings') => route('user.meeting.index'),
        ],
    ])
    {{-- Table Extra actions --}}
    <div class="d-md-flex justify-content-between align-items-center mt-2">
        <h5 class="mb-0">&nbsp;</h5>
        <nav aria-label="breadcrumb" class="d-inline-block">
            <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                <li class="breadcrumb-item text-capitalize">
                    <a class="btn btn-md btn-primary text-white m-1" data-bs-toggle="modal" data-bs-target="#meeting-modal"
                        data-action="{{ route($route . '.store') }}" data-method="POST" data-is-create="1"
                        data-header-title= "{{ __('general.create_new_meeting') }}">{{ __('general.new') }}</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 mt-4">
            <div class="card rounded shadow">
                <div class="p-4 border-bottom">
                    <h5 class="title mb-0">{{ __('general.meetings') }}</h5>
                </div>
                <div class="p-4">
                    <div class="table-responsive shadow rounded p-4">
                        <table class="table table-center bg-white mb-0 table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    {{-- <th class="border-bottom p-3" style="min-width: 220px;">
                                        {{ __('general.number') }}</th> --}}
                                    <th class="border-bottom p-3">{{ __('general.name') }}</th>
                                    <th class="text-center border-bottom p-3" style="min-width: 200px;">
                                        {{ __('general.room') }}
                                    </th>
                                    <th class="text-center border-bottom p-3" style="min-width: 200px;">
                                        {{ __('general.meeting_id') }}
                                    </th>
                                    </th>
                                    <th class="text-center border-bottom p-3">{{ __('general.status') }}</th>
                                    <th class="text-center border-bottom p-3">{{ __('general.date') }}</th>
                                    {{-- actions --}}
                                    <th class="text-end border-bottom p-3" style="min-width: 200px;">
                                        {{ __('general.actions') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->



    {{-- UpdateOrCreate Modal --}}
    @include('user.meetings.modal')
    @include('user.meetings.user_modal')
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        const table_data_url = "{{ $table_data_url }}";
    </script>
    @if (getCurrentLocale() == 'ar')
        <script src="{{ asset('assets/user/js/datatable-ar.js') }}"></script>
    @else
        <script src="{{ asset('assets/user/js/datatable-en.js') }}"></script>
    @endif
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="{{ asset('assets/user/js/user/meeting.js') }}?v=0.04"></script>

@endpush
