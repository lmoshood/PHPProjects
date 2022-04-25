<?php
session_start();
require_once 'dbconnect.php';
if(isset($_POST['login'])){

    $email = strip_tags( $_POST['email']);
   
    $password = strip_tags( $_POST['password']);

    $sql = "SELECT * FROM USERS WHERE email = '$email'";
    $res = $con->query($sql);
    $row = $res->fetch_assoc();
    $hpass = $row['password'];
    $count = $res->num_rows;
    echo $count;
    if($count > 0 && password_verify($password, $hpass)){
        $_SESSION['user'] = $row['username'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['email'] = $row['email'];

        echo "<script> alert('Login successfully') </script>"; 
        echo "<script> window.location.href = 'admin/' </script>"; 
    }else{
        echo "<script> alert('email or password is not correct') </script>"; 
       
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
        <label for=""> Email</label>
        <input type="text" name="email" class="form-control" required>
    </div>

   
    <div class="form-group">
        <label for=""> Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <input type="submit" name="login" class="btn btn-primary form-control" value="Login">
    </form>
    </div>
<?php include_once 'footer.php'; ?>
</body>
</html>




