<?php


if (isset($_POST["signIn"])) {
    $username = $_POST["name"];
    $pwd = $_POST["pwd"];

    require 'database.phtml';
    require 'functions.php';

    if (emptyinputLogin($username, $pwd) !== false) {
        echo "
            <script>
            alert('Empty username or password.');
               window.location.href='../html/Signin.html'
            </script>
        ";
        exit();
    }

    loginUser($conn, $username, $pwd);
} else {
    echo "
            <script>
            alert('Empty Password username or password.');
               window.location.href='../html/Signin.html'
            </script>
        ";
    exit();
}




