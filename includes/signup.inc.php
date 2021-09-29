<?php
if (isset($_POST['signup-submit'])) {
    
    require 'database.inc.php';

    $username = $_POST['userUsername'];
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];
    $passwordRepeat = $_POST['userPassword-repeat'];

    //Check if fields are empty
    if (empty($username) or empty($email) or empty($password) or empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&userUsername=".$username."&userEmail=".$email);
        exit();
    }
    //Check if username and email are not valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) and !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusernameandemail");
        exit();
    }
    //Check if email is not valid with FILTER_VALIDATE_EMAIL filter
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidEmail&userUsername=".$username);
        exit();
    }
    //Check if username is not valid. Username includes a-z A-Z 0-9 noting more
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidUsername&userEmail=".$email);
        exit();
    }
    //Check if password and repeated password are not the same
    else if ($password != $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&userUsername=".$username."&userEmail=".$email);
        exit();
    }
    else {

        //Using prepared statement check if there is no taken username in database

        $sql = "SELECT userUsername FROM users WHERE userUsername=?";
        $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            //s = string, i = integer, B = blob, d = double
            //Can be multiple parameters
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $usernameCheck = mysqli_stmt_num_rows($statement);
            if ($usernameCheck > 0) {
                header("Location: ../signup.php?error=usertaken&userEmail=".$email);
                exit();
            }
            else {

                $sql = "SELECT userEmail FROM users WHERE userEmail=?";
                $statement = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($statement, $sql)) {
                         header("Location: ../signup.php?error=sqlerror");
                         exit();
                }
                    mysqli_stmt_bind_param($statement, "s", $email);
                    mysqli_stmt_execute($statement);
                    mysqli_stmt_store_result($statement);
                    $emailCheck = mysqli_stmt_num_rows($statement);
                    if ($emailCheck > 0) {
                        header("Location: ../signup.php?error=emailtaken&userUsername=".$username);
                        exit();
                    } 
                    else {
                        //Using prepared statement inserst user into database also hash the password
                        $sql = "INSERT INTO users (userUsername, userEmail, userPassword ) VALUES (?, ?, ?)";
                        $statement = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($statement, $sql)) {
                            header("Location: ../signup.php?error=sqlerror");
                            exit();
                        } else {
        
                            //Hashing password
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
                            mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);
                            mysqli_stmt_execute($statement);
                            header("Location: ../signup.php?signup=success");
                            exit();
                    
                        }
                    }
            }
        }
    }
    //End prepared statement process
    mysqli_stmt_close($statement);
    //Close db connection
    mysqli_close($conn);


} else {
    header("Location: ../signup.php");
    exit();
}