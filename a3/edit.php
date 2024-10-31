<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Pet Details</h2>
        <form action="edit.php?id=<?php echo $pet_id; ?>" method="post" enctype="multipart/form-data">
            <label for="pet_name">Pet Name:</label>
            <input type="text" name="pet_name" id="pet_name" value="<?php echo htmlspecialchars($pet['name']); ?>" required>

            <label for="type">Type:</label>
            <input type="text" name="type" id="type" value="<?php echo htmlspecialchars($pet['type']); ?>" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo htmlspecialchars($pet['description']); ?></textarea>

            <label for="age">Age (Months):</label>
            <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($pet['age']); ?>" required>

            <label for="location">Location:</label>
            <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($pet['location']); ?>" required>

            <label for="pet_image">Pet Image (Optional):</label>
            <input type="file" name="pet_image" id="pet_image">

            <div class="button-container">
                <button type="submit" class="button-primary">Update Pet</button>
                <a href="details.php?id=<?php echo $pet_id; ?>" class="button-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
