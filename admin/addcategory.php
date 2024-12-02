<?php
include("../co.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        p {
            font-size: 3rem;
            margin-right: 20px;
        }

        .error {
            color: #f00;
        }
    </style>
    <script type="text/javascript">
        function validate() {
            var e = 0;
            var n = document.addcategory.name.value;
            var p = document.addcategory.photo.value;
            var pr = document.addcategory.price.value;
            var d = document.addcategory.description.value;

            if (n.trim() == '') {
                document.getElementById('ern').innerHTML = "*Name is Required";
                e++;
            } else {
                document.getElementById('ern').innerHTML = "";
            }

            if (p.trim() == '') {
                document.getElementById('erp').innerHTML = "*Picture is required";
                e++;
            } else {
                var extension = p.substring(p.lastIndexOf('.') + 1).toLowerCase();
                var validatepic = ["jpeg", "jpg", "png"];
                if (validatepic.includes(extension)) {
                    document.getElementById('erp').innerHTML = "";
                } else {
                    document.getElementById('erp').innerHTML = "*Picture must be in jpeg/jpg/png format";
                    e++;
                }
            }

            if (pr.trim() == '') {
                document.getElementById('erpr').innerHTML = "*Price is Required";
                e++;
            } else {
                document.getElementById('erpr').innerHTML = "";
            }

            if (d.trim() == '') {
                document.getElementById('erd').innerHTML = "*description is Required";
                e++;
            } else {
                document.getElementById('erd').innerHTML = "";
            }


            return e === 0;
        }
    </script>
</head>
<body>
 <?php include("headerad.php"); 
?> 
<?php

if(isset($_POST["addcategory"])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $np=$_FILES["photo"]["name"];
    $tmpnamep=$_FILES["photo"]["tmp_name"];
    $updlocationp="../uploads/img/".$np;
    $dp=$_POST['description'];

    $sql="INSERT into watch(photo,name,price,description)VALUES('$np','$name','$price','$dp')";
    $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if($qry){
            //uploading the file to uploads folder 
            // move_uploaded_file($tmpname, $updlocation);
            move_uploaded_file($tmpnamep, $updlocationp);
            echo '<div class="alert alert-success" role="alert">File uploaded successfully!</div>';
        }
}
?>
<div class="container-xl mt-4">
    <form method="POST" action="" name="addcategory" enctype="multipart/form-data" onsubmit="return validate()">

         <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input class="form-control" type="text" id="name" name="name">
            <span id="ern" class="error"></span>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input class="form-control" type="number" id="price" name="price">
            <span id="erpr" class="error"></span>
        </div>

        <div class="mb-3">
            <label for="formFilePhoto" class="form-label">Picture</label>
            <input class="form-control" type="file" id="formFilePhoto" name="photo">
            <span id="erp" class="error"></span>
        </div>
        

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description">
            <span id="erd" class="error"></span>
        </div>
        <button type="submit" class="btn btn-primary" name="addcategory">Add</button>
    </form>
</div>
</body>
</html>
