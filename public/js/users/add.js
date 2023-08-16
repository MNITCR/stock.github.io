$(function () {
    $("#add_user").click(function () {
        $("#Modal").modal("show");
    });

    $("#save").click(function () {
        // alert("Hello")
        var user = $("#name").val();
        var pass = $("#pass").val();
        var status = $("#status").val();

        if (user == "" || pass == "") {
            $("#error").html("PLease input data in the form.");
        }

        // alert(user + " " + pass + ' ' + status)

        $.post(
            "/adduser",
            { username: user, password: pass, status: status },
            function (data) {
                // alert(data);
                if (data == 1) {
                    alert("Record has been added.");
                    location.href = "/dashboard";
                }
            }
        );
    });
});
