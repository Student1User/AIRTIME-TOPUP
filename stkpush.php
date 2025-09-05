<?php
include 'db.php';

// User inputs
$phone = $_POST['phone'];
$amount = $_POST['amount'];

// Safaricom API Credentials
$consumerKey = "YOUR CUSTOMER KEY HERE";
$consumerSecret = "YOUR SCRET KEY HERE";
$BusinessShortCode = "PATBILL HERE"; // Test PayBill
$Passkey = "YOUR_PASSKEY";

// Get access token
$auth = base64_encode($consumerKey . ":" . $consumerSecret);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic " . $auth]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$access_token = json_decode($response)->access_token;

// Prepare STK Push request
$Timestamp = date("YmdHis");
$Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

$stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

$curl_post_data = [
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phone,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $phone,
    'CallBackURL' => 'https://yourdomain.com/airtime_topup/callback.php',
    'AccountReference' => 'AirtimeTopup',
    'TransactionDesc' => 'Airtime Purchase'
];

$data_string = json_encode($curl_post_data);

$ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
curl_setopt($ch, CURLOPT_HTTPHEADER, $stkheader);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
$response = curl_exec($ch);

echo "Request sent. Check your phone to complete payment.";
?>
