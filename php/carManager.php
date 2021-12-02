<?php
include_once 'database.phtml';
$make = $_POST['make'];
$model = $_POST['model'];
$type = $_POST['type'];

?>
<?php


$sql = "INSERT INTO cars (car_make, car_model, car_type) VALUES ('$make', '$model', '$type');";
mysqli_query($conn, $sql);
header("Location: html/admin.phtml?car added");
?>