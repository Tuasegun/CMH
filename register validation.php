<?php
$_SESSION['first_name'] =  $first_name;
    if(!preg_match("/^[a-zA-Z]*$/",$first_name)){
    $_SESSION["error"] = "Invalid Name";
    header("Location:register.php");
    die();
    }
    $_SESSION['last_name'] =  $last_name;
    if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
    $_SESSION["error"] = "Invalid Name";
    header("Location:register.php");
    die();
    }
        $_SESSION['email'] = $email;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION["error"] = "Invalid email address ";
    header("Location:register.php");
    die();
    }
