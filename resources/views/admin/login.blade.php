<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <title>@yield('title', 'Dashboard')</title> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: "";
            background-image: url('https://media.istockphoto.com/id/1364159707/photo/login-online-form-cyber-security-concept-image.webp?b=1&s=170667a&w=0&k=20&c=RPBQKIH-x-atxNwH_qucKlVw3hwSAgwXfexmzUs1QM4=');
            background-size: cover;
            filter: blur(5px);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
</head>

<body class="d-flex justify-center align-items-center flex-column bg-dark" style="min-height:100vh;">
    <form method="POST" action="{{ route('login')}}" style="width:400px; margin:auto;">
        @csrf
        <div class="group-form mb-3">
            <label for="email" class="text-white">Email</label>
            <input id="email" type="email" name="email" autofocus class="form-control"
            @if(isset($_COOKIE["email"])) value="{{ $_COOKIE["email"] }}" @endif required>
        </div>
        <div class="group-form mb-3">
            <label for="password" class="text-white">Password</label>
            <input id="pass" type="password" name="pass" class="form-control"
            @if(isset($_COOKIE["pass"])) value="{{ $_COOKIE["pass"] }}" @endif required">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label text-white" for="remember">Remember me</label>
        </div>
        <div class="group-form mb-3">
            <button type="submit" class="btn btn-primary" id="btnok">Login</button>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            const emailInput = $("#email");
            const passInput = $("#pass");
            const rememberCheckbox = $("#remember");

            // Check if cookies are set for email and password
            if (rememberCheckbox.prop("checked")) {
                const storedEmail = localStorage.getItem("remembered_email");
                const storedPass = localStorage.getItem("remembered_pass");

                if (storedEmail) {
                    emailInput.val(storedEmail);
                }

                if (storedPass) {
                    passInput.val(storedPass);
                }
            }

            // Handle Remember Me checkbox change
            rememberCheckbox.on("change", function () {
                if (this.checked) {
                    localStorage.setItem("remembered_email", emailInput.val());
                    localStorage.setItem("remembered_pass", passInput.val());
                } else {
                    localStorage.removeItem("remembered_email");
                    localStorage.removeItem("remembered_pass");
                }
            });
        });
    </script>
</body>
</html>
