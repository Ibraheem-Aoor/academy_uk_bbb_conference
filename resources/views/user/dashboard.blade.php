@extends('layouts.user.master')
@section('page-title', __('general.dashbaord'))
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h6 class="text-muted mb-1">Welcome back, {{ getAuthUser('web')->name }}</h6>
            <h5 class="mb-0">Dashboard</h5>
        </div>
    </div>

    <div class="row ">
        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-camera fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3" onclick='window.location.href="{{ route('user.meeting.index') }}"'>
                        <h6 class="mb-0 text-muted">Meetings</h6>
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
                        <i class="uil uil-user-circle fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3" onclick='window.location.href="{{ route('user.meeting.index') }}"'>
                        <h6 class="mb-0 text-muted">Participants</h6>
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
                        <i class="uil uil-arrow-right fs-4 mb-0 text-success"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">Successfull Joins</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $successfull_joins }}">{{ $successfull_joins }}</span></p>
                    </div>
                </div>
            </a>
        </div><!--end col-->

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-lock fs-4 mb-0 text-danger"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">Failed Joins</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $failed_joins }}">{{ $failed_joins }}</span></p>
                    </div>
                </div>
            </a>
        </div><!--end col-->
    </div><!--end row-->

    {{-- Statistics & upcoming activities --}}
    <div class="row">
        <div class="col-xl-8 col-lg-7 mt-4">
            <div class="card shadow border-0 p-4 pb-0 rounded">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0 fw-bold">Quick Analytics</h6>

                    <div class="mb-0 position-relative d-none">
                        <select class="form-select form-control" id="yearchart">
                            <option selected>2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                        </select>
                    </div>
                </div>
                <div id="dashboard" class="apex-chart"></div>
            </div>
        </div><!--end col-->

        <div class="col-xl-4 col-lg-5 mt-4 rounded">
            <div class="card shadow border-0">
                <div class="p-4 border-bottom">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Upcoming Activity</h6>

                        <a href="{{ route('user.meeting.index') }}" class="text-primary">See More <i
                                class="uil uil-arrow-right align-middle"></i></a>
                    </div>
                </div>

                <div class="p-4" data-simplebar style="height: 365px;">
                    @foreach ($upcoming_meetings as $meeting)
                        <a href="javascript:void(0)"
                            class="features feature-primary key-feature d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="icon text-center rounded-circle me-3">
                                    <i class="ti ti-users"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-dark">{{ $meeting->name }}</h6>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($meeting->start_date)->isToday()
                                            ? 'Today ' . \Carbon\Carbon::parse($meeting->start_time)->format('g:i A')
                                            : (\Carbon\Carbon::parse($meeting->start_date)->isTomorrow()
                                                ? 'Tomorrow ' . \Carbon\Carbon::parse($meeting->start_time)->format('g:i A')
                                                : \Carbon\Carbon::parse($meeting->start_date . ' ' . $meeting->start_time)->format('F j, Y g:i A')) }}
                                    </small>
                                </div>
                            </div>

                            <i class="ti ti-arrow-right text-primary btn-sm btn-soft-primary"
                                onclick='window.location.href="{{ route('site.user.join_public_meeting', $meeting->meeting_id) }}"'></i>

                        </a>
                    @endforeach


                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
    <div class="col-xl-12    mt-4">
        <div class="card border-0">
            <div class="d-flex justify-content-between p-4 shadow rounded-top">
                <h6 class="fw-bold mb-0">Invitations List</h6>

                <ul class="list-unstyled mb-0 d-none">
                    <li class="dropdown dropdown-primary list-inline-item">
                        <button type="button" class="btn btn-icon btn-pills btn-soft-primary dropdown-toggle p-0"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="ti ti-dots-vertical"></i></button>
                        <div class="dropdown-menu dd-menu dropdown-menu-end shadow border-0 mt-3 py-3">
                            <a class="dropdown-item text-dark" href="#"> Paid</a>
                            <a class="dropdown-item text-dark" href="#"> Unpaid</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="table-responsive shadow rounded-bottom" data-simplebar style="height: 545px;">
                <table class="table table-center bg-white mb-0">
                    <thead>
                        <tr>
                            <th class="border-bottom p-3">No.</th>
                            <th class="border-bottom p-3" style="min-width: 220px;">Name</th>
                            <th class="text-center border-bottom p-3">E-mail</th>
                            <th class="text-center border-bottom p-3" style="min-width: 150px;">Meeting</th>
                            <th class="text-center border-bottom p-3" style="min-width: 150px;">Date</th>
                            <th class="text-center border-bottom p-3" style="min-width: 150px;">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Start -->
                        @foreach ($upcoming_meetings as $meeting)
                            @foreach ($meeting->participants->whereNotNull('email') as $participant)
                                <tr>
                                    <th class="p-3">#</th>
                                    <td class="p-3">
                                        <a href="#" class="text-primary">
                                            <div class="d-flex align-items-center">
                                                <span class="ms-2">{{ $participant->name }}</span>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center p-3">{{ $participant->email }}</td>
                                    <td class="text-center p-3">{{ $participant->meeting->name }}</td>
                                    <td class="text-center p-3">{{ $participant->meeting->start_date }}</td>
                                    <td class="text-center p-3">
                                        <div class="badge bg-soft-success rounded px-3 py-1">
                                            Invited Via Email
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        <!-- End -->
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->

@endsection

@push('js')
    <script src="{{ asset('assets/user/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const meetingsData = @json($monthly_meetings);
            const participantsData = @json($monthly_participants);

            var options = {
                series: [{
                    name: 'Meetings',
                    data: meetingsData
                }, {
                    name: 'Participants',
                    data: participantsData
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    width: [0, 4]
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [1]
                },
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                xaxis: {
                    type: 'month'
                },
                yaxis: [{
                    title: {
                        text: 'Meetings'
                    },

                }, {
                    opposite: true,
                    title: {
                        text: 'Participants'
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#dashboard"), options);
            chart.render();
        });
    </script>
@endpush
