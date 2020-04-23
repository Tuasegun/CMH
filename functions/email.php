<?php
require_once('alert.php');
require_once('redirect.php');
function send_mail(
    $subject = "",
    $message = "",
    $email = ""){
$headers = "From: no-reply@cmh.org" . "\r\n" .
    "CC: segun@cmh.org";

    $try = mail($email, $subject, $message, $headers);

    if ($try) {

        set_alert('message', "Password Reset has been sent to your email: " . $email);
        redirect_to("Location: login.php");
    } else {
        set_alert('error', "Something went wrong, we could not reset the password " . $email);
        redirect_to("Location: forgot.php");
    }
}

?>