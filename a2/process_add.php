<?php 
include('db_connect.inc');

$petname = $_POST['petname'];
$description = $_POST['description'];
$caption = $_POST['caption'];
$age = $_POST['age'];
$type = $_POST['type'];
$location = $_POST['location'];

$image = $_FILES['image']['name'];
$target = "images/" . basename($image);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $sql = "INSERT INTO pets (petname, description, caption, age, type, location, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsis", $petname, $description, $caption, $age, $type, $location, $image);
    
    if ($stmt->execute()) {
        echo "Pet added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Failed to upload image.";
}
?>
