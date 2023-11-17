<!DOCTYPE html>
<html>

<head>
    <title>Register And Login</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link href="{{ url('register/style.css') }}" rel="stylesheet">

</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">
            <form method="post" id="register">
                @csrf
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="username" id="username" placeholder="User name">
                <input type="email" name="email" id="email" placeholder="Email">
                <input type="password" name="password" minlength="8" id="password" placeholder="Password">
                <button type="submit">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="post" id="loginbyid">
                @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" id="emailid" placeholder="Email" required="">
                <input type="password" name="password" id="loginpassword" placeholder="Password" required="">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>


    <script script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>

    <script>
        // register 
        $(document).ready(function() {
            $("#register").validate({
                rules: {
                    username: "required",
                    email: "required",
                },
                password: {
                    required: true,
                    minlength: 8
                },
                messages: {
                    username: "Please enter username.",
                    email: "Please enter email.",
                    password: "Please enter password."

                }
            })
        })
        document.getElementById("register").addEventListener('submit', function(e) {
            e.preventDefault();
            // console.log('call');
            var dataArray = $("#register").serializeArray(),
                dataObj = {};
            $(dataArray).each(function(i, field) {
                dataObj[field.name] = field.value;
            });
            // console.log(dataObj);
            fetch(`http://localhost:8000/api/register`, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                method: "POST",
                body: JSON.stringify(dataObj)
            }).then((res) => res.json()).then((result) => {
                console.log(result);
                if (result > 0) {
                    alert("Registration Success");
                    window.location.href = '/'
                } else {
                    alert("Registration Fail Try Again");
                    window.location.href = '/'
                }
            })
        })

        //login
        document.getElementById("loginbyid").addEventListener("submit", function(e) {
            e.preventDefault();

            let Emailbyid = e.target.emailid.value;
            let Passwordbyid = e.target.loginpassword.value;

            fetch(`http://localhost:8000/api/login`, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                method: "POST",
                body: JSON.stringify({
                    email: Emailbyid,
                    password: Passwordbyid
                })
            }).then((res) => res.json()).then((result) => {
                // console.log(result.role);
                if (result.role == 1) {
                    alert("Login Success");
                    window.location.href = '/admindashboard'
                } else if (result > 0) {
                    alert("Login Success");
                    window.location.href = '/home'
                } else {
                    alert("Login Fail ");
                    window.location.href = '/'
                }
            })
        })
    </script>
</body>

</html>