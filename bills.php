<?php
require_once('functions/alert.php');
include_once("lib/header.php");
if (!isset($_SESSION['loggedIn'])) {
    //redirect to dashboard
    header("Location: login.php");
}
?>
<div class="container">
    <h3>Pay Bills here, <?php echo $_SESSION['fullname'] ?> .</h3>
</div>
<div class="container">
    <form class="container" method="POST" action="processbills.php">
        <table class="table" cellPadding="0" cellSpacing="0">
            <tbody>
                <tr>
                    <th colSpan="3" style="text-align:left;margin-top:20px;display:table">
                        Input Credit Card Details
                    </th>
                </tr>
                <?php print_alert(); ?>
                <tr>
                    <td width="50%">
                        <span style="vertical-align:top">
                            <input <?php

                                    if (isset($_SESSION['patient_amount'])) {
                                        echo "value=" . $_SESSION['patient_amount'];
                                    }
                                    ?>type="number" class="form-control" value="" name="patient_amount" />
                            <label> Amount </label>
                        </span>

                    <td width="50%">
                        <span style="vertical-align:top">

                            <input <?php

                                    if (isset($_SESSION['email'])) {
                                        echo "value=" . $_SESSION['email'];
                                    }
                                    ?> value="" class="form-control" type="text" name="email" placeholder="Email" /><br />
                            <label>Email</label>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        <span class="form-group" style="vertical-align:top">
                            <input <?php

                                    if (isset($_SESSION['fullname'])) {
                                        echo "value=" . $_SESSION['fullname'];
                                    }
                                    ?>type="text" class="form-control" size="20" value="" name="fullname" multiple />
                            <label> Full Name </label>
                        </span>
                        <div class="button-center">
                            <p>
                                <button class="btn btn-bg btn-success" name='button' type="submit">Pay Bills</button>
                            </p>
                        </div>
                        </span>
                    </td>
    </form>
</div>