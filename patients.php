<?php

echo "Patients Content Display";

include_once("lib/header.php");
if (!isset($_SESSION['loggedIn'])) {
    //redirect to dashboard
    header("Location: login.php");
}

?>
<h3>Dashboard</h3>

Welcome, <?php echo $_SESSION['fullname'] ?>. You are logged in as (<?php echo $_SESSION['role'] ?>) and your ID is <?php echo $_SESSION['loggedIn'] ?>
<?php include_once("lib/footer.php"); ?>
<?php
echo "Login Time " . date("h:i:sa"); "thanks."
?>

<?php
$email = $_SESSION['email'] ;
$filename = ("db/users/" . $email . ".json");
if(file_exists($filename)){
echo $_SESSION['fullname']. "'s account was registered: " .date ("F d Y H:i:s.", filemtime($filename));
}
?>


</html>