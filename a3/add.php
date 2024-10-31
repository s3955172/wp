<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<div class="container">
    <h2>Add a Pet</h2>
    <form action="process_add.php" method="post" enctype="multipart/form-data">
        <label for="pet_name">Pet Name:</label>
        <input type="text" name="pet_name" id="pet_name" required>

        <label for="type">Type:</label>
        <select name="type" id="type" required>
            <option value="">--Choose an option--</option>
            <option value="cat">Cat</option>
            <option value="dog">Dog</option>
            <!-- Add more options if needed -->
        </select>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="pet_image">Select an image:</label>
        <input type="file" name="pet_image" id="pet_image" accept="image/*" required>

        <label for="age">Age (months):</label>
        <input type="number" name="age" id="age" required>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required>

        <button type="submit">Submit</button>
    </form>
</div>

<?php include 'includes/footer.inc'; ?>
