<?php
session_start();
//unset($_SESSION["cart"]);
if(isset($_POST['addtocart'])){

  if(isset($_SESSION["cart"])){

    $item_array = array_column($_SESSION["cart"], "itemid");
    if(!in_array($_POST['id'], $item_array)){
        $count = count($_SESSION["cart"]);
        
      $items = array(
        'itemid' => $_POST['id'],
        'itemquantity' => $_POST['quantity'],
        'itemname' => $_POST['productname'],
        'itemprice' => $_POST['price']
      );
      $_SESSION["cart"][$count] = $items;
      // print_r($_SESSION["cart"]);
    }else{
      echo "<script> alert('Item already added to cart') </script>"; 
    }

  }else{
// first
$items = array(
  'itemid' => $_POST['id'],
  'itemquantity' => $_POST['quantity'],
  'itemname' => $_POST['productname'],
  'itemprice' => $_POST['price']
);

$_SESSION["cart"][0] = $items;

  }


 // print_r($_SESSION["cart"]);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once 'header.php'; ?>
    <title>Products</title>
  </head>
  <body>
      <div class="container">
      <?php include_once 'nav.php'; ?>
      
 <div class="row">
<?php
require_once 'dbconnect.php';
$sql = "SELECT * FROM PRODUCTS order by id desc";
$result = $con->query($sql);
if($result->num_rows > 0){
    // print_r($result);
    
foreach($result as $row){
  ?>
   <div class="card m-2 col-3">
  <form method="post"> 
  
            <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="productname" value="<?php echo $row["productname"] ?>">
            <input type="hidden" name="price" value="<?php echo $row["price"] ?>">



              <img src="images/<?php echo $row["image"] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row["productname"] ?></h5>
                <p class="card-text"><?php echo $row["price"] ?></p>
                <input type="submit" name="addtocart" class="btn btn-primary" value="Add to Cart" >
              </div>
     </form>
     </div>
 <?php  
 
}


}else{
    echo 'No record found';
}


?>
</div>

</div>
    
<?php include_once 'footer.php'; ?>
  </body>
</html>