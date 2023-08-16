// $(document).ready(function() {
//     // view the content
//     $('.view').click(function() {
//         // alert('HIii');
//         var productId = $(this).data('id'); // Get the product ID from the data-id attribute
//         console.log(productId);
//         $.ajax({
//             type: 'GET',
//             url: 'get-prodetail/' + productId, // Replace with your route or URL
//             dataType: 'json',
//             success: function(response) {
//                 var modalTbody = $('#podtail_data tbody');
//                 var modalPagination = $('#modal-pagination ul');
//                 modalTbody.empty();
//                 modalPagination.empty();

//                 var rowsPerPage = 10; // Number of rows per page
//                 var totalRows = response.data.length;

//                 if (totalRows > 0) {
//                     var pageCount = Math.ceil(totalRows / rowsPerPage);

//                     for (var i = 0; i < pageCount; i++) {
//                         var startIndex = i * rowsPerPage;
//                         var endIndex = startIndex + rowsPerPage;
//                         var slicedData = response.data.slice(startIndex, endIndex);

//                         var rowHtml = '';
//                         slicedData.forEach(function(item) {
//                             rowHtml += '<tr>' +
//                                 '<td>' + item.poid + '</td>' +
//                                 '<td>' + item.proid + '</td>' +
//                                 '<td>' + item.qty + '</td>' +
//                                 '<td>' + item.cost + '</td>' +
//                             '</tr>';
//                         });

//                         modalTbody.append(rowHtml);

//                         if (totalRows > 10) {
//                             // Create pagination links only if totalRows is greater than 10
//                             var pageLink = '<li class="page-item"><a class="page-link" href="#">' + (i + 1) + '</a></li>';
//                             modalPagination.append(pageLink);
//                         }
//                     }

//                     // Show the first page by default
//                     modalTbody.find('tr').hide();
//                     modalTbody.find('tr:lt(' + rowsPerPage + ')').show();
//                 } else {
//                     modalTbody.append('<tr><td colspan="4" class="text-center text-danger">No data found</td></tr>');
//                 }

//                 $('#FormShow').modal('show'); // Show the modal after loading data
//             },
//             error: function(xhr, textStatus, errorThrown) {
//                 console.error('Error fetching data:', textStatus, errorThrown);
//             }
//         });
//     });

//     // Handle pagination click event
//     $(document).on('click', '#modal-pagination .page-link', function() {
//         var pageIndex = $(this).text() - 1;
//         var rowsPerPage = 10;
//         var startIndex = pageIndex * rowsPerPage;
//         var endIndex = startIndex + rowsPerPage;

//         $('#modal-pagination .page-item').removeClass('active');
//         $(this).parent().addClass('active');

//         $('#podtail_data tbody tr').hide();
//         $('#podtail_data tbody tr').slice(startIndex, endIndex).show();
//     });
// });
