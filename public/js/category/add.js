$(document).ready(function(){
     $(document).on('click','.AddCat',function(){
          $('#AddCatModal').modal('show');
     });

     // Add More button click event
    $('#addMoreButton').click(function() {
          var inputSet = `
               <tr class="input-set">
                    <td><input type="text" name="txttitle[]"
                              class="txttitle"></td>
                    <td><input type="text" name="txttitlekh[]"
                              class="titlekh"></td>
                    <td><input type="text" name="txtdescription[]"
                              class="descript">
                    </td>
                    <td><button class="btn btn-sm btn-danger remove-input">Remove</button></td>
               </tr>
          `;
          $('#AddForm').append(inputSet);
          // getCatTT(uniqueSelectId);
     });

     // Remove button
     $('#AddForm').on('click', '.remove-input', function() {
          $(this).closest('.input-set').remove();
     });

     // save data to database
     $('#btnsave').click(function(e) {
          var category = [];
          $('.input-set').each(function() {
               var name = $(this).find('input:eq(0)').val();
               var nameKh = $(this).find('input:eq(1)').val();
               var des = $(this).find('input:eq(2)').val();
               // console.log(name+" "+" "+nameKh+" "+des);
               category.push({
                    title: name,
                    titlekh: nameKh,
                    description: des,
               });

          });
          $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
          });
          $.ajax({
               type: 'POST',
               url: 'insert-cat',
               data: {
                    Category:category
               },
               dataType: 'json',
               success: function(response) {
                    console.log(response);
                    $('#AddCatModal').modal('hide');
                    // $('#AddCatModal').modal('hide');
                    location.reload();
               },
               error: function(xhr, textStatus, errorThrown) {
                    console.error('Error inserting products:', textStatus, errorThrown);
               }
          });
     });
});
