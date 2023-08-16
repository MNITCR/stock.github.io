$(document).on('click','.edit', function() {
    var $tr = $(this).closest('tr');
    var catId = $tr.find('td:eq(0)').text();
    var title = $tr.find('td:eq(1)').text();
    var title_kh = $tr.find('td:eq(2)').text();
    var des = $tr.find('td:eq(3)').text();

    console.log(catId);
    $('#catid').val(catId);
    $('#title').val(title);
    $('#title_kh').val(title_kh);
    $('#descript').val(des);

    $('#FormEdit').modal('show');
});

// update user
$(document).on('click','#btnEdit', function(e){
    e.preventDefault();
    var cat_id = $('#catid').val();
    var data = {
        'title': $('#title').val(),
        'titlekh': $('#title_kh').val(),
        'desciption': $('#descript').val()
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "PUT",
        url: "/edit-cat/" + cat_id,
        data: data,
        dataType: "json",
        success: function (response){
            console.log(response);
            // $('#FormEdit').modal('hide');
            // location.reload();
        }
    });
});
