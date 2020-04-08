<!DOCTYPE html>
<html lang="en">
<?php include_once("lib/header.php"); ?>
<p>
    <?php
    //Display more accurate messages
    //
    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        echo "<span style='color:green'>" . $_SESSION['message'] . "</span>";
        session_destroy();
    }
    ?>
</p>

<?php include_once("lib/footer.php"); ?>
</body>

</html>