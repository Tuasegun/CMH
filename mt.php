<?php
echo "Medical Content Display";
include_once("lib/header.php");
require_once("functions/alert.php");
if (!isset($_SESSION['loggedIn'])) {
    //redirect to dashboard
    header("Location: login.php");
}

?>
<h3>Dashboard</h3>

<p>Welcome,</p> <?php echo $_SESSION['fullname'] ?>. You are logged in as (<?php echo $_SESSION['role'] ?>) and your ID is <?php echo $_SESSION['loggedIn'] ?>
<?php include_once("lib/footer.php"); ?>
<?php
echo "You logged in around " . date("h:i:sa");
"thanks."
?><br />
<?php
$email = $_SESSION['email'];
$filename = ("db/users/" . $email . ".json");
if (file_exists($filename)) {
    echo $_SESSION['fullname'] . "'s account was registered: " . date("F d Y H:i:s.", filemtime($filename));
}
?>
<br />
<div class="container" style="width:500px;">
    <?php
    //$allPatients = scandir("appointments/");
    //$countAllPatients = count($allPatients);
    //for ($counter = 0; $counter < $countAllPatients; $counter++) {

       // if (file_exists("appointments/")) {
        //    $Patients = $allPatients[$counter];
            $seePatients = file_get_contents("appointments/" . "" . ".json");
            $data = json_decode($seePatients, true);
            echo "<table>
                    <tr>
                            <td><strong>Appointment Date</strong></td>
                            <td><strong>Appointment Time</strong></td>
                            <td><strong>Appointment Nature</strong></td>
                            <td><strong>Complaint</strong></td>
                            <td><strong>Department</strong></td>

                    </tr>";
            foreach ($data as $appointmentObject): ?>
                <tr>
                <td><strong><?php echo $_SESSION['appointment_date'] = $appointment_date ->appointment_date ?> </strong></td>
                <td><strong><?php echo $appointmentObject->appointment_time ?> </strong></td>
                <td><strong><?php echo $appointmentObject->appointment_nature ?> </strong></td>
                <td><strong><?php echo $appointmentObject->complaint ?> </strong></td>
                <td><strong><?php echo $appointmentObject->department ?> </strong></td>
                </tr>
            <?php endforeach; echo "</table>"; ?>    
    <?php
 
        //}
    //}
    ?>
</div>

<!-- <form method="POST" action="mtprocess.php">
    <p>
        <button class="btn btn-sm btn-success" type="submit">Check Patients</button>
    </p>
</form> -->



</html>