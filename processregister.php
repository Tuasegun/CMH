<?php session_start();
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
    $allUsers = scandir("db/users/");
    
}
    $countAllUsers = count($allUsers);

    $newUserId = $countAllUsers-1;

    $userObject = [
        'id' => $newUserId,
        'first_name'=> $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => password_hash($password,PASSWORD_DEFAULT),
        'gender' => $gender,
        'designation' => $designation,
        'department' => $department,
    ];
    $_SESSION['email'] = $email;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION["error"] = "Invalid email address ";
    header("Location:register.php");
    die();
    }

    $_SESSION['first_name'] =  $first_name;
    if(!preg_match("/^[a-zA-Z]*$/",$first_name)){
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

    //loop
    for ($counter = 0; $counter < $countAllUsers ; $counter++) {

        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
            $_SESSION["error"] = "Registration Failed, User already exists ";
            header("Location:register.php");
            die();
        }
    //save in the database;
    file_put_contents("db/users/" . $email . ".json", json_encode($userObject));
    $_SESSION["message"] = "Registration Successful, You can now login " . $first_name;
    header("Location:login.php");


    }


   

/*
collecting data
verifying data
saving the data
return to the page with a status message
*/
