<div class="modal fade " id="{{ $modal }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
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
                                        <input type="text" name="name" id="name" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.email') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="email" id="email" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-8">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.password') }}<span
                                            class="text-danger"></span></label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="password" id="password" class="form-control">
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.generate') }}<span
                                            class="text-danger"></span></label>
                                    <div class="form-icon position-relative">
                                        <button type="button" class="btn btn-primary"
                                            id="generate-password">GENERATE</button>
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <h4>{{ __('general.plan_settings') }}</h4>
                                </div>
                            </div><!--end col-->

                            <!-- Plan Type -->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.plan.type') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select name="type" id="type" class="form-control">
                                            @foreach ($plan_types as $planType)
                                                <option value="{{ $planType->value }}">{{ $planType->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div><!--end col-->


                            <!-- Max Storage Allowed -->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.plan.max_storage_allowed') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="number" name="max_storage_allowed" id="max_storage_allowed"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <!-- Max Parallel Rooms -->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.plan.parallel_rooms') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="number" name="parallel_rooms" id="parallel_rooms"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div><!--end col-->

                            <!-- Backup Enabled -->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.plan.is_backup_enabled') }}</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_backup_enabled"
                                            name="is_backup_enabled">
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
