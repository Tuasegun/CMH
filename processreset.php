<?php session_start();
require_once('functions/alert.php');
require_once('functions/user.php');
require_once('functions/redirect.php');
require_once('functions/token.php');

//Counting the data
$errorCount = 0;

if(!is_user_loggedIn()){
    
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
    set_alert('error', " in your submission");
    redirect_to("register.php?");
} else {
    //do the actual reset things
    //check that email is registered in tokens folder
    //check if the content of the registered token (in the folder) is the same as token
            
            $checkToken = is_user_loggedIn() ? true : find_token($email);

            if($checkToken){
                $userExists = find_user($email);

                if($userExists){
                        $userObject = find_user($email);
                    //check password
                        $userObject->password =  password_hash($password, PASSWORD_DEFAULT);
                        unlink("db/users/".$currentUser); ///file delete, user data delete
                        unlink("db/tokens/" . $currentUser); ///file delete, user token delete

                        save_user($userObject);
                        set_alert('message', "Password reset successful, you can now login " . $first_name);
                        //Inform user of password reset
                         $subject = "Password Reset Successful ";
                         $message = "Your account on the CMH hospital has been updated your password has been changed";
                         send_mail($subject, $message, $email);


                        //inform user of password reset end


                    redirect_to("login.php");
                    die();
                }            
        
    }
    set_alert('error', "Password reset failed, token or email invalid or expired ");
    redirect_to("login.php");
}