<div class="modal fade" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form name="confirm-delete-form" id="confirm-delete-form">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('general.Caution') }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light"
                        data-bs-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="submit" class="btn btn-outline-light">{{ __('general.delete') }}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
