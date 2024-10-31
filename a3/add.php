<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $petname = htmlspecialchars($_POST['petname']);
    $description = htmlspecialchars($_POST['description']);
    $caption = htmlspecialchars($_POST['caption']);
    $age = (float)$_POST['age'];
    $location = htmlspecialchars($_POST['location']);
    $type = htmlspecialchars($_POST['type']);
    $username = $_SESSION['username'];
    
    // Handling the image upload
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO pets (petname, description, image, caption, age, location, type, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdsss", $petname, $description, $image, $caption, $age, $location, $type, $username);

        if ($stmt->execute()) {
            echo "<p class='success-message'>Pet added successfully!</p>";
        } else {
            echo "<p class='error-message'>Failed to add pet. Please try again.</p>";
        }
        $stmt->close();
    } else {
        echo "<p class='error-message'>Failed to upload image. Please try again.</p>";
    }
}
?>

<div class="container">
    <h2>Add a New Pet</h2>
    <form method="post" action="" enctype="multipart/form-data" class="add-pet-form">
        <label for="petname">Pet Name:</label>
        <input type="text" name="petname" id="petname" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>

        <label for="caption">Caption:</label>
        <input type="text" name="caption" id="caption" required>

        <label for="age">Age (months):</label>
        <input type="number" name="age" id="age" required>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required>

        <label for="type">Type:</label>
        <select name="type" id="type" required>
            <option value="Cat">Cat</option>
            <option value="Dog">Dog</option>
            <!-- Add more types as needed -->
        </select>

        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" required>

        <button type="submit">Add Pet</button>
    </form>
</div>

<?php include 'includes/footer.inc'; ?>
