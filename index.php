<!DOCTYPE html>
<html lang="en">
<?php include_once("lib/header.php");
require_once("functions/alert.php") ?>
<p>
    <?php
    //Display more accurate messages
    print_alert();
    ?>
</p>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Welcome to the SNG: The hospital of the ignorant</h1>
    <p class="lead">This is a specialist hospital to cure ignorance</p>
    <p class="lead">Come as you are you are free</p>
    <p>
        <a class="btn btn-bg btn-outline-secondary" href="login.php">Login</a>
        <a class="btn btn-bg btn-outline-primary" href="register.php">Register</a>

    </p>
    
</div>
<?php include_once("lib/footer.php"); ?>
</body>

</html>