<?php
require_once 'dbconnect.php';
if(isset($_POST['save'])){
$productname = $_POST['productname'];
$qty = $_POST['quantity'];
$price = $_POST['price'];

if($_FILES['image']){
  $imgFile = $_FILES['image']['name'];
  $tmp_name = $_FILES['image']['tmp_name'];
  $imgSize = $_FILES['image']['size'];
  $upload_dir = '../images';
  // image extension
  $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION ));
  //valid image extensions
  $valid_ext = array('jpeg', 'jpg', 'png', 'gif');
  
// rename uploaded image
  $image = rand(1000, 10000000). ".". $imgExt;
  // image size less than 5MB
  if(in_array( $imgExt, $valid_ext)){
    if($imgSize <= 5000000){
      move_uploaded_file($tmp_name, $upload_dir.$image)
    }else{ echo "<script> alert('Image too large')</script>"; }

  }else{
    echo "<script> alert('Sorry only JPG, JPEG, PNG, GIF files are allowed')</script>";
  }


}else{
  $image = 'noimage.jpg';
}

$sql = "INSERT INTO PRODUCTS(productname, quantity, price, image)  
VALUES('$productname', '$qty', '$price', '$image')";
$result = $con->query($sql);
if($result){
    echo "<script> alert('Product created successfully')</script>";
}else{
    echo "<script> alert('Product not created successfully')</script>";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once 'header.php'; ?>
    <title>Document</title>
</head>
<body>
<div class="container"> </div> 
   <div class="container">
<form class="py-5" method="post">
  <div class="form-group">
    <label for=""> Product Name</label>
    <input type="text" class="form-control" id="productname" name="productname" required>  
  </div>
  
  <div class="form-group">
    <label for=""> Product Quantity</label>
    <input type="number" class="form-control" id="quantity" name="quantity">  
  </div>
  
  <div class="form-group">
    <label for=""> Product Price</label>
    <input type="text" class="form-control" id="price" name="price" required>  
  </div>
  
  <div class="form-group">
    <label for=""> Product Image</label>
    <input type="file" class="form-control" id="image"  accept="image/*" name="image">  
  </div>

  <button type="submit" name="save" class="btn btn-primary">Submit</button>
</form>
</div> 
<?php include_once 'footer.php'; ?>
</body>
</html>