<?php
session_start();
if(isset($_GET['action'])){
    if($_GET['action'] == "delete"){
        foreach ($_SESSION["cart"] as $key => $value) {
            if($value['itemid'] == $_GET['id']){
                unset($_SESSION["cart"][$key]);
                echo "<script>alert('Item Removed')  </script>";
            }
        }
    }
    if($_GET['action'] == "empty"){
                unset($_SESSION["cart"]);
    }
}

if(isset($_POST['update'])){
    // Update
    if(isset($_SESSION["cart"])){
        foreach ($_SESSION["cart"] as $key => $value) {
            if($value['itemid'] == $_POST['id']){
                $_SESSION["cart"][$key]['itemquantity']  = $_POST['quantity'];
                echo "<script>alert('Item quantity Updated to ".$_SESSION["cart"][$key]['itemquantity']."')  </script>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once 'header.php'; ?>
</head>
<body>
<div class="container">
<h3> Order Details</h3>
<table class="table">
<thead>
    <tr>
        <th>Product Name</th>
        <th>Product Quantity</th>
        <th>Product Price</th>
        <th> Total</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
    
    if(!empty($_SESSION["cart"])) {
        $total = 0;
        foreach ($_SESSION["cart"] as $key => $value) {
            $tp = $value["itemquantity"] * $value["itemprice"];
            ?>
            <form action="" method="post">
            <tr>
            <input type="hidden" name="id" value="<?php echo $value["itemid"] ?>">
                <td><?php echo $value["itemname"]; ?></td>
                <td><input type='number' class='form-control' name='quantity' value='<?php echo $value["itemquantity"]; ?>'> </td>
                <td align='right'><?php echo $value["itemprice"]; ?></td>
                
                <td align='right'><?php echo number_format( $tp, 1); ?></td>

                <td>
                <button type='submit' name='update' class='btn btn-warning'>  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg>    </button>
                
                <a class='btn btn-danger' href='cart.php?action=delete&id=<?php echo $value["itemid"]; ?>'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg> </a></td>
            </tr>
            </form>
            <?php
            $total = $total +  $tp;
        }
        echo "<tr>";
       echo "<td colspan='3' align='right'>Total</td>";
      echo  " <td align='right'>" . number_format( $total, 1) . " </td>";

      echo "</tr>";
        // proceed to checkout
      echo "<tr>";
       echo " 
       
       <td colspan='3' align='right'> <a class='btn btn-primary' href='checkout.php?totalamount=".$total."'>Proceed to checkout </a></td>";
      

      echo "</tr>";
    }else{
        echo "<tr>";
        echo " <td colspan='4'> Your cart is empty </td>";
        echo "</tr>";
    }
    
    echo "<tr>";
    echo " <td align='right'> <a class='btn btn-success' href='index.php'>Continue shopping </a> </td";
    echo "<td>  <a class='btn btn-danger' href='cart.php?action=empty'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-alt' viewBox='0 0 16 16'>
    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
    <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
  </svg> Empty Cart </a> </td>";
    echo "</tr>";
    ?>
</tbody>

</table>

</div>
</body>
</html>