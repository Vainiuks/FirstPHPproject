<?php

if (isset($_POST['login-submit'])) 
{

    require 'database.inc.php';

    $userUsernameEmail = $_POST['userUsernameemail'];
    $userpassword = $_POST['userPassword'];

    
    if (empty($userUsernameEmail) or empty($userpassword)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } 
    else {
        
        $sql = "SELECT * FROM users WHERE userUsername=? OR userEmail=?;";
        $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } 
        else {
            mysqli_stmt_bind_param($statement, "ss", $userUsernameEmail, $userUsernameEmail);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if  ($row = mysqli_fetch_assoc($result)) {

                $passwordCheck = password_verify($userpassword, $row['userPassword']);
                if ($passwordCheck == false) {
                    header("Location: ../index.php?error=wrongcridentials");
                    exit();
                }
                else if ($passwordCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['userID'];
                    $_SESSION['userusername'] = $row['userUsername'];

                    header("Location: ../index.php?login=success");
                    exit();
                } else {
                    header("Location: ../index.php?error=wrongcridentials");
                    exit();
                }

            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }

    } 
    
    

} else 
{
header("Location: ../login.php");
exit();  
}

