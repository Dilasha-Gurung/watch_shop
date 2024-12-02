<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product Details</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <!-- Product Image Card -->
        <div class="col-md-6">
            <div class="card">
                <img src="path/to/product-image.jpg" class="card-img-top" alt="Product Image">
                <div class="card-body text-center">
                    <h5 class="card-title">Product Name</h5>
                </div>
            </div>
        </div>

        <!-- Product Details Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Details</h5>
                    <p class="card-text">This is a detailed description of the product. It includes features, specifications, and other important information.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Price: $XX.XX</li>
                        <li class="list-group-item">Brand: Product Brand</li>
                        <li class="list-group-item">Category: Product Category</li>
                        <li class="list-group-item">Stock: In Stock</li>
                        <li class="list-group-item">Rating: ⭐⭐⭐⭐☆</li>
                    </ul>
                    <button class="btn btn-primary mt-3">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
