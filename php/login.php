<?php
if (isset($_POST['signIn']))
{
    require 'database.phtml';
    $usrname = $_POST['usrname'];
    $pass = $_POST['pass'];

    if(empty(  $usrname || $pass  ))
    {
        header("Location: ../index.phtml?error=emptyfields");
    }
    else
    {
        $sql = "SELECT * FROM cust_login WHERE usrname=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../index.phtml?error=sqlerror");
            exit();
        }

        else
        {
            mysqli_stmt_bind_param($stmt, "ss",$pass, $pass);
            mysqli_stmt_execute($stmt);
            $result = mysqli_smt_get_result();
            if($row = mysqli_fetch_assoc($result))
            {
              $passCheck = password_verify($pass, $row['pass']);
              if($passCheck == false )
                  {
                      header("Location: ../index.phtml?error=wrongpassword");
                      exit();
                  }
              elseif ($passCheck == true)
              {
                  session_start();
                  $_SESSION[] = $row['cust_id'];
                  $_SESSION[] = $row['usrname'];

                  header("Location: ../index.phtml?SUCCESS99");
                  exit();
              }
            }
            else
            {
                header("Location: ../index.phtml?error=nouser");
                exit();
            }
        }
    }
}
/*
else {
    header("Location: ../index.phtml?signup=success1");
    exit();
}
*/