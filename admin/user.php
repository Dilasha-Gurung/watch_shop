<?php
session_start();
include("../co.php");
$sql="SELECT * FROM users ORDER BY id";
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
<caption><b>Edit Users</b></caption>
  <thead>
    <tr>
     <th scope="col">User ID</th>
      <th scope="col">User Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col"> Password</th>
    </tr>
  </thead>
  <?php
    $count=mysqli_num_rows($qry);
    if($count>=1){
        while($row=mysqli_fetch_array($qry)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['role']."</td>";
            echo "<td>".$row['password']."</td>";
            echo "<td> <a href=usereditdelete1.php?id=".$row['id']."&action=edit><button class='btn btn-primary'>EDIT</button></a> <a href=usereditdelete1.php?id=".$row['id']."&action=delete><button class='btn btn-danger'>DELETE</button></a> </td>";
            echo "</tr>";
    
        }
    }
    else{
        echo "<h1>Sorry no record Found</h1>";
    }
    ?>
    </tbody>
    </table>
    <?php
//  include("footer.php");
  ?>

</body>
</html>