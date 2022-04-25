<?php
require_once 'dbconnect.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Product Page</title>
  <?php include_once 'bootstrap.php'; ?>
  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-dark">
  <div class="container">
  <div class="row">
  
 
    
        <?php
        $sql = "SELECT * FROM PRODUCTS ";
        $result = $conn->query($sql);
        $id = 0;
        if ($result->num_rows > 0) {
          foreach ($result as $row) {
        ?>
            <div class="card m-2 col-4">
              <img src="images/<?Php echo $row["image"] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?Php echo $row["productname"] ?></h5>
                <p class="card-text"><?Php echo $row["price"] ?></p>
                <a href="#" class="btn btn-primary">Add to Cart</a>
              </div>
            </div>
        <?php

          }
        }
        ?>
      </div>
    <?php
    include 'bootstrap.php'
    ?>
</body>

</html>