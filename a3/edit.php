<?php
include('includes/header.inc');
include('includes/nav.inc');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $petid = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM pets WHERE petid = :petid AND user_id = :user_id");
    $stmt->execute(['petid' => $petid, 'user_id' => $_SESSION['user_id']]);
    $pet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        echo "<p>Pet not found or you don't have permission to edit it.</p>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $petname = $_POST['petname'];
    $description = $_POST['description'];
    $caption = $_POST['caption'];
    $age = $_POST['age'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $petid = $_POST['petid'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $check = getimagesize($_FILES['image']['tmp_name']);
        
        if ($check !== false && in_array($imageFileType, $allowed_types)) {
            if (file_exists($target_file)) {
                $image = time() . '_' . $image;
                $target_file = $target_dir . $image;
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                if (!empty($pet['image']) && file_exists("images/" . $pet['image'])) {
                    unlink("images/" . $pet['image']);
                }

                $stmt = $pdo->prepare("UPDATE pets SET petname = :petname, description = :description, caption = :caption, age = :age, type = :type, location = :location, image = :image WHERE petid = :petid AND user_id = :user_id");
                $stmt->execute([
                    'petname' => $petname,
                    'description' => $description,
                    'caption' => $caption,
                    'age' => $age,
                    'type' => $type,
                    'location' => $location,
                    'image' => $image,
                    'petid' => $petid,
                    'user_id' => $_SESSION['user_id']
                ]);

                echo "Pet details updated successfully.";
            }
        }
    } else {
        $stmt = $pdo->prepare("UPDATE pets SET petname = :petname, description = :description, caption = :caption, age = :age, type = :type, location = :location WHERE petid = :petid AND user_id = :user_id");
        $stmt->execute([
            'petname' => $petname,
            'description' => $description,
            'caption' => $caption,
            'age' => $age,
            'type' => $type,
            'location' => $location,
            'petid' => $petid,
            'user_id' => $_SESSION['user_id']
        ]);

        echo "Pet details updated successfully.";
    }
}
?>

<main class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center">Edit Pet</h2>
            <form action="edit.php?id=<?php echo htmlspecialchars($pet['petid']); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="petid" value="<?php echo htmlspecialchars($pet['petid']); ?>">
                
                <div class="mb-3">
                    <label for="name">Pet Name:</label>
                    <input type="text" id="name" name="petname" value="<?php echo htmlspecialchars($pet['petname']); ?>" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="type">Type:</label>
                    <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($pet['type']); ?>" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($pet['description']); ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="image">Change Image (optional):</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                </div>
                
                <div class="mb-3">
                    <label for="caption">Image Caption:</label>
                    <input type="text" id="caption" name="caption" value="<?php echo htmlspecialchars($pet['caption']); ?>" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="age">Age (months):</label>
                    <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($pet['age']); ?>" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($pet['location']); ?>" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
        </div>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
