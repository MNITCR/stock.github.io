$(document).ready(function() {
     // Function to generate a random number between min and max
     function getRandomNumber(min, max) {
          return Math.floor(Math.random() * (max - min + 1)) + min;
     }
     // Function to generate a random barcode
     function generateRandomBarcode() {
          const currentDate = new Date();
          const year = currentDate.getFullYear();
          const month = String(currentDate.getMonth() + 1).padStart(2, '0');
          const day = String(currentDate.getDate()).padStart(2, '0');
          const randomDigits = String(getRandomNumber(1000, 9999));
          return  day + month + year + randomDigits;
     }

     // AJAX requires
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
     });

     // clear in put when starting
     window.addEventListener("beforeunload", function(){
          $('#discount').val('');
          $('#tax').val('');
          $('#total').val('');
          $("#grandtotal").val('');
          $('#searchpro').val('');
     });

     // search for products
     $('#searchpro').change(function(){
          var barcode = $('#searchpro').val();
          $.post('/searchpro',{barcode:barcode}, function(result){
               console.log(result);
               if(result == 0){
                    alert("Product not found.");
               }else{
                    $(document).ready(function() {
                         $('#barcode').val(generateRandomBarcode());
                    });

                    const arr = result.split(';');
                    let proid = arr[0];
                    let proname = arr[1];

                    var title = proname;
                    var txtProid = `<input type='hidden' class='pid' value='${proid}'>`;
                    var txtqty = `<input type='text' class='qty form-control' value='0'>`;
                    var txtcost = `<input type='text' class='cost form-control' value='0'>`;
                    var txtamount = `<input type='text' class='amount form-control' value='0'>`;

                    $('#add_row').append(`
                         <tr>
                              <td>${txtProid}${title}</td>
                              <td>${txtqty}</td>
                              <td>${txtcost}</td>
                              <td>${txtamount}</td>
                              <td><a href="#" class='remove'>Remove</a></td>
                         </tr>
                    `);
               }
          })
     });

     // remove the row
     $('#tblpo').on('click','.remove', function(){
          $(this).closest('tr').remove();
     });

     // calculate
     $(function(){
          function TotalDiscount(){
               var total = $('#total').val();
               var dis = $('#discount').val();
               // var tax = $('#tax').val();

               var grandTotal = (total - (total * dis)/100);

               $('#total').val(total);
               $('#grandtotal').val(grandTotal);
          }


          function TotalTax(){
               var tax = $('#tax').val();
               var total = $('#total').val();
               var dis = $('#discount').val();

               var grandTotal = (total - (total * dis)/100) + parseFloat(tax);
               $('#total').val(total);
               $('#grandtotal').val(grandTotal);
          }


          function SumData(){
               var row = ('#tblpo tr').length;
               var tax = $('#tax').val();
               var dis = $('#discount').val();

               var total = 0;
               var amount = 0;
               for(var i=1; i<(row-2); i++){
                    amount = $('#tblpo').find('tr').eq(i)
                                           .find('td').eq(3)
                                           .children().val();
                    if(!isNaN(parseFloat(amount))){
                         total = total + parseFloat(amount);
                    }
               }
               // alert(total)

               var totalDiscount = 0;
               if(dis == 0 || dis == ""){
                    totalDiscount = totalDiscount;
               }else{
                    totalDiscount = (total * dis) / 100;
               }

               var totalTax = 0;
               if(tax == 0 || tax == ""){
                    totalTax = totalTax;
               }else{
                    totalTax = tax;
               }

               total = total;
               var grandTotal = parseFloat(total) -
                                parseFloat(totalDiscount) +
                                parseFloat(totalTax);
               $('#total').val(total);
               $('#grandtotal').val(grandTotal);

          }


          $('#discount').change(function(){
               TotalDiscount();
          });

          $('#tax').change(function(){
               TotalTax();
          });

          $('#tblpo').on('change', '.cost', function(){
               var row = $(this).closest('tr');
               var qty = row.find('td').eq(1).children().val();
               var cost = row.find('td').eq(2).children().val();
               var amount = parseFloat(qty) * parseFloat(cost);
               row.find('td').eq(3).children().val(amount);
               SumData();
          })
     });

     // save data
     $(function(){
          $('#Save').click(function(){
               var searchCode = $('#searchpro').val();
               // var code = $('#barcode').val(searchCode);
               var date = $('#podate').val();
               var discount = $('#discount').val();
               var tax = $('#tax').val();
               var total = $('#total').val();
               var totalGrand = $('#grandtotal').val();

               var prid = $('.pid').map(function(){
                    return $(this).val();
               }).get();
               var qty = $('.qty').map(function(){
                    return $(this).val();
               }).get();
               var cost = $('.cost').map(function(){
                    return $(this).val();
               }).get();

               $.post('/create', {qty:qty, cost:cost, pocode:searchCode, date:date, dis:discount, tax:tax, total:total,grand_total:totalGrand,'prid[]': prid}, function(result){
                    location.reload();
               });
          })
     })

});
