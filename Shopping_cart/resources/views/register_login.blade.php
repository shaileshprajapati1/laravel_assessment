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
        <?php

        if (count($errors) > 0) {
            foreach ($errors->all() as $error) { ?>
                <p class="alert alert-danger">{{ $error }}</p>
        <?php }
        } ?>

        <?php
        if (session()->has('message')) { ?>
            <p class="alert alert-success">{{ session('message') }}</p>
        <?php  } ?>

        <div class="signup">
            <form method="post" id="register">
                @csrf
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="username" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <button type="submit">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="post" id="login">
                @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="Password" placeholder="Password" required="">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>


    <script script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // register 
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
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify(dataObj)
            }).then((res) => res.json()).then((result) => {
                // console.log(result);
                alert("Registrion Success");
                window.location.href = '/'
            })
        })
    </script>
</body>

</html>