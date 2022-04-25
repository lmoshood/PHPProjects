<?php
session_start();
if(!isset($_SESSION['email']) && $_SESSION['email'] != 'wale@yahoo.com'){
  header("location: ../index.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once '../header.php'; ?>
    <title>Products</title>
  </head>
  <body>
      <div class="container">
      <?php include_once 'nav.php'; ?>
        <div><a href="addproduct.php">Add Product</a> <?php echo $_SESSION['email']; ?></div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th>image</th>
      <th scope="col"> Edit/Delete</th>
    </tr>
  </thead>
  <tbody>
<?php
require_once '../dbconnect.php';
if(isset($_GET['id']) ){
  $id = $_GET['id'];

  $sql = "DELETE FROM PRODUCTS  where id=$id";
  $result = $con->query($sql);
  
  if($result){
    header("location: index.php");     
  }else{
      echo "<script> alert('Product not deleted successfully')</script>";
  }


}


$sql = "SELECT * FROM PRODUCTS order by id desc";
$result = $con->query($sql);

if($result->num_rows > 0){
    // print_r($result);
    $no = 1;
foreach($result as $row){
  ?>
    <tr> 
        <td><?php echo $no; ?></td>
    <td> <?php echo $row['productname']; ?></td>  
    <td><?php echo $row['quantity']; ?></td>  
    <td><?php echo $row['price']; ?></td> 
    <td> <img style="width: 50px; heigth: 50px;" src="../images/<?php echo $row['image']; ?>" alt=""> </td>
    <td>
      <a href="editproduct.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-warning"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg> Edit</button></a>
    
      <a href="?id=<?php echo $row['id']; ?>"><button type="button" onclick="confirm('Are sure you want to the product?')" class="btn btn-danger"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg> Delete</button></a>
    </td>
    </tr>
    
 <?php  
 $no++; 
}


}else{
    echo 'No record found';
}


?>
</tbody>
</table>
</div>
    
<?php include_once '../footer.php'; ?>
  </body>
</html>