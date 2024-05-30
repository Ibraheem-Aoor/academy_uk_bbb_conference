$(document).ready(function () {
    // render The datatable if we are at a table page
    if (table_data_url !== 'undefined') {
        renderDataTable();
    }
  

});

/**
    * render Datatable
    */
function renderDataTable() {
    $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        language: language,
        ajax: table_data_url,
        columns: getTableColumns(),
        order: [[
            2,
            'desc'
        ]],
    });
}

function getTableColumns() {
    return [
        {
            data: 'name',
            name: 'name',
            searchable: true,
            orderable: true,
        },
        {
            data: 'meeting_id',
            name: 'meeting_id',
            searchable: true,
            orderable: true,
        },
        {
            data: 'created_at',
            name: 'created_at',
            searchable: true,
            orderable: true,
        },
        {
            data: 'actions',
            name: 'actions',
            searchable: false,
            orderable: false,
        },
    ];
}



/**
 * Meeting Modal
 */

$('#meeting-modal').on('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    var action = btn.getAttribute('data-action');
    var method = btn.getAttribute('data-method');
    var isCreate = btn.getAttribute('data-is-create');
    $(this).find('form').attr('action', action);
    $(this).find('form').attr('method', method);
    // create or update
    if (isCreate == 1) {
        $("#modal-title").text(btn.getAttribute('data-header-title'));
        $('form[name="meeting-form"]')[0].reset();
    } else {
        // $("#modal-title").text(btn.getAttribute('data-header-title'));
        // $('.image-input-wrapper').css('background-image', 'url("' + btn.getAttribute('data-image') + '")');
        // $(this).find('#name').val(btn.getAttribute('data-name'));
        // var status = btn.getAttribute('data-status') == 1 ? 'checked' : null;
        // $(this).find('#status').prop('checked', status);
    }
});
/**
 * Project Info modal
 */

$('#add-meeting-users-modal').on('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    var action = btn.getAttribute('data-action');
    var method = btn.getAttribute('data-method');
    var isCreate = btn.getAttribute('data-is-create');
    $(this).find('form').attr('action', action);
    $(this).find('form').attr('method', method);
    $(this).find("#modal-title").text(btn.getAttribute('data-header-title'));
    // create or update
    if (isCreate == 1) {
        $('form[name="meeting-users-form"]')[0].reset();
    } else {
        $('.image-input-wrapper').css('background-image', 'url("' + btn.getAttribute('data-image') + '")');
        $(this).find('#name').val(btn.getAttribute('data-name'));
        var status = btn.getAttribute('data-status') == 1 ? 'checked' : null;
        $(this).find('#status').prop('checked', status);
    }
});


