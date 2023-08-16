$(document).ready(function() {
    // Add More button click event
    $('#addMoreButton').click(function() {
        var inputSet = `
            <div class="d-flex align-items-center gap-3 input-set mt-3 mb-3">
                <label class="form-label m-auto align-items-center">Name</label>
                <input type="text" class="form-control" placeholder="Name">
                <label class="form-label m-auto align-items-center">Password</label>
                <input type="password" class="form-control" placeholder="Password">
                <label class="form-label m-auto align-items-center">Status</label>
                <select class="form-select" aria-label="Disabled select example">
                    <option value="Active">Active</option>
                    <option value="InActive">Inactive</option>
                </select>
                <button type="button" class="btn btn-danger btn-sm remove-input">Remove</button>
            </div>
        `;
        $('#AddForm').append(inputSet);
    });

    // Remove button click event for dynamically added input sets
    $('#AddForm').on('click', '.remove-input', function() {
        $(this).closest('.input-set').remove();
    });

    // Submit button click event
    $('#AddUserButton').click(function() {
        var usersData = [];
        // Loop through each input set and retrieve data
        $('.input-set').each(function() {
            var name = $(this).find('input:eq(0)').val();
            var password = $(this).find('input:eq(1)').val();
            var status = $(this).find('select').val();
            // Check for empty fields
            if (name === '' || password === '' || status === '') {
                hasEmptyFields = true;
                alert('Please input filled');
                return false;
            }
            // store array data
            usersData.push({
                name: name,
                password: password,
                status: status
            });
            // Process the data or send it via AJAX
            console.log(name, password, status);
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'insert-users',
            data: {
                usersData: usersData
            },
            dataType: 'json',
            success: function(response) {
                console.log(response.message);
                $('#AddModal').modal('hide');
                location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error inserting users:', textStatus, errorThrown);
            }
        });
    });
});

