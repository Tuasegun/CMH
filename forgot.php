 <title>CMH password forgotten</title>

 <?php include_once("lib/header.php"); ?><br />

 <body>

     Why did you forget your password?<br />
     <h3>forgot password</h3>
     <p>Provide the email associated with your account</p>
     <form action="processforgot.php" method="POST">
         <p>
             <?php
                //Display more accurate messages
                //
                if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                    echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";

                    //session_unset();
                    session_destroy();
                }
                ?>
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
                 <button type="submit">Send Reset Code</button>
             </p>

     </form>

 </body>
 <?php include_once("lib/footer.php"); ?><br />

 </html>