<?php session_start();
include_once("functions/redirect.php");
include_once("functions/txref.php");

//Counting the data
if(isset($_POST['button']))
{
  $name = $_POST['fullname'];
  $email = $_POST['email'];
  $patient_amount = $_POST['patient_amount'];

  $patient_amount = $_SESSION['amount']
  //process rave payment
  
  $curl = curl_init();

$customer_email = $email;
$amount = $patient_amount;
$currency = "NGN";
$txref = genTxref(); // ensure you generate unique references per transaction.
$PBFPubKey = "FLWPUBK_TEST-3f005abee1ad36a61618d9ba08b5ca4b-X"; // get your public key from the dashboard.
$redirect_url = "http://localhost/authentication/paymentsuccessful.php?";


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'customer_email'=>$customer_email,
    'currency'=>$currency,
    'txref'=>$txref,
    'PBFPubKey'=>$PBFPubKey,
    'redirect_url'=>$redirect_url,
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



// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $transaction->data->link);
}














