<?php
include_once 'database.phtml';
$usrname = $_POST['usrname'];
$pass = $_POST['pass'];
?>
<?php


$sql = "INSERT INTO cust_login (usrname, pass) VALUES ('$usrname', '$pass');";
mysqli_query($conn, $sql);
header("Location: ../html/Signin.html");

