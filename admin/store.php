<?php
session_start();
include("../co.php");

// Fetch new arrivals (assuming arrival = 'new')
$newArrivalsSql = "SELECT * FROM watch WHERE arrival = 'new' ORDER BY id";
$newArrivalsQry = mysqli_query($conn, $newArrivalsSql) or die(mysqli_error($conn));

// Fetch old arrivals (assuming arrival = 'old')
$oldArrivalsSql = "SELECT * FROM watch WHERE arrival = 'old' ORDER BY id";
$oldArrivalsQry = mysqli_query($conn, $oldArrivalsSql) or die(mysqli_error($conn));
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
<?php include("headerad.php"); ?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        $newCount = mysqli_num_rows($newArrivalsQry);
        for ($i = 0; $i < $newCount; $i++): ?>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $i + 1 ?>"></button>
        <?php endfor; ?>
    </div>
    <div class="carousel-inner">
        <?php
        $first = true;
        while ($row = mysqli_fetch_array($newArrivalsQry)) {
            ?>
            <div class="carousel-item <?= $first ? 'active' : '' ?>">
                <img src="<?php echo "../uploads/img/" . $row['photo']; ?>" width="1260" height="710" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5><?php echo $row['name']; ?></h5>
                    <p><?php echo $row['description']; ?></p>
                    <p><a href="#" class="btn btn-warning mt-3"> Buy A Watch</a></p>
                </div>
            </div>
            <?php
            $first = false;
        }
        ?>
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

<div class="container py-3">
    <div class="row mt-5">
        <?php
        $oldCount = mysqli_num_rows($oldArrivalsQry);
        if ($oldCount >= 1) {
            while ($row = mysqli_fetch_array($oldArrivalsQry)) {
                ?>
                <div class="col-md-3 mt-3">
                    <div class="card h-100" style="width: 18rem;">
                        <button class="unstyled-button" onclick="myFunction()">
                            <img src="../img/fav.png" alt="fav" style="width:20px;height:20px;float:right;">
                        </button>
                        <script>
                        function myFunction() {
                            alert("admin cannot add to cart");
                        }
                        </script>
                        <img src="<?php echo "../uploads/img/" . $row['photo']; ?>" class="card-img-top" style="width: 250px;height: 300px;" alt="...">
                        <div class="card-body d-flex flex-column">
                            <button class="unstyled-button" onclick="myFunction()">
                                <img src="../img/cart.png" alt="cart" style="width:20px;height:20px;float:right;">
                            </button>
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description'] ?></p>
                            <b><p class="card-text"><?php echo "Rs. " . $row['price'] ?></p></b>
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
        <p class="text-white"><span class="text-warning">Watch HERE -</span><?php echo date("Y"); ?> @ All Rights Reserved </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
