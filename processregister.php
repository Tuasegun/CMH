<?php


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$designation = $_POST['designation'];
$department = $_POST['department']; 
/*
collecting data
verifying data
saving the data
return to the page with a status message
*/
//verifying data
$errorArray = [];

if($first_name == ""){
    $errorArray = "First_name cannot be blank";
}
print_r($errorArray);
if ($last_name == "") {
    $errorArray = "Last_name cannot be blank";
}
print_r($errorArray);
if ($email == "") {
    $errorArray = "email cannot be blank";
}
print_r($errorArray);
if($password == ""){
    $errorArray = "password cannot be empty";
}
print_r($errorArray);
if($gender == ""){
    $errorArray = "select a gender";
}
print_r($errorArray);
if($designation == ""){
    $errorArray = "select a designation";
}
print_r($errorArray);
if($department = ""){
    $errorArray = "department cannot be blank";
}
print_r($errorArray);
