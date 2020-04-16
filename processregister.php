<?php session_start();
    require_once("functions/user.php");
//Counting the data
$errorCount = 0;


$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] : $errorCount++ ;
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] : $errorCount++;
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorCount++;
$designation = $_POST['designation'] != "" ? $_POST['designation'] : $errorCount++;
$department = $_POST['department'] != "" ? $_POST['department'] : $errorCount++;

$_SESSION['first_name'] =  $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;


if ($errorCount > 0) {
    //redirect back, display the error
    $session_error = "You have " . $errorCount . " error";

    if ($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your submission";
    $_SESSION["error"] = $session_error;

    header("Location:register.php?");

} else {
    //count all users
        $newUserId = ($countAllUsers-1);
       $userObject = [
        'id' => $newUserId,
        'first_name'=> $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => password_hash($password,PASSWORD_DEFAULT),
        'gender' => $gender,
        'designation' => $designation,
        'department' => $department
    ];

    //loop
    $userExists = find_user($email);

        if($userExists){
            $_SESSION["error"] = "Registration Failed, User already exists ";
            header("Location:register.php");
            die();
        }
    //save in the database;

    save_user($userObject);
    $_SESSION["message"] = "Registration Successful, You can now login " . $first_name;
    header("Location:login.php");

}

   

/*
collecting data
verifying data
saving the data
return to the page with a status message
*/
