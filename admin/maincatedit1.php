
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
      p{
        font-size: 3rem;
        margin-right: 20px;
       }
       .error{
        color:#f00;
       }
    </style>
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
<div class="container-xl mt-4">
<form method="POST" action="maincatedit2.php" name="submit" enctype="multipart/form-data" onsubmit="return validate()">
<?php echo "EDIT $name";?>
<div class="mb-3">
  <input class="form-control" type="hidden" name="id" value=<?php echo $id;?> >
</div>
  <div class="mb-3">
      <label for="name" class="form-label">Name</label>
    <input class="form-control" type="text" name="name" id="title" value="<?php echo $name;?>">
    <span id="ern" class="error"></span>
  </div>
  <div class="mb-3">
  <label for="formFile" class="form-label">Picture</label>
  <i><?php echo $p;?></i><br>
  <input class="form-control" type="file" id="formFilePhoto" name="pic">
  <span id="erp" class="error"></span>
  </div>
  <div class="mb-3">
  <label for="price" class="form-label" >Price</label>
  <i><?php echo $price;?></i><br>
  <input class="form-control" type="number" id="price" name="price">
  <span id="erpr" class="error"></span>
  </div>
  
  <div class="mb-3">
    <label for="title" class="form-label">Description</label>
    <input class="form-control" type="text" name="description"  id="description" value="<?php echo $d; ?>" >
    <span id="erd" class="error"></span>
  </div>
 <input type="submit" class="btn btn-primary" name="submit" value="update"> 
</form> 
</div>
</body>
</html>
