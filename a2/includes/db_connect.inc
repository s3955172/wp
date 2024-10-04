<?php
$host = 'talsprddb02.int.its.rmit.edu.au';  // Database host
$dbname = 's3955172';  // Database name
$username = 's3955172';  // Username
$password = 'Dobryak2003';  // Ppassword
$port = 3306;  // Database port

try {
    // Establish connection using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    // Set error mode to exception to handle errors properly
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection failure
    die("Connection failed: " . $e->getMessage());
}
?>
