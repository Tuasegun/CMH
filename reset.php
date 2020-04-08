<title>CMH password forgotten</title>

<?php include_once("lib/header.php");

if(!$_SESSION['loggedIn'] && !isset($_GET['token'])  && !isset($_SESSION['token'])) {
    $_SESSION["error"] = "You are not authorized to view that page ";
    header("Location: login.php");
}
?><br />

<body>

    Why did you forget your password?<br />
    <h3>Reset password </h3>
    <p>Reset passwords associated with your account: [email]</p>
    <form action="processreset.php" method="POST">
        <p>
            <?php
            //Display more accurate messages
            //
            if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
                session_destroy();
            }
            ?>
        </p>
        <?php if(!$_SESSION['loggedIn']) {?>
        <p>
            <input <?php
                    if (isset($_SESSION['token'])) {
                        echo "value='" . $_SESSION['token'] . "'";
                    } else {
                        echo "value='" . $_GET['token'] . "'";
                    }
                    ?> type="hidden" name="token" />
            <?php } ?>
        </p>
        <p>
            <label>Email</label><br />
            <input <?php

                    if (isset($_SESSION['email'])) {
                        echo "value=" . $_SESSION['email'];
                    }
                    ?> value="[email]" type="text" name="email" placeholder="Email" />
        </p>
        <p>
            <label>Enter New Password</label><br />
            <input type="password" name="password" placeholder="Password" />
        </p>

        <p>
            <button type="submit">Reset password</button>
        </p>

    </form>

</body>
<?php include_once("lib/footer.php"); ?><br />

</html>