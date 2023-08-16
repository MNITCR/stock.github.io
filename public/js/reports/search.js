$(document).ready(function() {
    // search data from date to date
    $('.Search').click(function() {
        var fromDate = $('#search_from').val();
        var toDate = $('#search_to').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: 'search-reports',
            data: { from_date: fromDate, to_date: toDate },
            dataType: 'json',
            success: function(response) {
                var tbody = $('#rep_data tbody');
                tbody.empty();

                if (response.data.length > 0) {
                    response.data.forEach(function(item) {
                        var deleteURL = "/delete-rep/" + item.poid;
                        var deleteForm = `
                            <form class="d-inline delete-form" action="${deleteURL}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-sm delete" onclick="confirmDelete('${deleteURL}')">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </form>
                        `;

                        var row = '<tr class="rep_row">' +
                            '<td class="d-none">'+item.poid+'</td>'+
                            '<td>' + item.pocode + '</td>' +
                            '<td>' + item.dis + '</td>' +
                            '<td>' + item.tax + '</td>' +
                            '<td>' + item.total + '</td>' +
                            '<td>' + item.grand_total + '</td>' +
                            '<td>' + item.date + '</td>' +
                            '<td>' +
                            '<button class="btn btn-sm editrep"><i class="fa-solid fa-file-pen text-primary"></i></button>' +
                            '<button class="btn btn-sm view" data-id="' + item.poid + '"><i class="fa-solid fa-eye text-info"></i></button>' +
                            '<button class="btn btn-sm print"><i class="fa-solid fa-print text-success"></i></button>' +
                            deleteForm +
                            '</td>' +
                            '</tr>';
                        tbody.append(row);
                    });
                } else {
                    tbody.empty();
                    tbody.append('<tr><td colspan="7" class="text-center text-danger">No data found</td></tr>');
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error fetching data:', textStatus, errorThrown);
            }
        });
    });

    // view the content
    $(document).on('click', '.view', function() {
        // alert('HIii');
        var productId = $(this).data('id'); // Get the product ID from the data-id attribute
        console.log(productId);
        $.ajax({
            type: 'GET',
            url: 'get-prodetail/' + productId, // Replace with your route or URL
            dataType: 'json',
            success: function(response) {
                var modalTbody = $('#podtail_data tbody');
                var modalPagination = $('#modal-pagination ul');
                modalTbody.empty();
                modalPagination.empty();

                var rowsPerPage = 5; // Number of rows per page
                var totalRows = response.data.length;

                if (totalRows > 0) {
                    var pageCount = Math.ceil(totalRows / rowsPerPage);

                    for (var i = 0; i < pageCount; i++) {
                        var startIndex = i * rowsPerPage;
                        var endIndex = startIndex + rowsPerPage;
                        var slicedData = response.data.slice(startIndex, endIndex);

                        var rowHtml = '';
                        slicedData.forEach(function(item) {
                            rowHtml += '<tr>' +
                                '<td>' + item.poid + '</td>' +
                                '<td>' + item.proid + '</td>' +
                                '<td>' + item.qty + '</td>' +
                                '<td>' + item.cost + '</td>' +
                            '</tr>';
                        });

                        modalTbody.append(rowHtml);

                        if (totalRows > 5) {
                            // Create pagination links only if totalRows is greater than 10
                            var pageLink = '<li class="page-item"><a class="page-link" href="#">' + (i + 1) + '</a></li>';
                            modalPagination.append(pageLink);
                        }
                    }

                    // Show the first page by default
                    modalTbody.find('tr').hide();
                    modalTbody.find('tr:lt(' + rowsPerPage + ')').show();
                } else {
                    modalTbody.append('<tr><td colspan="4" class="text-center text-danger">No data found</td></tr>');
                }

                $('#FormShow').modal('show'); // Show the modal after loading data
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error fetching data:', textStatus, errorThrown);
            }
        });
    });

    // Handle pagination click event
    $(document).on('click', '#modal-pagination .page-link', function() {
        var pageIndex = $(this).text() - 1;
        var rowsPerPage = 5;
        var startIndex = pageIndex * rowsPerPage;
        var endIndex = startIndex + rowsPerPage;

        $('#modal-pagination .page-item').removeClass('active');
        $(this).parent().addClass('active');

        $('#podtail_data tbody tr').hide();
        $('#podtail_data tbody tr').slice(startIndex, endIndex).show();
    });
});

// Handle delete button click
function confirmDelete(deleteURL) {
    if (confirm('Are you sure you want to delete this po?')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: deleteURL,
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error updating record:', textStatus, errorThrown);
            }
        });
    }
}
