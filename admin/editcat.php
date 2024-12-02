 <?php
session_start();
include("../co.php");
$sql="SELECT * FROM watch ORDER BY id";
$qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
      p{
        font-size: 3rem;
        margin-right: 20px;
       }
    </style>
    </head>
</head>
<body>

<?php
include("headerad.php");
?> 

<div class="container-xl">
<table class="table caption-top table-hover" >
<caption><b>Edit Watches</b></caption>
  <thead>
    <tr>
     <th scope="col">Watch ID</th>
      <th scope="col">Watch Name</th>
      <th scope="col">Picture</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
      <!-- <th scope="col"> Actions</th> -->
    </tr>
  </thead>
  <?php
     $count=mysqli_num_rows($qry);
     if($count>=1){
         while($row=mysqli_fetch_array($qry)){
             echo "<tr>";
             echo "<td>".$row['id']."</td>";
             echo "<td>".$row['name']."</td>";
             echo "<td><img src=../uploads/img/".$row['photo']." style=width:100px;height:100px></td>";
             echo "<td>".$row['price']."</td>";
             echo "<td>".$row['description']."</td>";
             echo "<td>
             <div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                 <a href='editdeletecat.php?id=" . $row['id'] . "&action=edit' class='btn btn-primary'>EDIT</a>
                 <a href='editdeletecat.php?id=" . $row['id'] . "&action=delete' class='btn btn-danger'>DELETE</a>
             </div>
           </td>";
             // echo "<td> <a href=editdeletecat.php?id=".$row['id']."&action=edit><button class='btn btn-primary'>EDIT</button></a> <a href=editdeletecat.php?id=".$row['id']."&action=delete><button class='btn btn-danger'>DELETE</button></a> </td>";
             echo "</tr>";
    
         }
     }
     else{
         echo "<h1>Sorry no record Found</h1>";
     }
     ?>

    </tbody>
    </table>

</body>
</html>