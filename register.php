<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-width" />
    <title>CMH hospital Registration</title>
</head>
<?php include_once("lib/header.php"); require_once("functions/alert.php"); require_once("functions/user.php");
if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
    //redirect to dashboard
    header("Location: dashboard.php");
}
?>
<h3>Register</h3>
<p><strong>Welcome, Please Register</strong></p>
<p>All fields are required</p>
<form method="POST" action="processregister.php">
    <p>
        <?php print_alert(); ?>
    </p>

    <p>
        <label>First Name</label><br />
        <input <?php

                if (isset($_SESSION['first_name'])) {
                    echo "value=" . $_SESSION['first_name'];
                }
                ?> value="" pattern="[a-zA-Z]{1,}" type="text" name="first_name" placeholder="First Name" />
    </p>
    <p>
        <label>Last Name</label><br />
        <input <?php

                if (isset($_SESSION['last_name'])) {
                    echo "value=" . $_SESSION['last_name'];
                }
                ?> value="" pattern="[a-zA-Z]{1,}" type="text" name="last_name" placeholder="Last Name" />
    </p>
    <p>
        <label>Email</label><br />
        <input <?php

                if (isset($_SESSION['email'])) {
                    echo "value=" . $_SESSION['email'];
                }
                ?> value="" type="text" name="email" placeholder="Email" />
    </p>
    <p>
        <label>Password</label><br />
        <input type="password" name="password" placeholder="Password" />
    </p>
    <p>
        <label>Gender</label><br />
        <select name="gender">
            <option value="">Select One</option>
            <option <?php

                    if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') {
                        echo "selected";
                    }
                    ?>>Male</option>
            <option <?php

                    if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') {
                        echo "selected";
                    }
                    ?>>Female</option>
        </select>
    </p>



    <p>
        <label>Designation</label><br />
        <select name="designation">
            <option value="">Select one</option>
            <option <?php

                    if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team (MT)') {
                        echo "selected";
                    }
                    ?>>Medical Team(MT)</option>
            <option <?php

                    if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patients') {
                        echo "selected";
                    }
                    ?>>Patients</option>
        </select>
    </p>
    <p>
        <label>Department</label><br />
        <input <?php

                if (isset($_SESSION['department'])) {
                    echo "value=" . $_SESSION['department'];
                }
                ?> value="" type="text" name="department" placeholder="Department" />
    </p>
    <p>
        <button type="submit">Register</button>
    </p>

</form>

<?php include_once("lib/footer.php"); ?>