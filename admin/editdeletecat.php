<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>


<?php
include("headerad.php");
//capturing the data from the url
if(isset($_GET['id'])&isset($_GET['action']))
{
    $id=$_GET['id'];
    $action=$_GET['action'];
    switch($action){
        case 'edit':{
            // echo "You are editing the record.";
            $sql = "SELECT * FROM watch where id=$id";
            include("../co.php");
            $qry=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_array($qry)){
                $name=$row['name'];
                $price=$row['price'];
                $p=$row['photo'];
                $d=$row['description'];
                //include("editu.php");
                include("maincatedit1.php");
            }
            break;
        }
        
        case 'delete':
            {

                $sql="DELETE FROM watch where id=$id";
                include("../co.php");
                $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if($qry){
                    header("Location:editcat.php?msg=record deleted successfully");
                }

                 break;
            }
        default:{
            echo "Unable to perform the task";
            break;
        }
    }

}
else{
header("Location:store.php");
    echo"wr0ng";
}
    ?>
</body>
</html>