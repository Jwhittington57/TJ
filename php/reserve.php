<?php
if(isset($_POST["ChangeRes"])) {
    include_once 'database.phtml';
$username = $_POST['username'];
$start = $_POST['start_date'];
$end = $_POST['end_date'];
$car = $_POST['car'];


$sql = "UPDATE reservation  SET start_date = '$start', end_date = '$end', car = '$car' WHERE username = '$username';";
mysqli_query($conn, $sql);
header("Location: ../html/success.html?reservation_updated");
}


if(isset($_POST["ReserveNow"])) {
    include_once 'database.phtml';
    $username = $_POST['username'];
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $car = $_POST['car'];


    $sql = "INSERT INTO reservation (username, start_date, end_date, car) VALUES ('$username', '$start', '$end', '$car');";
    mysqli_query($conn, $sql);
    header("Location: ../html/Reservation.phtml?reservation_success");

}
