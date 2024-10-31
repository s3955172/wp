<?php
session_start();
include 'db_connect.inc';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $pet_id = (int)$_GET['id'];
    
    // Fetch pet data
    $stmt = $conn->prepare("SELECT * FROM pets WHERE id = ?");
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();
    $pet = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    if (!$pet) {
        echo "Pet not found.";
        exit;
    }
    
    // Check if the user owns the pet
    if ($pet['username'] != $_SESSION['username']) {
        echo "Unauthorized access.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($pet)) {
    $pet_name = htmlspecialchars($_POST['pet_name']);
    $type = htmlspecialchars($_POST['type']);
    $description = htmlspecialchars($_POST['description']);
    $age = (int)$_POST['age'];
    $location = htmlspecialchars($_POST['location']);
    $updated_image = $pet['image'];

    // Handle file upload if a new image is provided
    if (isset($_FILES['pet_image']) && $_FILES['pet_image']['error'] == 0) {
        $target_dir = "images/";
        $file_name = uniqid() . "_" . basename($_FILES["pet_image"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["pet_image"]["tmp_name"], $target_file)) {
            // Delete old image
            if (file_exists($target_dir . $pet['image'])) {
                unlink($target_dir . $pet['image']);
            }
            $updated_image = $file_name;
        } else {
            echo "Failed to upload new image.";
        }
    }

    // Update pet data
    $stmt = $conn->prepare("UPDATE pets SET name = ?, type = ?, description = ?, age = ?, location = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssissi", $pet_name, $type, $description, $age, $location, $updated_image, $pet_id);

    if ($stmt->execute()) {
        header("Location: details.php?id=" . $pet_id);
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
