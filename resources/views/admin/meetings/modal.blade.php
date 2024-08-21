<div class="modal fade" id="meeting-modal" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <form name="meeting-form" class="custom-form">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="modal-title"></h5>
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
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.welcome_message') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="welcome_message" class="form-control" required>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12 d-none">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.password') }}<span
                                            class="text-danger"></span></label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="password" class="form-control">
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.max_particpants') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="number" name="max_participants" class="form-control" required>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.is_scheduled') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            name="is_scheduled"
                                            onchange="toggleHidableElement($(this));"
                                         >
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6 hidable d-none">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.start_date') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6 hidable d-none">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.start_time') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="time" name="start_time" class="form-control"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6 hidable d-none">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.end_date') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ now()->tomorrow()->toDateString() }}" required>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6 hidable d-none">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.end_time') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="time" name="end_time" class="form-control"
                                            value="{{ now()->tomorrow()->toDateString() }}" required>
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
