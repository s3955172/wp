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
    $stmt = $conn->prepare("SELECT * FROM pets WHERE petid = ?");
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();
    $pet = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    if (!$pet) {
        echo "<p>Pet not found.</p>";
        include 'includes/footer.inc';
        exit;
    }
    
    // Check if the logged-in user owns the pet
    if ($pet['username'] != $_SESSION['username']) {
        echo "<p>Unauthorized access.</p>";
        include 'includes/footer.inc';
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
            echo "<p class='error-message'>Failed to upload new image.</p>";
        }
    }

    // Update pet data
    $stmt = $conn->prepare("UPDATE pets SET petname = ?, type = ?, description = ?, age = ?, location = ?, image = ? WHERE petid = ?");
    $stmt->bind_param("sssissi", $pet_name, $type, $description, $age, $location, $updated_image, $pet_id);

    if ($stmt->execute()) {
        header("Location: details.php?id=" . $pet_id);
        exit;
    } else {
        echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Pet Details</h2>
    <form action="edit.php?id=<?php echo $pet_id; ?>" method="post" enctype="multipart/form-data" class="add-pet-form">
        <div class="mb-3">
            <label for="pet_name" class="form-label">Pet Name:</label>
            <input type="text" name="pet_name" id="pet_name" class="form-control" value="<?php echo htmlspecialchars($pet['petname']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type:</label>
            <input type="text" name="type" id="type" class="form-control" value="<?php echo htmlspecialchars($pet['type']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" class="form-control" required><?php echo htmlspecialchars($pet['description']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age (Months):</label>
            <input type="number" name="age" id="age" class="form-control" value="<?php echo htmlspecialchars($pet['age']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location:</label>
            <input type="text" name="location" id="location" class="form-control" value="<?php echo htmlspecialchars($pet['location']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="pet_image" class="form-label">Pet Image (Optional):</label>
            <input type="file" name="pet_image" id="pet_image" class="form-control">
            <?php if ($pet['image']): ?>
                <small>Current image: <?php echo htmlspecialchars($pet['image']); ?></small>
            <?php endif; ?>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update Pet</button>
            <a href="details.php?id=<?php echo $pet_id; ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include 'includes/footer.inc'; ?>
