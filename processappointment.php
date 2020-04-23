<?php session_start();
require_once("functions/user.php");
require_once("functions/alert.php");
require_once("functions/redirect.php");
//Counting the data
$errorCount = 0;
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$appointment_date = $_POST['appointment_date'] != "" ? $_POST['appointment_date'] : $errorCount++;
$appointment_time = $_POST['appointment_time'] != "" ? $_POST['appointment_time'] : $errorCount++;
$appointment_nature = $_POST['appointment_nature'] != "" ? $_POST['appointment_nature'] : $errorCount++;
$complaint = $_POST['complaint'] != "" ? $_POST['complaint'] : $errorCount++;
$department = $_POST['department'] != "" ? $_POST['department'] : $errorCount++;

$_SESSION['email'] = $email;
$_SESSION['appointment_date'] = $appointment_date;
$_SESSION['appointment_time'] = $appointment_time;
$_SESSION['appointment_nature'] = $appointment_nature;
$_SESSION['complaint'] = $complaint;
$_SESSION['department'] = $department;


if ($errorCount > 0) {
    //redirect back, display the error
    $session_error = "You have " . $errorCount . " error";

    if ($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your submission";
    $_SESSION["error"] = $session_error;

    header("Location:appointment.php?");
}
else{
    
    
    $appointmentObject= "Appointments" = [
        'appointment_date' => $appointment_date,
        'appointment_time' => $appointment_time,
        'appointment_nature' => $appointment_nature,
        'complaint' => $complaint,
        'department' => $department,
        'email' => $email
    ];

    $userExists = find_user($email);

    if ($userExists) {
        file_put_contents("appointments/" . $email . ".json", json_encode($appointmentObject));
        set_alert('message', "Medical Appointment Successful");
        redirect_to("patients.php");
        
    }

}