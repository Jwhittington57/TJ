<?php
if(isset($_POST["checkBooking"])) {
    $username = $_POST["name"];
    $car = $_POST["car"];

    require 'database.phtml';
    require 'functions.php';

    if (emptyinputLogin($username, $car) !== false) {
        header("location: bookings.phtml?empty");
        exit();
    }

    bookingRequest($conn, $username, $car);
}
else
{
    header("location: bookings.phtml?emptyfields");
    exit();
}

