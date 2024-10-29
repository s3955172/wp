<?php 
include('includes/db_connect.inc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $petname = $_POST['petname'];
    $description = $_POST['description'];
    $caption = $_POST['caption'];
    $age = $_POST['age'];
    $type = $_POST['type'];
    $location = $_POST['location'];

    // Handle the file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an actual image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO pets (petname, description, caption, age, type, location, image)
                                           VALUES (:petname, :description, :caption, :age, :type, :location, :image)");
                    $stmt->execute([
                        'petname' => $petname,
                        'description' => $description,
                        'caption' => $caption,
                        'age' => $age,
                        'type' => $type,
                        'location' => $location,
                        'image' => $image,
                    ]);

                    echo "New pet added successfully.";
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "No file was uploaded or there was an upload error.";
    }
} else {
    echo "Invalid request.";
}
?>
