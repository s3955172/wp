<?php
session_start();
include 'db_connect.inc';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$pet_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("SELECT * FROM pets WHERE id = ? AND username = ?");
$stmt->bind_param("is", $pet_id, $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$pet = $result->fetch_assoc();
$stmt->close();

if ($pet):
?>
<div class="container">
    <h2>Edit Pet</h2>
    <form action="process_edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="pet_id" value="<?php echo $pet_id; ?>">
        
        <label for="pet_name">Pet Name:</label>
        <input type="text" name="pet_name" value="<?php echo htmlspecialchars($pet['name']); ?>" required>

        <label for="type">Type:</label>
        <select name="type" required>
            <option value="cat" <?php if ($pet['type'] == 'cat') echo 'selected'; ?>>Cat</option>
            <option value="dog" <?php if ($pet['type'] == 'dog') echo 'selected'; ?>>Dog</option>
        </select>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($pet['description']); ?></textarea>

        <label for="pet_image">Replace Image:</label>
        <input type="file" name="pet_image" accept="image/*">
        
        <label for="age">Age (months):</label>
        <input type="number" name="age" value="<?php echo htmlspecialchars($pet['age']); ?>" required>

        <label for="location">Location:</label>
        <input type="text" name="location" value="<?php echo htmlspecialchars($pet['location']); ?>" required>

        <button type="submit">Update</button>
    </form>
</div>
<?php
else:
    echo "<p>Unauthorized access.</p>";
endif;

$conn->close();
?>
