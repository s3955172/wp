<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pet_name = htmlspecialchars($_POST['pet_name']);
    $type = htmlspecialchars($_POST['type']);
    $description = htmlspecialchars($_POST['description']);
    $age = (int)$_POST['age'];
    $location = htmlspecialchars($_POST['location']);
    $username = $_SESSION['username'];

    // Handle file upload
    if (isset($_FILES['pet_image']) && $_FILES['pet_image']['error'] == 0) {
        $target_dir = "images/";
        $file_name = uniqid() . "_" . basename($_FILES["pet_image"]["name"]);
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES["pet_image"]["tmp_name"], $target_file)) {
            // Prepare and execute the query
            $stmt = $conn->prepare("INSERT INTO pets (name, type, description, age, location, image, username) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssisss", $pet_name, $type, $description, $age, $location, $file_name, $username);
            
            if ($stmt->execute()) {
                header("Location: gallery.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded or there was an upload error.";
    }
}

$conn->close();
?>
