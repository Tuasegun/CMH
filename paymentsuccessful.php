<?php session_start();
include_once("functions/alert.php");

if (isset($_GET['txref'])) {
    $ref = $_GET['txref'];
    $amount = $_SESSION['patient_amount']; //Correct Amount from Server
    $currency = "NGN"; //Correct Currency from Server

    $query = array(
        "SECKEY" => "FLWSECK_TEST-662de0fd9aa99f220727398130ee07c7-X",
        "txref" => $ref
    );

    $data_string = json_encode($query);

    $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    curl_close($ch);

    $resp = json_decode($response, true);

    $paymentStatus = $resp['data']['status'];
    $chargeResponsecode = $resp['data']['chargecode'];
    $chargeAmount = $resp['data']['amount'];
    $chargeCurrency = $resp['data']['currency'];

    if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
          $subject = "Payment Success ";
          $message = "Your payment was successful";
          $email = $_SESSION['email'];
          $headers = "From: no-reply@cmh.org" . "\r\n" ."CC: segun@cmh.org";

      $try = mail($email, $subject, $message, $headers);

      if($try) {

          set_alert('message', "payment successful " . $email);
          header("Location: paid.php");
      };
    
    }
} else {
    set_alert('error', 'payment failed');   
    header("Location: failed.php");
} //else {
    //die('No reference supplied');
//}

?>