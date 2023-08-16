<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body class="d-flex justify-center align-items-center flex-column" style="min-height:100vh;">
    <form style="width:400px; margin:auto;">
        <div class="group-form mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" autofocus class="form-control">
        </div>

        <div class="group-form mb-3">
            <label for="password">Password</label>
            <input id="pass" type="password" name="pass" class="form-control">
        </div>

        <div class="group-form mb-3">
            <button type="submit" class="btn btn-primary" id="btnok">Login</button>
        </div>
    </form>

    <script>
        $('#btnok').click(function() {
            var email = $('#email').val();
            var pass = $('#pass').val();

            $.post('/login',{email:email, pass:pass}, function(data){
               alert(data);
            })
        })
    </script>
</body>

</html>
