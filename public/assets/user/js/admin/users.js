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
            3,
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
            data: 'email',
            name: 'email',
            searchable: true,
            orderable: true,
        },
        {
            data: 'status',
            name: 'status',
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

$(modal).on('show.bs.modal', function (e) {
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
        $("#modal-title").text(btn.getAttribute('data-header-title'));
        // $('.image-input-wrapper').css('background-image', 'url("' + btn.getAttribute('data-image') + '")');
        $(this).find('#name').val(btn.getAttribute('data-name'));
        $(this).find('#email').val(btn.getAttribute('data-email'));
        $(this).find('#type').val(btn.getAttribute('data-plan-type'));
        $(this).find('#max_meetings').val(btn.getAttribute('data-plan-max-meetings'));
        $(this).find('#max_participants').val(btn.getAttribute('data-plan-max-participants'));
        $(this).find('#max_storage_allowed').val(btn.getAttribute('data-plan-max-storage'));
        var status = btn.getAttribute('data-plan-is-backup-enabled') == 1 ? 'checked' : null;
        $(this).find('#is_backup_enabled').prop('checked', status);
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




document.getElementById('generate-password').addEventListener('click', function () {
    // Characters and numbers for the password
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let password = '';

    // Generate an 8-character long password
    for (let i = 0; i < 8; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        password += characters[randomIndex];
    }

    // Place the generated password in the input field
    document.getElementById('password').value = password;
});