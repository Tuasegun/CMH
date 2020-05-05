<?php 

require_once('functions/alert.php');
include_once("lib/header.php");

// if (!isset($_SESSION['loggedIn'])) {
//     //redirect to dashboard
//     header("Location: bills.php");
// }

?>

 <?php print_alert(); ?>