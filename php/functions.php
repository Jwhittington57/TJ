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

function uidExistsBooking($conn,$username)
{
    $sql = "SELECT * FROM `reservation` WHERE username = ?;";
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

    if($username = "admin" && $pwd = "0000")
    {
        header("Location: admin.phtml");
        exit();
    }

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

        header("Location: loggedin.phtml?succss99");
        exit();
    }
}

function bookingRequest($conn, $username, $car)
{
    $uidExists = uidExistsBooking($conn,$username);


    if($uidExists === false)
    {
        header("Location: ../index.phtml?error=wrongusername");
        exit();
    }
    $carhashed = $uidExists['car'];
    // $checkcar = password_verify($car, $carhashed);

    if($carhashed !== $car)
    {
        header("Location: ../index.phtml?error=wrongpass");
        exit();
    }

    else if($carhashed === $car)
    {

        session_start();
        $_SESSION["username"] = $uidExists["username"];
        $_SESSION["car"] = $uidExists["car"];
        $_SESSION["start_date"] = $uidExists["start_date"];
        $_SESSION["end_date"] = $uidExists["end_date"];

        $result = mysqli_query($conn,"SELECT * FROM `reservation`");
        if(mysqli_num_rows($result) > 0){
            while($data = mysqli_fetch_assoc($result)){
                echo "start date: ".$data["start_date"]. " ";
                echo "end date: ".$data["end_make"]. " ";
                echo "Reserved Car: ".$data["car"]. " ";

            }
        }
        else{
            echo "No Records Found!";
        }

        header("Location: ../phtml/bookings.phtml?succss99");
        exit();
    }
}