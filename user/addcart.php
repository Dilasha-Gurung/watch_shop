<?php
session_start();
include("../co.php");
if (isset($_GET['id']) && isset($_GET['quantity'])) {  
  $id = $_GET['id']; 
  $uid = $_SESSION["id"]; 
  $qid = $_GET['quantity'];

 //Check if the book is already bookmarked by the user
   $sql_check = "SELECT * FROM cart WHERE cid = $id AND ucid = $uid";
   $result_check = mysqli_query($conn, $sql_check);
   $count = mysqli_num_rows($result_check);

   if ($count == 0) {
       // If not bookmarked, insert into database
       $sql_insert = "INSERT INTO cart (cid, ucid, quantity) VALUES ($id, $uid,$qid)";
       $result_insert = mysqli_query($conn, $sql_insert);

       if ($result_insert) {
         $cart_added = true;
         if (!empty($cart_added)) {
          echo '<script type="text/javascript">
              window.addEventListener("load", myFunction);
              function myFunction() {
                  alert("cart added to cart list");
                  window.location.href = "cart.php"; 
              } 
              </script>'; 
              // header("cart.php");
        }

    }
 }
 else{
   echo '<script type="text/javascript">
              window.addEventListener("load", myFunction);
              function myFunction() {
                  alert("cart already added to cart list");
              } 
              </script>'; 
 }
 }

 $sql="SELECT * FROM watch ORDER BY id";
 $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
 //Check if $id exists in the watch table



?>