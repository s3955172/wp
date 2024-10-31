<?php
session_start();
include 'db_connect.inc';

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

    if (isset($_FILES['pet_image']) && $_FILES['pet_image']['error'] == 0) {
        $target_dir = "images/";
        $file_name = basename($_FILES["pet_image"]["name"]);
        $target_file = $target_dir . uniqid() . "_" . $file_name;
        
        if (move_uploaded_file($_FILES["pet_image"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO pets (name, type, description, age, location, image, username) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiss", $pet_name, $type, $description, $age, $location, $target_file, $username);
            
            if ($stmt->execute()) {
                header("Location: gallery.php");
            } else {
                echo "Error: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded or upload error.";
    }
}

$conn->close();
?>
