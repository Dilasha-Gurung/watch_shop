<?php

if(isset($_POST["submit"])){

    $tit=$_POST['search'];
    //echo"$tit";
    include("../co.php");
    $sql="SELECT id,name,photo,brand,price,description,stock FROM watch WHERE name LIKE '%$tit%'";
    $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"/>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <style>
      p{
        font-size: 3rem;
        margin-right: 20px;
       }
    </style>
</head>
<body>
    <?php
    include("headerad.php");
    ?>
<div class="container-xl">
<table class="table caption-top table-hover" >
<caption><b>Watches</b></caption>
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Picture</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <?php
    $count=mysqli_num_rows($qry);
    if($count>=1){
        // echo "<h3>We have $count records.</h3>";
        while($row=mysqli_fetch_array($qry)){
            echo "<tr>";
            // echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td><img src=../uploads/img/".$row['photo']." style=width:100px;height:100px></td>";
            echo "<td>".$row['price']."</td>";
            echo "<td>".$row['description']."</td>";
            // echo "<td><a href='favorites.php?id=" . $row['id'] . "'><img src='../img/addf.png' alt='fav' style='width:20px;height:20px;'></a></td>";
            echo "<td> <a href=editdeletecat.php?id=".$row['id']."&action=edit><button class='btn btn-primary'>EDIT</button></a> <a href=editdeletecat.php?id=".$row['id']."&action=delete><button class='btn btn-danger'>DELETE</button></a> </td>";
            echo "</tr>";
        }
    }
    else{
        echo "<h1>Sorry no record Found</h1>";
    }

    echo"</tbody>";
    echo "</table>";
    ?>
</table>
<?php
}
// include("footer.php");
?>
</div>


</body>
</html>