<?php
include_once 'database.phtml';
$make = $_POST['make'];
$model = $_POST['model'];
$type = $_POST['type'];

?>
<?php

if (isset($_POST["add"])) {
    $sql = "INSERT INTO cars (car_make, car_model, car_type) VALUES ('$make', '$model', '$type');";
    mysqli_query($conn, $sql);
    header("Location: ../html/success.html?car added");
}

if (isset($_POST["remove"])) {
    $username = $_POST["name"];
    $car = $_POST["car"];
    $sql = "DELETE FROM cars WHERE car_model = '$make';";
    mysqli_query($conn, $sql);
    header("Location: ../html/success.html?car removed");
}
