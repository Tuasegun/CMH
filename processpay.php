<?php
session_start();
require_once("functions/alert.php");
require_once("functions/email.php");
require_once("functions/redirect.php");

$_SESSION['patient_email'] = $email;

$subject = "Payment notification";
$message = "Your payment has been made successfuly";

try-$subject, $message, $email{

};
?>


$email = $_POST['email'];
$patient_amount = $_POST['patient_amount'];

$curl = curl_init();

$customer_email = $_SESSION['email'];
$amount = $_SESSION['patient_amount'];
$currency = "NGN";
$txref = "rave-299338887754"; // ensure you generate unique references per transaction.
$PBFPubKey = "FLWPUBK_TEST-8a891a503fa9111261921339daa7292c-X"; // get your public key from the dashboard.
//$redirect_url = header("Location:paymentsuccessful.php?");
//$payment_plan = "pass the plan id"; // this is only required for recurring payments.


curl_setopt_array($curl, array(
  CURLOPT_URL =>  "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'customer_email'=>$customer_email,
    'currency'=>$currency,
    'txref'=>$txref,
    'PBFPubKey'=>$PBFPubKey,
  //  'redirect_url'=>$redirect_url,
    //'payment_plan'=>$payment_plan
  ]),
  CURLOPT_HTTPHEADER => [
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the rave API
  die('Curl returned error: ' . $err);
}

$transaction = json_decode($response);

if(!$transaction->data && !$transaction->data->link){
  // there was an error from the API
  print_r('API returned error: ' . $transaction->message);
}

// uncomment out this line if you want to redirect the user to the payment page
//print_r($transaction->data->message);


// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page

header('Location:paymentsuccessful.php' . $transaction->data->link);

if(isset($_GET['txref'])){
  $ref = $_GET['txref'];
  $amount = $_GET['patient_amount'];
  $currency = "";
}
$query = array(
    "SECKEY" => "FLWSECK_TEST-2556e5b49d06b9a4ae88f3011a332b50-X",
    "texref" => $ref
);
if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
  redirect_to("paymentsuccessful.php");
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  //Give Value and return to Success page
} else {
  //Dont Give Value and return to Failure page
  redirect_to("failed.php");
}
