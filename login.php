<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>
<body>
<?php
if (isset($_POST["login"])) {
    $e = $_POST["email"];
    $p = md5($_POST["password"]);
    $sql = "SELECT * FROM users WHERE email='$e' AND password='$p'";
    include("co.php");
    $qry = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count = mysqli_num_rows($qry);
    if ($count == 1) {
        while ($row = mysqli_fetch_array($qry)) {
            $nam = $row['username'];
            $i = $row['id'];
            $r = $row['role'];
        }
        if ($r == "admin") {
            $_SESSION["id"] = $i;
            header("Location:admin/store.php");
            echo"ADMIN";
        } else {
            $_SESSION["id"] = $i;
            header("Location:user/home.php");

        }
    } else {
        echo '<script type="text/javascript">
                 window.addEventListener("load", myFunction);
                 function myFunction() {
                     alert("Wrong email or password");
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
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form class="p-5 rounded shadow" style="max-width: 30rem; width: 100%" method="POST" onsubmit="return validate()">
            <h1 class="text-center display-4 pb-5">LOGIN</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <label for="exampleInputEmail1" class="form-label" id="labelm" style="color:red; visibility:hidden;">Invalid</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
                <span id="erp" class="error" style="color:red;"></span>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
            <button class="btn btn-primary" name="register"><a href='register.php' style="color:white;text-decoration: none;">Register</a></button>
        </form>
    </div>

    <script type="text/javascript">
    function validate() {
        var en = document.getElementById("email");
        var pa = document.getElementById("password");
        var labelm = document.getElementById("labelm");
        var erp = document.getElementById("erp");

        if (en.value.trim() === "" && pa.value.trim() === "") {
            en.style.border = "solid 3px red";
            labelm.style.visibility = "visible";
            pa.style.border = "solid 3px red";
            erp.innerHTML = "*Password must be at least 8 characters, include numbers and special characters";
            return false;
        }

        if (en.value.trim() === "") {
            en.style.border = "solid 3px red";
            labelm.style.visibility = "visible";
            return false;
        } else {
            en.style.border = "";
            labelm.style.visibility = "hidden";
        }

        var passwordValue = pa.value.trim();
        if (passwordValue === "") {
            pa.style.border = "solid 3px red";
            erp.innerHTML = "*Password is required";
            return false;
        }

        var passwordRegex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{8,}$/;
        if (passwordValue.length < 8 || !passwordRegex.test(passwordValue)) {
            pa.style.border = "solid 3px red";
            erp.innerHTML = "*Password must be at least 8 characters long, include numbers and special characters";
            return false;
        } else {
            pa.style.border = "";
            erp.innerHTML = "";
        }

        return true;
    }
    </script>
</body>
</html>
