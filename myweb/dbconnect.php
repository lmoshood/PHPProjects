<?php
error_reporting(0);
$server ='localhost';
$username = 'root';
$password = '';
$dbname = 'myweb';
$con = new mysqli($server, $username, $password, $dbname);

if($con->connect_errno){
    die('Connection error ' . $con->connect_error);
}
// else{
//     echo 'Connected Successfully';
// }

function check($field){
    if(empty($field)){
        echo "<script> alert('field is required') </script>";
        return false;
        exit();
    }else{
    return strip_tags($field);
    }
    }

?>


