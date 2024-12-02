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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#"><span class="text-warning">Watch</span>Here</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              
            <form class="d-flex" method ="post" name="search" action="searchadmin.php">
             <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
              <li class="nav-item">
                <a class="nav-link" href="store.php">Store</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="addcategory.php">Add Categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="editcat.php">Edit Categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="user.php">Users</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="../logout.php">logout</a>
              </li>

              
            </ul>
            
          </div>
        </div>
        <!-- <footer class="bg-dark p-2 text-center">
    <div class="container">
      <p class="text-white">All Rights Reserve @<span class="text-warning">Watch</span>HERE</p>
    </div>
    </footer>  -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script> 
</nav>
</body>
</html>