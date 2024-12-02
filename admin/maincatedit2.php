<?php
include("../co.php");
if(isset($_POST["submit"]) && $_POST["submit"]=='update'){
$i=$_POST["id"];
$na=$_POST['name'];
$pr=$_POST['price'];
$pname=$_FILES["pic"]["name"];
$tmpnamep=$_FILES["pic"]["tmp_name"];
$updlocationp="../uploads/img/".$pname;    
$des=$_POST['description'];

        $sq = "UPDATE watch SET name='$na', photo='$pname', price='$pr', description='$des' WHERE id=$i";
        $qr=mysqli_query($conn, $sq) or die(mysqli_error($conn));
        if($qr){
            move_uploaded_file($tmpname, $updlocation);
            move_uploaded_file($tmpnamep, $updlocationp);
            header("Location: editcat.php?msg=RecordUpdated");
        }
    }

?>