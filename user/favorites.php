<?php
session_start();
include("../co.php");
if (isset($_GET['id'])) {  
    $id = $_GET['id']; 
    $uid=$_SESSION["id"] ; 
    $sq= "DELETE FROM favorite WHERE fid=$id AND uid=$uid";
            $qry=mysqli_query($conn, $sq);
} 
$uid=$_SESSION["id"] ;
//echo"$uid";
$sql="SELECT w.id,w.name, w.photo,w.price,w.description FROM watch AS w JOIN favorite AS f On w.id=f.fid WHERE f.uid=$uid;";
$qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view</title>
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
include("headeruser.php");
?>
<div class="container-xl">
<table class="table caption-top table-hover" >
<caption><b>List of Favorites</b></caption>
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Picture</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
      <th scope="col">Remove Favorite</th>
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
            echo "<td>Rs. ".$row['price']."</td>";
            echo "<td>".$row['description']."</td>";
            echo "<td><a href='favorites.php?id=" . $row['id'] . "'><img src='../img/nofav.png' alt='fav' style='width:20px;height:20px;'></a></td>";

            echo "</tr>";
        }
    }
    else{
        echo "<h1>Your Wishlist is Empty</h1>";
    }

    echo"</tbody>";
    echo "</table>";
    ?>
</table>
</div>


</body>
</html>