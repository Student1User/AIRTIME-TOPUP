<?php
$host = "localhost";
$user = "root"; // default in XAMPP
$pass = "";     // default empty in XAMPP
$dbname = "airtime_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
?>
