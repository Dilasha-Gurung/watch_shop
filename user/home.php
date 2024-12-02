<?php
session_start();
include("../co.php");
if (isset($_GET['id'])) {  
  $id = $_GET['id']; 
  $uid = $_SESSION["id"]; 
  
  // Check if the book is already bookmarked by the user
  $sql_check = "SELECT * FROM favorite WHERE fid = $id AND uid = $uid";
  $result_check = mysqli_query($conn, $sql_check);
  $count = mysqli_num_rows($result_check);

  if ($count == 0) {
      // If not bookmarked, insert into database
      $sql_insert = "INSERT INTO favorite (fid, uid) VALUES ($id, $uid)";
      $result_insert = mysqli_query($conn, $sql_insert);

      if ($result_insert) {
        $bookmark_added = true;
        if (!empty($bookmark_added)) {
         echo '<script type="text/javascript">
             window.addEventListener("load", myFunction);
             function myFunction() {
                 alert("Book added to favorite list");
             } 
             </script>'; 
       }

   }
}
else{
  echo '<script type="text/javascript">
             window.addEventListener("load", myFunction);
             function myFunction() {
                 alert("Book already added to favorite list");
             } 
             </script>'; 
}
}

$sql="SELECT * FROM watch ORDER BY id";
$qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
  <?php
  include("headeruser.php");
  ?>
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../rol1.png" width="1260" height="710" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5>Sky-Dweller</h5>
                <p>Besides the intrinsic quality of the stones, several other criteria contribute to the beauty 
                    of Rolex gem-setting: the precise alignment of the height of the gems </p>
                <p><a href="#" class="btn btn-warning mt3"> Buy A Watch</a></p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../rol2.jpeg" width="1260" height="710" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5>FOSSIL watch GRANT</h5>
                <p>FOSSIL watch GRANT - FS4736 - Case width: 44mm, Strap Colour: Silver, Dial Colour: Black,
                Water resistant: 5ATM, Material: Stainless Steel, Case thickness: 12.00, Gender: Male  </p>
                <p><a href="#" class="btn btn-warning mt3"> Buy A Watch</a></p>
            </div>
        </div>
          <div class="carousel-item">
            <img src="../rol3.jpg" width="1260" height="710" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5>Pilot Quartz Worldtimer</h5>
                <p>This Startimer Pilot Quartz Worldtimer comes in a 41mm case with a calf leather strap and a quartz movement. 
                    The watch offers hours, minutes, seconds, GMT, Worltimer and date at 3 o'clock features.</p>
                <p><a href="#" class="btn btn-warning mt3"> Buy A Watch</a></p>
            </div>
        </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
     </div>
     </div>
    </section>
    <div class="container py-3">
    <div class="row mt-5">
        <?php
        $count = mysqli_num_rows($qry);
        if ($count >= 1) {
            while ($row = mysqli_fetch_array($qry)) {
        ?>
                <div class="col-md-3 mt-3">
                    <div class="card h-100" style="width: 18rem;">
                        <a href="<?php echo 'home.php?id=' . $row['id']; ?>"><img src=../img/fav.png alt=fav style=width:20px;height:20px;float:right;></a>
                        <a href="detail.php?id=<?php echo $row['id']; ?>"><img src="<?php echo "../uploads/img/" . $row['photo']; ?>" class="card-img-top" style="width: 250px;height: 300px;" alt="..."></a>
                        <div class="card-body d-flex flex-column">
                        <!-- <button class="unstyled-button" onclick="myFunction()"><img src=../img/cart.png alt=cart style=width:20px;height:20px;float:right;></button> -->
                         <a href="detail.php?id=<?php echo $row['id']; ?>">
                        <!-- <button class="unstyled-button" onclick="myFunction()"> -->
                        <button class="unstyled-button" >
                        <img src="../img/cart.png" alt="cart" style="width:20px;height:20px;float:right;">
                        </button>
                        </a> 
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        
                       

                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description'] ?></p> 
                            <b> <p class="card-text"><?php echo "Rs. ".$row['price'] ?></p></b>
                          </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<h1>Sorry no record Found</h1>";
        }
        ?>
    </div>
</div>
       <!-- Footer  -->
    <footer class="bg-dark p-2 text-center">
    <div class="container">
      <p class="text-white">All Rights Reserve @<span class="text-warning">Watch</span>HERE</p>
    </div>
    </footer> 


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script> 

</body>
</html>