$(document).on('click','.edit', function() {
    var $tr = $(this).closest('tr');
    var userId = $tr.find('td:eq(0)').text();
    var name = $tr.find('td:eq(1)').text();
    var password = $tr.find('td:eq(2)').text();
    var status = $tr.find('td:eq(3)').text();

    $('#updateUserId').val(userId);
    $('#updateUserName').val(name);
    $('#updateUserPassword').val(password);
    $('#updateUserStatus').val(status);

    $('#updateModal').modal('show');
});

// update user
$(document).on('click','.updateUserButton', function(e){
    e.preventDefault();
    var user_id = $('#updateUserId').val();
    var data = {
        'name': $('#updateUserName').val(),
        'password': $('#updateUserPassword').val(),
        'status': $('#updateUserStatus').val()
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "PUT",
        url: "/update-user/" + user_id,
        data: data,
        dataType: "json",
        success: function (response){
            console.log(response);
            $('#updateModal').modal('hide');
            location.reload();
        }
    });
});
