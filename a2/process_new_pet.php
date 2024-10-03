<?php
include 'includes/db_connect.inc';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $petname = $_POST['petname'];
    $type = $_POST['type'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    // Handle image upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image = $_FILES["image"]["name"];

    // Insert pet data into the database
    $stmt = $conn->prepare("INSERT INTO pets (petname, description, age, type, location, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $petname, $description, $age, $type, $location, $image);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: pets.php");
}
?>
