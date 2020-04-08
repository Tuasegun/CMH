<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-width" />
    <title>CMH hospital login</title>
</head>

<?php include_once("lib/header.php");
if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    //redirect to dashboard
    header("Location: dashboard.php");
}


?>
<p>
    <?php 
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
            echo "<span style='color:green'>" . $_SESSION['message'] . "</span>";
            session_destroy();
        }
     ?>
</p>
<h5>Login Form here</h5>
<form method="POST" action="processlogin.php">
    <p>
        <?php 
            if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
                         } 
          ?>
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
        <button type="submit">Login</button>
    </p>

</form>



<?php include_once("lib/footer.php"); ?><br />




</html>