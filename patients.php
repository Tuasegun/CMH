<?php

echo "Patients Content Display";
require_once('functions/alert.php');

include_once("lib/header.php");
if (!isset($_SESSION['loggedIn'])) {
    //redirect to dashboard
    header("Location: login.php");
}

?>
<h3>Welcome to the Patient's Dashboard</h3>
<div class="row col-6">
    <p>
        <?php print_alert(); ?>
    </p>
    <?php echo $_SESSION['fullname'] ?>. You are logged in as <?php echo $_SESSION['role'] ?> and your ID is <?php echo $_SESSION['loggedIn'] ?>
    <?php include_once("lib/footer.php"); ?>
</div>
<div class="row col-6">
    <?php
    echo "Login Time " . date("h:i:sa");
    "thanks."
    ?>
</div>
<?php
$email = $_SESSION['email'];
$filename = ("db/users/" . $email . ".json");
if (file_exists($filename)) {
    echo $_SESSION['fullname'] . "'s account was registered: " . date("F d Y H:i:s.", filemtime($filename));
}

?>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h4>DO YOU WANT TO </h4>
    <p>
        <a class="btn btn-bg btn-outline-secondary" href="bills.php">Pay bills</a>
        OR
        <a class="btn btn-bg btn-outline-primary" href="appointment.php">Book Appointment</a>
    </p>
</div>

</html>