<?php
session_start();
include("../co.php");

$id = $_GET['id'] ?? null;

if ($id) {
    // Using procedural style to prevent SQL injection
    $sql = "SELECT * FROM watch WHERE id = " . intval($id);
    $qry = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}
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
  <?php include("headeruser.php"); ?>
  <div class="container mt-5">
    <div class="row">
        <form onsubmit="return validateInput()">
        <?php
        if ($qry && mysqli_num_rows($qry) > 0) {
            $row = mysqli_fetch_array($qry);
        ?>
        <!-- Product Image Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="text-center">
                    <img src="<?php echo "../uploads/img/" . $row['photo']; ?>" class="card-img-top" style="width: 250px;height: 300px;" alt="...">
                </div>  
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                </div>
            </div>
        </div>

        <!-- Product Details Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Details</h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                    <ul class="list-group list-group-flush">
                        <b><p class="card-text"><?php echo "Rs. " . $row['price']; ?></p></b>
                        <li class="list-group-item"><?php echo $row['brand']; ?></li>
                        <li class="list-group-item">Category: Product Category</li>
                        <li class="list-group-item"><?php echo $row['stock']; ?></li>
                        <li class="list-group-item">Rating: ⭐⭐⭐⭐☆</li>
                        <div class="mt-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" id="numberInput" name="quantity" min="1" max="20" required>
                        </div>
                    </ul>
                    
                    <!-- <button class="btn btn-primary mt-3" type="submit">Add to Cart</button> -->
                    <a href="cart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary mt-3"> Add to Cart </a>
                    <p id="errorMessage"></p>
                </div>
            </div>
        </div>
        <?php
        } else {
            echo "<h1>Sorry, no record found</h1>";
        }
        ?>
        </form>
    </div>
  </div>

<script>
    function validateInput() {
        const numberInput = document.getElementById('numberInput').value;
        const errorMessage = document.getElementById('errorMessage');

        // Clear previous error messages
        errorMessage.textContent = '';

        // Check if the number is within the range
        if (numberInput < 1 || numberInput > 20) {
            errorMessage.textContent = 'Please enter a number between 1 and 20.';
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>
</body>
</html>
