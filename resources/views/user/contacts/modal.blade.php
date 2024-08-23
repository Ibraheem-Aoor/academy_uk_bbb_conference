<div class="modal fade" id="contact-modal" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <form name="contact-form" class="custom-form">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 rounded box-shadow">
                        <d class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.message') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <textarea class="form-control" cols="30" rows="10" readonly></textarea>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </d iv><!--end row-->
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
