<?php session_start();
//Counting the data
$errorCount = 0;

if(!$_SESSION['loggedIn']){
    
    $token = $_POST['token'] != "" ? $_POST['token'] : $errorCount++;
    $_SESSION['token'] = $token;
}
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['email'] = $email;


if ($errorCount > 0) {
    //redirect back, display the error
    $session_error = "You have " . $errorCount . " error";

    if ($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your submission";
    $_SESSION["error"] = $session_error;

    header("Location: register.php?");
} else {
    //do the actual reset things
    //check that email is registered in tokens folder
    //check if the content of the registered token (in the folder) is the same as token
    $allUserTokens = scandir("db/tokens/");
    $countAllUserTokens = count($allUserTokens);

    for ($counter = 0; $counter < $countAllUserToken; $counter++) {

        $currentTokenFile = $allUserTokens[$counter];

        if ($currentUser == $email . ".json") {
            //now check if the token in  the currenttoken is the same with the one in our folder; 
            $tokenContent  =   file_get_contents("db/tokens/" . $currentTokenFile);
            $tokenObject = json_decode($tokenString);
            
            $tokenFromDb = $tokenObject ->token;
            //TODO: fix minor issues and make it better
            if($_SESSION['loggedIn']){
                $checkToken = true;    
            }else{
                $checkToken = $tokenFromDB == $token;
            }

            if($checkToken){
                $allUsers = scandir("db/users/");
                $countAllUsers = count($allUsers);

                for ($counter = 0; $counter < $countAllUsers; $counter++) {

                    $currentUser = $allUsers[$counter];

                    if ($currentUser == $email . ".json") {
                        //check password
                        $userString = file_get_contents("db/users/" . $currentUser);
                        $userObject = json_decode($userString);
                         $userObject->password =  password_hash($password, PASSWORD_DEFAULT);

                         unlink("db/users/".$currentUser); ///file delete, user data delete

                            
                }
                    file_put_contents("db/users/" . $email . ".json", json_encode($userObject));
                    
                    $_SESSION["message"] = "Password reset successful, you can now login " . $first_name;
                    //Inform user of password reset 
                    
                    $subject = "Password reset link";
                    $message = "Your account on CMH has just been updated if you did not initiate the password change visit CMH.ORG and reset your password immediately";
                     $headers = "From: no-reply@cmh.org" . "\r\n" .
                        "CC: segun@cmh.org";
                     $try = mail($email, $subject, $message, $headers);


                        //inform user of password reset end
                    

                    header("Location: login.php");
                    die();
                }
                
            }
            die();
        }
    }
    $_SESSION["error"] = "Password reset failed, token or email invalid or expired ";
    header("Location: login.php");
}