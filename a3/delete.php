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
    
    // First, fetch the image path for deletion
    $stmt = $conn->prepare("SELECT image FROM pets WHERE petid = ? AND username = ?");
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }
    $stmt->bind_param("is", $pet_id, $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    // Delete the image file if it exists
    $image_path = "images/" . $image;
    if ($image && file_exists($image_path)) {
        unlink($image_path);
    }

    // Now, delete the pet record from the database
    $stmt = $conn->prepare("DELETE FROM pets WHERE petid = ? AND username = ?");
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }
    $stmt->bind_param("is", $pet_id, $_SESSION['username']);
    $stmt->execute();
    $stmt->close();

    header("Location: user.php");
    exit;
} else {
    echo "Invalid pet ID.";
}

$conn->close();
?>

<?php
include 'includes/footer.inc';
?>
