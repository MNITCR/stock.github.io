$(document).ready(function() {
    // Event listener for the search input
    $('#search_input').on('keyup', function() {
        var searchText = $(this).val().toLowerCase(); // Get the search query in lowercase

        var $noUserRow = $('#no_row'); // Get the "No user found" row

        // Loop through each user row in the table and check if it matches the search query
        $('#user_data tr.user_row').each(function() {
            // Get the content of the row's name column in lowercase
            var rowData = $(this).find('td:nth-child(2)').text().toLowerCase();
            if (rowData.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Show or hide the "No user found" row based on the search results
        if ($('#user_data tr.user_row:visible').length === 0) {
            $noUserRow.show();
        } else {
            $noUserRow.hide();
        }
    });
});
