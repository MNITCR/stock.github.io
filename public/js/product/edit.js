$(document).on('click','.editPro', function() {
    var $tr = $(this).closest('tr');
    var proId = $tr.find('td:eq(0)').text();
    var bCode = $tr.find('td:eq(1)').text();
    var Title = $tr.find('td:eq(2)').text();
    var Qty = $tr.find('td:eq(3)').text();
    var Price = $tr.find('td:eq(4)').text().replace('$','').trim();
    var CateTitle = $tr.find('td:eq(7)').text();
    
    $('#ProId').val(proId);
    $('#barcode').val(bCode);
    $('#title').val(Title);
    $('#qty').val(Qty);
    $('#price').val(Price);

    // Fetch categories and populate select
    $.ajax({
        type: 'GET',
        url: 'get-categories',
        dataType: 'json',
        success: function(categories) {
            var selectOptions = '';

            categories.forEach(function(category) {
                if (category.title == CateTitle) {
                    selectOptions += '<option value="' + category.catid + '" selected>' + category.title + '</option>';
                } else {
                    selectOptions += '<option value="' + category.catid + '">' + category.title + '</option>';
                }
            });

            // Update the select options after fetching the categories
            $('#cate').html(selectOptions);

            // Show the modal after updating the select
            $('#updatePro').modal('show');
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error('Error fetching categories:', textStatus, errorThrown);
        }
    });
});


// update data
$(document).on('click','.UpdateButton', function(e){
    e.preventDefault();
    var user_id = $('#ProId').val();
    var data = {
        'barcode': $('#barcode').val(),
        'title': $('#title').val(),
        'qty': $('#qty').val(),
        'price': $('#price').val(),
        'categoryid': $('#cate').val() // Make sure this matches the field name in your server-side code
    };
    console.log('Data to be sent:', data); // Debugging statement
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "PUT",
        url: "/update-pro/" + user_id,
        data: data,
        dataType: "json",
        success: function (response){
            console.log('Response:', response); // Debugging statement
            $('#updatePro').modal('hide');
            window.location.reload();
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error('Error updating:', textStatus, errorThrown);
            // Optionally, you can handle error feedback to the user here
        }
    });
});

