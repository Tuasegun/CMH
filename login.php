<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-width" />
    <title>CMH hospital login</title>
</head>

<?php include_once("lib/header.php");
require_once("functions/alert.php");
if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
    //redirect to dashboard
    header("Location: dashboard.php");
}
?>

<div class="container">
    <div class="row col-6">
        <h5>Login Form here</h5><br />
    </div>
    <div class="row col-6">
        <form method="POST" action="processlogin.php">
            <p>
                <?php print_alert(); ?>
                <p>
                    <label>Email</label><br />
                    <input <?php

                            if (isset($_SESSION['email'])) {
                                echo "value=" . $_SESSION['email'];
                            }
                            ?> value="" class="form-control" type="text" name="email" placeholder="Email" />
                </p>
                <p>
                    <label>Password</label><br />
                    <input class="form-control" type="password" name="password" placeholder="Password" />
                </p>

                <p>
                    <button class="btn btn-sm btn-primary" type="submit">Login</button>
                </p>
                <p>
                    <a href="forgot.php">Forgot password</a><br />
                    <a href="register.php">Don't have an account? Register</a>
                </p>

        </form>



        <?php include_once("lib/footer.php"); ?><br />
    </div>
</div>

</html>