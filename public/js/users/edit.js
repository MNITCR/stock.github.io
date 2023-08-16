$("#tbl tr").on("click", ".edit", function() {
     var row = $(this).closest("tr");
     var id = row.find("td").eq(0).text();
     var name = row.find("td").eq(1).text();
     var status = row.find('td').eq(2).text();

     $("#id").val(id);
     $("#upname").val(name);
     $('#upstatus option[value="' + status+ '"]').prop('selected', true);

     $('#update').modal('show');
});

$("#edit").click(function() {
    var id = $('#id').val();
    var name = $("#upname").val();
    var pass = $("#uppass").val();
    var status = $("#upstatus").val();

    $.post("/update",{id:id ,upn:name, upp:pass, upst:status }, function(data_up) {
            if (data_up == 1) {
                alert("Update data successfully.");
                location.href = "/dashboard";
            }
        }
    );
});
