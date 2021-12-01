
<?php


if(isset($_POST["signIn"])) {
    $username = $_POST["name"];
    $pwd = $_POST["pwd"];

    require 'database.phtml';
    require 'functions.php';

    if (emptyinputLogin($username, $pwd) !== false) {
        header("location: index.phtml?empty");
        exit();
    }

    loginUser($conn, $username, $pwd);
}
    else
    {
        header("location: index.phtml?emptyfields");
        exit();
}




