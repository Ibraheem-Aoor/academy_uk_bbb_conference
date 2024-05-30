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
            4,
            'desc'
        ]],
    });
}

function getTableColumns() {
    return [
        {
            data: 'id',
            name: 'id',
            searchable: true,
            orderable: true,
        },
        {
            data: 'name',
            name: 'name',
            searchable: true,
            orderable: true,
        },

        {
            data: 'email',
            name: 'email',
            searchable: true,
            orderable: true,
        },
        {
            data: 'subject',
            name: 'subject',
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
 * Project Info modal
 */

$('#contact-modal').on('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    $(this).find('textarea').text(btn.getAttribute('data-message'));
});

// Quick Toggle is Active status from the table row
function toggleStatus(input) {
    var id = input.data('id');
    var route = input.data('route');
    var is_active = input.prop('checked') == true ? 1 : 0;
    $.get(route, {
        id: id,
        is_active: is_active,
    }, function (reseponse) {
        if (reseponse.status) {
            toastr.success(reseponse.message);
        } else {
            toastr.error(reseponse.message);
        }
    });
}

