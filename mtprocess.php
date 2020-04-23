<?php session_start();
require_once("functions/user.php");
require_once("functions/alert.php");
require_once("functions/redirect.php");

$allPatients = scandir("appointments/");
$countAllPatients = count($allPatients);
for ($counter = 0; $counter < $countAllPatients; $counter++) {
        $printPatients= $allPatients[$counter];
if (file_exists("appointments/")){
        $Patients = $allPatients[$counter];
        $seePatients = file_get_contents("appointments/" . "" .".json");
        $data = json_decode($seePatients);
        print_r($data);
        
    }
}

