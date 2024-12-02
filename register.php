<?php

if(isset($_POST["register"])){
    
        $u=$_POST['username'];
        $p=md5($_POST['password']); // Hash the password with MD5
        $e=$_POST['email'];
        include("co.php");
        $sq="SELECT * FROM `users` WHERE email='$e'";
        $qr=mysqli_query($conn, $sq) or die(mysqli_error($conn));
        if ($qr->num_rows == 0) {
        //Writing the sql for inserting the user into prac table
        $sql = "INSERT into users(`username`,`email`,`password`,`role`)VALUES('$u','$e','$p','user')";
    
        //Executing the query
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($qry){
            // echo "Data inserted successfully";
            header("location:login.php");
        }
    }
        else{
            echo '<script type="text/javascript">
            window.addEventListener("load", myFunction);
            function myFunction() {
                alert("Email is already registered");
            } 
        </script>';
        }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
  
       <style>
        .error {
            color: red;
        }
    </style>
    <script type="text/javascript">
        function validate() {
            var isValid = true;
            var u = document.getElementById('username').value.trim();
            var e = document.getElementById('exampleInputEmail1').value.trim();
            var p = document.getElementById('exampleInputPassword1').value.trim();

            // Username validation
            if (u == '') {
                document.getElementById('eru').innerHTML = "*Username is required";
                isValid = false;
            } else if (u.length < 6) {
                document.getElementById('eru').innerHTML = "*Username must be at least 6 characters long";
                isValid = false;
            } else {
                document.getElementById('eru').innerHTML = "";
            }

            // Email validation /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (e == '') {
                document.getElementById('ere').innerHTML = "*Email is required";
                isValid = false;
            } else if (!emailRegex.test(e)) {
                document.getElementById('ere').innerHTML = "*Enter a valid email address";
                isValid = false;
            } else {
                document.getElementById('ere').innerHTML = "";
            }

            // Password validation
            var passwordRegex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{8,}$/;
            if (p == '') {
                document.getElementById('erp').innerHTML = "*Password is required";
                isValid = false;
            } else if (!passwordRegex.test(p)) {
                document.getElementById('erp').innerHTML = "*Password must be at least 8 characters long and include numbers and special characters";
                isValid = false;
            } else {
                document.getElementById('erp').innerHTML = "";
            }

            return isValid;
        }
    </script>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center"  style="min-height: 100vh;">

        <form method="post" class="p-5 rounded shadow" onsubmit="return validate()" style="max-width: 30rem; width: 100%"
            >
            <h1 class="text-center display-4 pb-5">Signup</h1>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="usernameHelp" value=""> 
                <span id="eru" class="error"></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                    <span id="ere" class="error"></span>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                <span id="erp" class="error"></span>
                
            </div>

            <input type="submit" class="btn btn-primary" value="register" name="register">
        </form>
    </div>

</body>

</html>

