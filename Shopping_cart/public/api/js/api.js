document.getElementById("register").addEventListener("submit", function (e) {
    e.preventDefault();
    // console.log('call');
    var dataArray = $("#register").serializeArray(),
        dataObj = {};
    $(dataArray).each(function (i, field) {
        dataObj[field.name] = field.value;
    });
    // console.log(dataObj);
    fetch(`http://localhost:8000/api/register`, {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        method: "POST",
        body: JSON.stringify(dataObj),
    })
        .then((res) => res.json())
        .then((result) => {
            console.log(result);
            if (result > 0) {
                alert("Registration Success");
                window.location.href = "/";
            } else {
                alert("Registration Fail Try Again");
                window.location.href = "/";
            }
        });
});

//login
document.getElementById("loginbyid").addEventListener("submit", function (e) {
    e.preventDefault();

    let Emailbyid = e.target.emailid.value;
    let Passwordbyid = e.target.loginpassword.value;

    fetch(`http://localhost:8000/api/login`, {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        method: "POST",
        body: JSON.stringify({
            email: Emailbyid,
            password: Passwordbyid,
        }),
    })
        .then((res) => res.json())
        .then((result) => {
            // console.log(result.role);
            if (result.role == 1) {
                alert("Login Success");
                window.location.href = "/admin";
            } else if (result > 0) {
                alert("Login Success");
                window.location.href = "/home";
            } else {
                alert("Login Fail ");
                window.location.href = "/";
            }
        });
});


