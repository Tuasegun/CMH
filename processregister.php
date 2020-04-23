<?php session_start();
require_once("functions/user.php");
require_once("functions/redirect.php");
require_once("functions/alert.php");
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

$_SESSION['first_name'] =  $first_name;
if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
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
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["error"] = "Invalid email address ";
    header("Location:register.php");
    die();
}


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
        
       $userObject = [
        'id' => uniqid(),
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
            set_alert('error', "Registration Failed, User already exists ");
            redirect_to("register.php");
            die();
        }
    //save in the database;

    save_user($userObject);
    set_alert('message', "Registration Successful, You can now login " . $first_name);
    redirect_to("login.php");

}

   

/*
collecting data
verifying data
saving the data
return to the page with a status message
*/
