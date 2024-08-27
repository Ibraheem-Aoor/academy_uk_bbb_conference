<div class="modal fade modal-lg" id="{{ $room_modal }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <form name="user-rooms-form" id="user-rooms-form" class="custom-form" method="POST">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 rounded box-shadow">
                        <table class="table" id="roomTable">
                            <thead>
                                <tr>
                                    <th>{{ __('general.name') }}</th>
                                    <th>{{ __('general.plan.max_meetings') }}</th>
                                    <th>{{ __('general.plan.max_participants') }}</th>
                                    <th>{{ __('general.plan.max_storage_allowed') }}</th>
                                    <th>{{ __('general.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be added here dynamically -->
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" id="addRowBtn">{{ __('general.add') }}</button>
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
