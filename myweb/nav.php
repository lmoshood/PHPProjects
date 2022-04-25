<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      </ul>
     
      <a href="cart.php">
        <button class="btn btn-outline-success" type="submit">
<?php
$cart = 0;
if(!empty($_SESSION["cart"])){
    $cart = count($_SESSION["cart"]);
    echo "<span>Cart $cart  </span>";
}else{
  echo  "<span>Cart $cart  </span>";
}
?>

        </button>
        </a>
    </div>
  </div>
</nav>