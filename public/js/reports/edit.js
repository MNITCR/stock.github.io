$(document).ready(function(){
    $(document).on('click', '.editrep', function() {
        var $tr = $(this).closest('tr');
        var repId = $tr.find('td:eq(0)').text();
        var prCode = $tr.find('td:eq(1)').text();
        var dsc = $tr.find('td:eq(2)').text();
        var tax = $tr.find('td:eq(3)').text();
        var total = $tr.find('td:eq(4)').text();
        var grandtotal = $tr.find('td:eq(5)').text().replace('$','').trim();
        var date = $tr.find('td:eq(6)').text();

        $('#poid').val(repId);
        $('#procode').val(prCode);
        $('#dsc').val(dsc);
        $('#tax').val(tax);
        $('#total').val(total);
        $('#grandtotal').val(grandtotal);
        $('#date').val(date);

        // Show your update form or modal here
        $('#FormEditrep').modal('show');
    });

    $(document).on('click', '.btnEditrep', function(e) {
        e.preventDefault();

        var repId = $('#poid').val();
        console.log(repId);
        var data = {
            'pocode': $('#procode').val(),
            'dis': $('#dsc').val(),
            'tax': $('#tax').val(),
            'total': $('#total').val(),
            'grand_total': $('#grandtotal').val(),
            'date': $('#date').val()
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'PUT',
            url: '/update-rep/' + repId,
            data: data,
            dataType: 'json',
            success: function(response) {
                console.log(response.message);
                location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error updating record:', textStatus, errorThrown);
            }
        });
    });

});
