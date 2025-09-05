<?php
// Database connection
$host = "localhost";
$user = "root";  // default XAMPP user
$pass = "";      // default XAMPP has no password
$db   = "daraja_app";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Read callback JSON
$data = file_get_contents('php://input');
$callbackData = json_decode($data, true);

// Extract info
$merchantRequestID  = $callbackData['Body']['stkCallback']['MerchantRequestID'];
$checkoutRequestID  = $callbackData['Body']['stkCallback']['CheckoutRequestID'];
$resultCode         = $callbackData['Body']['stkCallback']['ResultCode'];
$resultDesc         = $callbackData['Body']['stkCallback']['ResultDesc'];

// Default values
$amount = 0;
$mpesaReceipt = '';
$phone = '';

// If transaction successful
if ($resultCode == 0) {
    $amount        = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
    $mpesaReceipt  = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
    $phone         = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
}

// Insert into DB
$sql = "INSERT INTO transactions 
        (merchant_request_id, checkout_request_id, phone_number, amount, mpesa_receipt_number, result_code, result_desc)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdsis", $merchantRequestID, $checkoutRequestID, $phone, $amount, $mpesaReceipt, $resultCode, $resultDesc);

if ($stmt->execute()) {
    echo "Transaction saved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
