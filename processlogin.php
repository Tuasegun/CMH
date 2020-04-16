<?php session_start();
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
    $_SESSION["error"] = $session_error;

    header("Location: login.php?");
} else {
   
    for ($counter = 0; $counter < $countAllUsers; $counter++) {

             $currentUser = $allUsers[$counter];

             if ($currentUser == $email . ".json") {
                 //check password
                 $userString = file_get_contents("db/users/".$currentUser);
                 $userObject = json_decode($userString);
                 $passwordFromDB = $userObject->password;

                 $passwordFromUser = password_verify($password, $passwordFromDB);



                 if($passwordFromDB == $passwordFromUser){
                     //redirect to dashboard
                     $_SESSION['loggedIn'] = $userObject->id;
                     $_SESSION['email'] = $userObject->email;
                     $_SESSION['fullname'] = $userObject->first_name . " " . $userObject->last_name;
                     $_SESSION['role'] = $userObject->designation;
                     if( $userObject->designation == 'Patient'){
                         header("Location:patients.php");
                     }else{
                     header("Location:mt.php");
                     }
                     die();

                 }


         }

    }
    $_SESSION["error"] = "Invalid email or password";
    header("Location: login.php");
    die();
}
date("db/users".$currentUser);