// Add product
$(document).ready(function() {
     $(document).on('click','.Add',function(){
          $('#AddPro').modal('show');
     });

     // Function to fetch and populate category titles
     function fetchCategoriesAndPopulateSelect(selectId) {
          $.ajax({
               type: 'GET',
               url: 'get-categories',
               dataType: 'json',
               success: function(categories) {
                    var selectOptions = '';

                    categories.forEach(function(category) {
                         selectOptions += '<option value="' + category.catid + '">' + category.title + '</option>';
                    });

                    $('#' + selectId).html(selectOptions);
               },
               error: function(xhr, textStatus, errorThrown) {
                    console.error('Error fetching categories:', textStatus, errorThrown);
               }
          });
     }

     // Initial fetch and populate on page load
     fetchCategoriesAndPopulateSelect('addcate');

     // Add More button click event
    $('#addMoreButton').click(function() {
          var uniqueSelectId = 'addcate' + Date.now(); // Generate a unique ID
          var inputSet = `
               <div class="d-flex justify-content-between mb-3 input-set">
                    <div class="group-form">
                         <input type="text" name="addbarcode" id="addbarcode"  placeholder="barcode" class="form-control">
                    </div>
                    <div class="group-form">
                         <input type="text" name="addtitle" id="addtitle" placeholder="title" class="form-control">
                    </div>
                    <div class="group-form">
                         <input type="text" name="addqty" id="addqty" placeholder="quantity" class="form-control">
                    </div>
                    <div class="group-form">
                         <input type="text" name="addprice" id="addprice" placeholder="price" class="form-control">
                    </div>
                    <div class="group-form">
                         <select name="addcate" id="${uniqueSelectId}" class="form-select" style="width: 200px">
                              <!-- Options will be populated using AJAX -->
                         </select>
                    </div>
                    <div class="group-form">
                         <button type="button" class="btn btn-danger btn-sm remove-input">Remove</button>
                    </div>
               </div>
          `;
          $('#AddForm').append(inputSet);
          fetchCategoriesAndPopulateSelect(uniqueSelectId);
     });

     // Remove button click event for dynamically added input sets
     $('#AddForm').on('click', '.remove-input', function() {
          $(this).closest('.input-set').remove();
     });

     // Submit button click event
     $(document).on('click', '.AddButton', function() {
          var products = [];

          $('.input-set').each(function() {
               var barcode = $(this).find('input[name="addbarcode"]').val();
               var title = $(this).find('input[name="addtitle"]').val();
               var qty = $(this).find('input[name="addqty"]').val();
               var price = $(this).find('input[name="addprice"]').val();
               var categoryid = $(this).find('select[name="addcate"]').val();

               products.push({
                    barcode: barcode,
                    title: title,
                    qty: qty,
                    price: price,
                    categoryid: categoryid
               });
          });
          $.ajaxSetup({
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
          });
          $.ajax({
               type: 'POST',
               url: 'insert-pro', // Change to your insert route
               data: {
                    products: products
               },
               dataType: 'json',
               success: function(response) {
                    console.log(response.message);
                    // Optionally, you can close the modal or perform other actions here
               },
               error: function(xhr, textStatus, errorThrown) {
                    console.error('Error inserting products:', textStatus, errorThrown);
               }
          });
     });
});
