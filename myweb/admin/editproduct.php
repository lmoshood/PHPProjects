<?php
require_once 'dbconnect.php';
$id = $_GET['id'];
if(isset($id)){
    $sql = "SELECT * FROM PRODUCTS WHERE id=$id";
    $result = $con->query($sql);
    foreach($result as $row){
        $productname = $row['productname'];
        $qty = $row['quantity'];
        $price = $row['price'];
        $img = $row['image'];
    }
}else{
    echo "<script> alert('Product must be selected!')</script>";
    echo "<script> window.location.href='index.php' </script>";
}


if(isset($_POST['save']) ){
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
          unlink( $upload_dir.$img);
          move_uploaded_file($tmp_name, $upload_dir.$image)
        }else{ echo "<script> alert('Image too large')</script>"; }
    
      }else{
        echo "<script> alert('Sorry only JPG, JPEG, PNG, GIF files are allowed')</script>";
      }
    
    
    }else{
      $image = $img;
    }
    

$sql = "UPDATE PRODUCTS SET productname = '$productname', quantity = '$qty', price = '$price', image = $image where id=$id";
$result = $con->query($sql);
if($result){
    
    echo "<script> alert('Product updated successfully')</script>";
    //header("REFRESH:3; index.php");
    echo "<script> window.location.href='index.php' </script>";
}else{
    echo "<script> alert('Product not updated successfully')</script>";
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
    <input type="text" class="form-control" id="productname" name="productname" value="<?php echo $productname ?>">  
  </div>
  
  <div class="form-group">
    <label for=""> Product Quantity</label>
    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $qty ?>">  
  </div>
  
  <div class="form-group">
    <label for=""> Product Price</label>
    <input type="text" class="form-control" id="price" name="price" value="<?php echo $price ?>">  
  </div>
  <div class="form-group">
    <label for=""> Product Image</label>
    <img src="../images/<?php echo $img ?>" alt="">
    <input type="file" class="form-control" id="image"  accept="image/*" name="image">  
  </div>
  
  <button type="submit" name="save" class="btn btn-primary">Submit</button>
</form>
</div> 
<?php include_once 'footer.php'; ?>
</body>
</html>
