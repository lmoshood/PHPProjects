<?php
require_once 'dbconnect.php';


if(isset($_POST['register'])){

$fname = strip_tags($_POST['firstname']);

$lname = strip_tags( $_POST['lastname']);
$email = strip_tags( $_POST['email']);
$username = strip_tags( $_POST['username']);
$password = strip_tags( $_POST['password']);

$hpass = password_hash($password, PASSWORD_DEFAULT);
$sql = "SELECT * FROM USERS WHERE email = '$email'";
$res = $con->query($sql);
$count = $res->num_rows;
if($count > 0){
    echo "<script> alert('Account already exists') </script>"; 
}else{

    $sql = "INSERT INTO USERS(firstname, lastname, email,username, password) values('$fname','$lname','$email','$username','$hpass')";
    $result = $con->query($sql);
    if($result){
        echo "<script> alert('Registered successfully') </script>"; 
        echo "<script> window.location.href = 'login.php' </script>"; 
    }else{
        echo "<script> alert('Account not created') </script>"; 
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
    <?php include_once 'header.php'; ?>
    <title>Document</title>
</head>
<body>
    <div class="container">
    <form action="" method="post" class="my-5">

    <div class="form-group">
        <label for=""> First Name</label>
        <input type="text" name="firstname" class="form-control" required>
    </div>

    <div class="form-group">
        <label for=""> Lasst Name</label>
        <input type="text" name="lastname" class="form-control" required>
    </div>


    <div class="form-group">
        <label for=""> Email</label>
        <input type="text" name="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for=""> User Name</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label for=""> Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <input type="submit" name="register" class="btn btn-primary form-control" value="Register">
    </form>
    </div>
<?php include_once 'footer.php'; ?>
</body>
</html>