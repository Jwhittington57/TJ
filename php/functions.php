<?php
function uidExists($conn,$username)
{
    $sql = "SELECT * FROM `cust_login` WHERE usrname = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("Location: ../index.phtml?error=sqlerror");
        exit();
    }

    mysqli_stmt_bind_Param($stmt, "s",$username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }

    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}




function emptyInputLogin($username, $pwd)
{
    $result;

    if(empty($username) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;

    }
    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn,$username);

    if($uidExists === false)
    {
        header("Location: ../index.phtml?error=wrongusername");
        exit();
    }
    $pwdhashed = $uidExists['pass'];
   // $checkPwd = password_verify($pwd, $pwdhashed);

    if($pwdhashed !== $pwd)
    {
        header("Location: ../index.phtml?error=wrongpass");
        exit();
    }

    else if($pwdhashed === $pwd)
    {
        session_start();
        $_SESSION["cust_id"] = $uidExists["cust_id"];
        $_SESSION["usrname"] = $uidExists["usrname"];

        header("Location: index.phtml?succss99");
        exit();
    }
}