<?php session_start();
require_once("functions/alert.php");
require_once("functions/email.php");
require_once("functions/redirect.php");
require_once("functions/token.php");
require_once("functions/user.php");

$errorCount = 0;


$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['email'] = $email;

if($errorCount > 0){
    //redirect back, display the error
    $session_error = "You have " . $errorCount . " error";

    if($errorCount > 1){
        $session_error .= "s";
    }

    $session_error .= " in your submission";
    set_alert('error', $session_error);

    redirect_to("login.php?");
} else {
            $currentUser = find_user($email);

             if ($currentUser) {
                 //check password
                 $userString = file_get_contents("db/users/" . $currentUser->email . ".json");
                 $userObject = json_decode($userString);
                 $passwordFromDB = $userObject->password;

                 $passwordFromUser = password_verify($password, $passwordFromDB);



                 if($passwordFromDB == $passwordFromUser){
                     //redirect to dashboard
                     $_SESSION['loggedIn'] = $userObject->id;
                     $_SESSION['email'] = $userObject->email;
                     $_SESSION['fullname'] = $userObject->first_name . " " . $userObject->last_name;
                     $_SESSION['role'] = $userObject->designation;
                     if( $userObject->designation == 'Patients'){
                         redirect_to("patients.php");
                     }else{
                     redirect_to("mt.php");
                     }
                     die();

                 }


        

    }
    set_alert('error', "Invalid email or password");
    redirect_to("login.php");
    die();
}
