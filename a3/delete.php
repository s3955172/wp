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
    $stmt = $conn->prepare("SELECT image FROM pets WHERE id = ? AND username = ?");
    $stmt->bind_param("is", $pet_id, $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    if ($image && file_exists($image)) {
        unlink($image);
    }

    $stmt = $conn->prepare("DELETE FROM pets WHERE id = ? AND username = ?");
    $stmt->bind_param("is", $pet_id, $_SESSION['username']);
    $stmt->execute();
    $stmt->close();

    header("Location: user.php");
} else {
    echo "Invalid pet ID.";
}

$conn->close();
?>

<?php
include 'includes/footer.inc';      // Footer section
?>
