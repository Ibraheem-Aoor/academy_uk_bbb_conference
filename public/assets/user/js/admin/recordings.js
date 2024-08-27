$(document).ready(function () {
    // render The datatable if we are at a table page
    if (table_data_url !== 'undefined') {
        renderDataTable();
        setTimeout(function() {
            $('.dt-empty').html("No data available in table");
        }, 300);
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
            data: 'duration',
            name: 'duration',
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


// Quick Toggle is Active status from the table row
function toggleStatus(input) {
    var id = input.data('id');
    var route = input.data('route');
    var status = input.prop('checked') == true ? 1 : 0;
    $.get(route, {
        id: id,
        status: status,
    }, function (reseponse) {
        if (reseponse.status) {
            toastr.success(reseponse.message);
        } else {
            toastr.error(reseponse.message);
        }
    });
}



$(document).on('click', '.link-to-copy', function (e) {
    event.preventDefault();
    const link = this.getAttribute('data-url');

    // Create a temporary input element
    const tempInput = document.createElement('input');
    tempInput.value = link;
    document.body.appendChild(tempInput);

    // Select the text
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text to clipboard
    document.execCommand('copy');

    // Remove the temporary input element
    document.body.removeChild(tempInput);

    // Optionally, you can show a message to the user indicating the link was copied
    alert('Link copied to clipboard!');
});
