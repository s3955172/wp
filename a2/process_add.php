<?php
include('includes/db_connect.inc');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $age = $_POST['age'];
    $location = $_POST['location'];

    // Handle file upload
    $image = $_FILES['image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $stmt = $pdo->prepare("INSERT INTO pets (petname, type, description, age, location, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $type, $description, $age, $location, $image]);
        header('Location: pets.php');
    } else {
        echo "Error uploading image.";
    }
}
?>
