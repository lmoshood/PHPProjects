<?php
session_start();
if(isset($_SESSION)){

    unset($_SESSION['email']);
    unset($_SESSION['user']);
    unset($_SESSION['firstname']);
    session_destroy();
}

header("location: index.php");
?>