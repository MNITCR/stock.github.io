$(function () {
    $("#tbl tr").on("click", ".del", function () {
        var current_row = $(this).closest("tr");
        var userid = current_row.find("td").eq(0).text();
        //     alert(userid);
        $.post("/delete", { id: userid }, function (userId) {
            if (userId == 1) {
                alert("Delete successfully.");
                location.href = "/dashboard";
            }
        });
    });
});
