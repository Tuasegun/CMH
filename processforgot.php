<?php session_start();
require_once("functions/alert.php");
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

    header("Location: forgot.php?");
}else{
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);

    for($counter = 0; $counter < $countAllUsers ; $counter++) {

        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
           //send the email and redirect the reset password
           //TODO: work on token generation
           //generating token manually
            $token = "";
           $alphabets = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'w', 'x', 'y', 'z',];
            for($i = 0;  $i < 20; $i++){
                //get random numbers
                // get alphabet at index of random numbers
               $index = rand(0, count($alphabets));
               $token .= $alphabets[$index]; 
            }
            
           //token ends here
           $subject = "Password reset link";
           $message = "A password reset has been initiated from your account, if you did not initiate this reset, please ignore this message otherwise visit : localhost/authentication/reset.php?token=".$token;
           $headers = "From: no-reply@cmh.org" . "\r\n" .
           "CC: segun@cmh.ng";

            file_put_contents("db/tokens/" . $email . ".json", json_encode(['token' => $token]));

           $try = mail($email,$subject,$message,$headers);
            
           
           if($try){
                $_SESSION["message"] = "Password Reset has been sent to your email " . $email;
                header("Location: login.php");

           }else{
                $_SESSION["error"] = "Something went wrong, we could not reset the password " . $email;
                header("Location: forgot.php");
           }
           die();
        }
    }
     //save in the database;
    
    $_SESSION["error"] = "Email not registered with us, ERR: " . $email;
    header("Location: forgot.php");

}
