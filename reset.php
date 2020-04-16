<title>CMH password forgotten</title>

<?php include_once("lib/header.php");
require_once("functions/alert.php");
require_once("functions/user.php");

if(!is_user_loggedIn() && !is_token_set()) {
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
            <!-- Display more accurate messages       -->
             <?php print_alert();     ?>
        </p>
        <?php if (!is_user_loggedIn()) { ?>
            <p>
                <input <?php
                        if (is_token_set_in_session()) {
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