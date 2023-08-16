$(document).ready(function(){
    // get data show in form
    $(document).on('click','.print',function(){
        var $tr = $(this).closest('tr');
        var productCode = $tr.find('td:eq(1)').text();
        var discount = $tr.find('td:eq(2)').text();
        var tax = $tr.find('td:eq(3)').text();
        var grandTotal = $tr.find('td:eq(4)').text();
        var total = $tr.find('td:eq(5)').text();
        var date = $tr.find('td:eq(6)').text();
        var transactionID = generateTransactionID();

        console.log(productCode +'\n'+ discount +'\n' + tax +'\n'+ grandTotal +'\n'+ total +'\n'+ date +'\n'+ transactionID);

        $('#pdcode').text(productCode);
        $('#ds').text(discount);
        $('#tax1').text(tax);
        $('#GDT').text(grandTotal);
        $('#total1').text(total);
        $('#date1').text(date);
        $('#transaction').text(transactionID);

        $('#FormPrint').modal('show');
    });

    // radom code
    function generateTransactionID() {
        var date = new Date();
        var timestamp = date.getTime(); // Get current timestamp
        var randomNum = Math.floor(Math.random() * 1000); // Generate a random number

        var transactionID = timestamp.toString() + randomNum.toString();
        return transactionID;
    }

    // print receipt
    $('.PrintReceipt').on('click', function () {
        var receiptContent = $('.receipt').html();
        var printWindow = window.open('', '_blank', 'width=500,height=500'); // Corrected syntax
        printWindow.document.write('<html><head><title>Print Receipt</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('body { font-size: 14px; }'); // Set the desired font size
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');

        // Wrap the receipt content in a centered div
        printWindow.document.write('<div style="text-align: center;">');
        printWindow.document.write(receiptContent);
        printWindow.document.write('</div>');

        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });

    // download receipt
    // $('.Receipt').click(function() {
    //     var style = document.createElement('style');
    //     style.innerHTML = `
    //         .FormPayment {
    //             background-color: white;
    //             color: black;
    //         }
    //     `;

    //     document.head.appendChild(style);

    //     html2canvas($('.FormPayment'), {
    //         scale: window.devicePixelRatio
    //     }).then(function(canvas) {
    //         document.head.removeChild(style);

    //         var dataURL = canvas.toDataURL('image/jpeg', 0.9);

    //         var link = document.createElement('a');
    //         link.download = 'receipt.jpg';
    //         link.href = dataURL;
    //         link.click();
    //     });
    // });

    // work
    // $(document).ready(function() {
    //     $('#downloadButton').click(function() {
    //         var style = document.createElement('style');
    //         style.innerHTML = `
    //             .receipt {
    //                 background-color: white;
    //                 color: black;
    //             }
    //         `;

    //         document.head.appendChild(style);

    //         var content = document.getElementById('FormPayment');

    //         var canvas = document.createElement('canvas');
    //         canvas.width = content.offsetWidth * 2;
    //         canvas.height = content.offsetHeight * 2;
    //         canvas.style.width = content.offsetWidth + 'px';
    //         canvas.style.height = content.offsetHeight + 'px';

    //         var context = canvas.getContext('2d');
    //         context.scale(2, 2);

    //         html2canvas(content, {
    //             canvas: canvas,
    //             scale: 1,
    //             logging: true
    //         }).then(function(canvas) {
    //             document.head.removeChild(style);

    //             var dataURL = canvas.toDataURL('image/jpeg', 1.0);

    //             var link = document.createElement('a');
    //             link.download = 'receipt.jpg';
    //             link.href = dataURL;
    //             link.click();
    //         });
    //     });
    // });

    // $(document).ready(function() {
    //     $('#downloadButton').click(function() {
    //         var content = document.getElementById('FormPayment');

    //         html2canvas(content, {
    //             logging: true
    //         }).then(function(canvas) {
    //             var context = canvas.getContext('2d');
    //             var imageData = context.getImageData(0, 0, canvas.width, canvas.height);
    //             var data = imageData.data;

    //             for (var i = 0; i < data.length; i += 4) {
    //                 // Invert colors: white text becomes black, black background becomes white
    //                 data[i] = 255 - data[i]; // Red channel
    //                 data[i + 1] = 255 - data[i + 1]; // Green channel
    //                 data[i + 2] = 255 - data[i + 2]; // Blue channel
    //             }

    //             context.putImageData(imageData, 0, 0);

    //             var dataURL = canvas.toDataURL('image/jpeg', 5.0);

    //             var link = document.createElement('a');
    //             link.download = 'inverted_payment_receipt.jpg';
    //             link.href = dataURL;
    //             link.click();
    //         });
    //     });
    // });

    $('.Receipt').click(function() {
        var content = $('.FormPayment')[0]; // Get the DOM element from the jQuery object

        var style = document.createElement('style');
        style.innerHTML = `
            .FormPayment {
                background-color: white;
                color: black;
            }
        `;

        document.head.appendChild(style);

        // Adjust the scale factor as needed
        var scale = 2; // Experiment with different values

        html2canvas(content, {
            scale: scale,
            logging: true
        }).then(function(canvas) {
            document.head.removeChild(style);

            var dataURL = canvas.toDataURL('image/jpeg', 1.0);

            var link = document.createElement('a');
            link.download = 'receipt.jpg';
            link.href = dataURL;
            link.click();
        });
    });

});
