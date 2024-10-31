<?php
// db_connect.inc

// Check what server you are accessing
if (strstr($_SERVER['SERVER_NAME'], 'localhost')) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "WP";
} else {
    $servername = "talsprddb02.int.its.rmit.edu.au";
    $username = "s3955172"; // Replace with your actual RMIT username
    $password = "Dobryak2003"; // Replace with your actual Jacob5 password
    $dbname = "pets"; // Replace with the actual database name if different
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
