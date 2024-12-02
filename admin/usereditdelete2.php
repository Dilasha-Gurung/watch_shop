<?php
if(isset($_POST["updateuser"])){
  $n = $_POST["name"];
  $ema = $_POST["em"];
  $rol = $_POST["ro"];

    $i=$_POST["id"];
    $sql = "UPDATE users SET username='$n', email='$ema', role='$rol', password='$p' WHERE id=$i";
           include("../co.php");
          $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
           if($qry){
                header("Location:user.php");
                  }
  
             }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit users</title>
    <style>
        .error {
            color: red;
        }
    </style>
    <script type="text/javascript">

  function validateForm() {
    var e = 0;
    var n = document.update.name.value;
    var em = document.update.em.value;
    var r = document.update.ro.value;

    if (n.trim() == '') {
        document.getElementById('er_u').innerHTML = "*Enter the username";
        e++;
    } else {
        if (n.length < 6) {
            document.getElementById('er_u').innerHTML = "*Username must be at least 6 characters long";
            e++;
        } else {
            document.getElementById('er_u').innerHTML = "";
        }
    }

    if (em.trim() == '') {
        document.getElementById('er_em').innerHTML = "*Enter the email";
        e++;
    } else {
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(em)) {
            document.getElementById('er_em').innerHTML = "*Enter a valid email address";
            e++;
        } else {
            document.getElementById('er_em').innerHTML = "";
        }
      }

    if (r.trim() == '') {
        document.getElementById('er_r').innerHTML = "*Enter the role";
        e++;
    } else {
        document.getElementById('er_r').innerHTML = "";
    }

    return e === 0;
    }
    </script>
</head>
<body>
<div class="container-xl mt-4">
<form method="POST" action="#" name="update" onsubmit="return validateForm()">
<?php echo "EDIT $nam";?>

<div class="mb-3">
  <input class="form-control" type="hidden" name="id" value=<?php echo $id;?> >
</div>
  <div class="mb-3">
      <label for="title" class="form-label">User Name</label>
    <input class="form-control" type="text" name="name" value=<?php echo $nam;?> >
    <span id="er_u"class="error"></span>
  </div>
  <div class="mb-3">
      <label for="title" class="form-label">Email</label>
    <input class="form-control" type="text" name="em" value=<?php echo $e;?> >
    <span id="er_em" class="error"></span>
  </div>
  <div class="mb-3">
      <label for="title" class="form-label">Role</label>
    <input class="form-control" type="text" name="ro" value=<?php echo $r?> >
    <span id="er_r" class="error"></span>
  </div>
   <div class="mb-3">
      <label for="title" class="form-label">Password</label>
    <input class="form-control" type="text" name="pa" value=<?php echo $p?> >
     <span id="er_p" class="error"></span> 
  </div>  
 <input type="submit" class="btn btn-primary" name="updateuser" value="update"> 
</form> 
</div>
</body>
</html>