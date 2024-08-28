<div class="modal fade" id="{{ $modal }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
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


                            <!-- Plan Type -->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.rooms') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select name="rooms[]" id="room" class="form-control select2"  multiple="multiple" required style="width: 100% !important;">
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                                            @endforeach
                                        </select>
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
