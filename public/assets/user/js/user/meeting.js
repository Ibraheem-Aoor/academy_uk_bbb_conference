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
            data: 'room',
            name: 'room',
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


function toggleHidableElement(input) {
    if (input.prop('checked')) {
        $('.hidable').removeClass('d-none');
    } else {
        $('.hidable').addClass('d-none');
    }

}


let userTable = document.getElementById('userTable').getElementsByTagName('tbody')[0];
let addRowBtn = document.getElementById('addRowBtn');

addRowBtn.addEventListener('click', function () {
    addRow();
});

function addRow(data = {}) {
    let index = userTable.rows.length;
    let newRow = userTable.insertRow();
    newRow.innerHTML = `
        <tr>
            <td><input type="text" name="participants[${index}][name]" class="form-control" value="${data.name || ''}" required></td>
            <td><input type="text" name="participants[${index}][email]" class="form-control" value="${data.email || ''}" ></td>
            <td>
                <select name="participants[${index}][role]" class="form-control" required>
                    <option value="MODERATOR" ${data.role === 'MODERATOR' ? 'selected' : ''}>Moderator</option>
                    <option value="VIEWER" ${data.role === 'VIEWER' ? 'selected' : ''}>Viewer</option>
                </select>
            </td>
            <td><input type="checkbox" name="participants[${index}][is_guest]" value="1" ${data.is_guest ? 'checked' : ''}></td>
            <td><input type="text" name="participants[${index}][password]" class="form-control" value="${data.bridge_password || ''}" ></td>
            <td><button type="button" class="btn btn-danger removeRowBtn">Remove</button></td>
            <input type="hidden" name="participants[${index}][id]" value="${data.id || ''}">
        </tr>
    `;
    newRow.querySelector('.removeRowBtn').addEventListener('click', function () {
        newRow.remove();
    });
}

// Function to populate the modal with existing participants
function populateModal(participants) {
    userTable.innerHTML = '';
    participants.forEach(participant => addRow(participant));
}

// Event listener for the edit button
function fetchParticipants(src) {
    const fetchUrl = src.getAttribute('data-fetchUrl');
    const actionUrl = src.getAttribute('data-actionUrl');

    fetch(fetchUrl)
        .then(response => response.json())
        .then(data => {
            populateModal(data.participants);
            const form = document.getElementById('meeting-users-form');
            form.setAttribute('action', actionUrl);
        })
        .catch(error => console.error('Error:', error));
}
