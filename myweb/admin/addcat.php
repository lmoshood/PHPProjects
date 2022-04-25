<?php
require_once '../dbconnect.php';
$output = array();

$name = $_POST['name'];
$description = $_POST['description'];

$sql = "INSERT INTO category(name, description) values('$name', '$description')";
$result = $con->query($sql);
if($result){
  $output['message'] = 'success';
}else{
    $output['message'] = 'error';
    $output['error'] = 'Error occured'.  $con->error;
}
echo json_encode($output);
?>