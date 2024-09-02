@extends('layouts.user.master')
@section('page-title', __('general.meetings'))
@section('content')



    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-md-flex justify-content-between align-items-center">
                <h5 class="mb-0">Subscription Plan</h5>

                <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">
                    <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                        <li class="breadcrumb-item text-capitalize"><a href="{{ route('user.home') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">Subscription Plan</li>
                    </ul>
                </nav>
            </div>

            <div class="row justify-content-center d-none">
                <div class="col-12 text-center">
                    <div class="switcher-pricing d-flex justify-content-center align-items-center">
                        <label class="toggler text-muted toggler--is-active" id="filt-monthly">Monthly</label>
                        <div class="form-check form-switch mx-3">
                            <input class="form-check-input" type="checkbox" id="switcher">
                        </div>
                        <label class="toggler text-muted" id="filt-yearly">Yearly</label>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row">
                @foreach ($rooms as $room)
                    <div class="col-4 m-auto">
                        <div id="yearly" class="wrapper-full ">
                            <div class="row ">
                                <div class="col-12 mt-4">
                                    <div class="card pricing-rates business-rate shadow border-0 rounded">
                                        <div class="ribbon ribbon-right ribbon-{{ $room->status ? 'success' : 'danger' }} overflow-hidden d-none"><span
                                                class="text-center d-block shadow small h6">{{ $room->getAtiveToString() }}</span></div>
                                        <div class="card-body">
                                            <h6 class="title fw-bold text-uppercase text-primary mb-4">{{ $room->name }}
                                            </h6>
                                            <div class="d-flex mb-4 d-none">
                                                <span class="h4 mb-0 mt-2">$</span>
                                                <span class="price h1 mb-0">139</span>
                                                <span class="h4 align-self-end mb-1">/mo</span>
                                            </div>

                                            <ul class="list-unstyled mb-0 ps-0">
                                                {{-- <li class="h6 text-muted mb-0"><span class="text-primary h5 me-2"><i
                                                            class="uil uil-check-circle align-middle"></i></span>{{ $user->rooms->count() }}
                                                    Rooms
                                                </li> --}}
                                                {{-- <li class="h6 text-muted mb-0"><span class="text-primary h5 me-2"><i
                                                            class="uil uil-check-circle align-middle"></i></span>{{ $plan->parallel_rooms }}
                                                    Paralell Rooms
                                                </li> --}}
                                                <li class="h6 text-muted mb-0"><span class="text-primary h5 me-2"><i
                                                            class="uil uil-check-circle align-middle"></i></span>{{ $room->max_meetings }}
                                                    Meetings</li>
                                                <li class="h6 text-muted mb-0"><span class="text-primary h5 me-2"><i
                                                            class="uil uil-check-circle align-middle"></i></span>{{ $room->max_participants }}
                                                    Participants</li>
                                                <li class="h6 text-muted mb-0"><span class="text-primary h5 me-2"><i
                                                            class="uil uil-check-circle align-middle"></i></span>{{ $room->max_storage_allowed }}
                                                    GB Storage</li>

                                                <li class="h6 text-muted mb-0 @if($room->end_date == today()->toDateString()) text-danger @endif"><span class="text-primary h5 me-2"><i
                                                            class="uil uil-check-circle align-middle"></i></span>Expiry Date: {{ $room->end_date }}
                                                    </li>
                                                @if ($plan->is_backup_enabled)
                                                    <li class="h6 text-muted mb-0"><span class="text-primary h5 me-2"><i
                                                                class="uil uil-check-circle align-middle"></i></span>Auto
                                                        Backup
                                                    </li>
                                                @endif
                                            </ul>
                                            <a href="javascript:void(0)" class="btn btn-primary mt-4 d-none">Get Started</a>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div><!--end col-->
                @endforeach
            </div><!--end row-->
        </div>
    </div><!--end container-->


@endsection
