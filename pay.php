   <? //php include_once("lib/header.php");
    //require_once('functions/alert.php');
    //if (!isset($_SESSION['loggedIn'])) {
     // header("Location: login.php");
    } 
    ?>
   <form>
       <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
       <label>email</label> <br />
       <input  type="hidden" name="patient_email" id="patient_email" <?php
                            echo "value=". $_SESSION['email'];
                                            ?> />
       <button type="button" class='pay_button' onClick="payWithRave()">Pay Now</button>
   </form>
   <script>
       const API_publickey = "FLWPUBK_TEST-8a891a503fa9111261921339daa7292c-X";
       const email = document.getElementById('patient_email').value;
       const button = document.getElementsByClassName('pay_button')
       for (let button of buttons) {
           button.addEventListener('click', function(e) {
               e.preventDefault();
               const appointmentId = e.target.name;
               payWithRave(appointmentId);
           })
       }


       function payWithRave(appointmentId) {
           var x = getpaidSetup({
               PBFubKey: API_publickey,
               costumer_email: email,
               amount: 2000,
               currency: "NGN",
               txref: "rave-12345",
               meta: [{
                   metaname: "flightID",
                   metavalue: "API1234"
               }],
               onclose: function() {},
               callback: function(response) {
                   var txref = response.data.txref;
                   console.log("this is the response after a charge", response);
                   if (response.respcode == "00" ||
                       response.data.data.status == "successful") {
                       window.location.href = "https://192.168.64.2/authentication/paymentsuccessful.php" + appointmentId + "&email=" + email;
                   } else {
                       windows.location.href = "https://192.168.64.2/authentication/failed.php" + appointmentId;

                   }
                   x.close();
               }
           });
       }
   </script>