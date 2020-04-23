<?php include_once("lib/header.php");
require_once('functions/alert.php');
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
}
?>
<div class="container">
    <form method="POST" action="processappointment.php">

        <p>

            <?php print_alert();
            ?>

        </p>

        <label>Email</label><br />
        <input <?php

                if (isset($_SESSION['email'])) {
                    echo "value=" . $_SESSION['email'];
                }
                ?> value="" class="form-control" type="text" name="email" placeholder="Email" />
        </p>

        <p>

            <label>Date of Appointment:</label><br />

            <input <?php



                    if (isset($_SESSION['appointment_date'])) {

                        echo "value=" . $_SESSION['appointment_date'];
                    }

                    ?> value="" class="form-control" type="date" name="appointment_date" placeholder="Date of appointment" />

        </p>
        <p>

            <label>Time of Appointment:</label><br />

            <input <?php



                    if (isset($_SESSION['appointment_time'])) {

                        echo "value=" . $_SESSION['appointment_time'];
                    }

                    ?> value="" class="form-control" type="time" name="appointment_time" placeholder="Time of appointment" />

        </p>
        <p>

            <label>Nature of Appointment:</label><br />

            <select name="appointment_nature" class="form-control">
                <option value="">Select one</option>
                <option <?php

                        if (isset($_SESSION['appointment_nature']) && $_SESSION['appointment_nature'] == 'Emergency') {
                            echo "selected";
                        }
                        ?>>Emergency</option>
                <option <?php

                        if (isset($_SESSION['appointment_nature']) && $_SESSION['appointment_nature'] == 'Consultation') {
                            echo "selected";
                        }
                        ?>>Consultation</option>
                <option <?php

                        if (isset($_SESSION['appointment_nature']) && $_SESSION['appointment_nature'] == 'Checkup') {
                            echo "selected";
                        }
                        ?>>Checkup</option>
                <option <?php

                        if (isset($_SESSION['appointment_nature']) && $_SESSION['appointment_nature'] == 'Immunization') {
                            echo "selected";
                        }
                        ?>>Immunization</option>
            </select>
        </p>


        <p>

            <label>Initial Complaint</label><br />

            <input <?php



                    if (isset($_SESSION['complaint'])) {

                        echo "value=" . $_SESSION['complaint'];
                    }

                    ?> value="" class="form-control" type="text" name="complaint" />
        </p>
        <p>
            <label>Department</label><br />
            <input <?php

                    if (isset($_SESSION['department'])) {
                        echo "value=" . $_SESSION['department'];
                    }
                    ?> value="" class="form-control" type="text" name="department" placeholder="Department" />
        </p>
        <p>
            <button class="btn btn-sm btn-success" type="submit">Book Appointment</button>
        </p>
    </form>
    </div>