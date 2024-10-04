<?php
$host = 'talsprddb02.int.its.rmit.edu.au';
$dbname = 's3955172';
$username = 's3955172';
$password = 'Dobryak2003';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
