<?php session_start();
require_once("functions/alert.php");
require_once("functions/email.php");
require_once("functions/redirect.php");
require_once("functions/token.php");
//Counting the data
$errorCount = 0;
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$_SESSION['email'] = $email;

if ($errorCount > 0) { 
    //redirect back, display the error
    $session_error = "You have " . $errorCount . " error";

    if ($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your submission";
    set_alert('error',$session_error);

    redirect_to("forgot.php?");
}else{
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);

    for($counter = 0; $counter < $countAllUsers ; $counter++) {

        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
           //token function
            $token = generate_token();

           $subject = "Password reset link";
           $message = "A password reset has been initiated from your account, if you did not initiate this reset, please ignore this message otherwise visit : localhost/authentication/reset.php?token=".$token;

            file_put_contents("db/tokens/" . $email . ".json", json_encode(['token' => $token]));

           send_mail($subject, $message, $email);
           die();
        }
    }
     //save in the database;
    set_alert('error', "Email not registered with us, ERR: " . $email );
    redirect_to("forgot.php");
}
