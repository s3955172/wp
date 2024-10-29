<?php
include('includes/header.inc');
include('includes/nav.inc');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $petname = $_POST['petname'];
    $description = $_POST['description'];
    $caption = $_POST['caption'];
    $age = $_POST['age'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $user_id = $_SESSION['user_id'];

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
                $stmt = $pdo->prepare("INSERT INTO pets (petname, description, caption, age, type, location, image, user_id)
                                       VALUES (:petname, :description, :caption, :age, :type, :location, :image, :user_id)");
                $stmt->execute([
                    'petname' => $petname,
                    'description' => $description,
                    'caption' => $caption,
                    'age' => $age,
                    'type' => $type,
                    'location' => $location,
                    'image' => $image,
                    'user_id' => $user_id,
                ]);

                echo "New pet added successfully.";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid image type.";
        }
    } else {
        echo "File upload error.";
    }
}
?>

<main class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center">Add a Pet</h2>
            <form action="add.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name">Pet Name:</label>
                    <input type="text" id="name" name="petname" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="type">Type:</label>
                    <select id="type" name="type" class="form-select" required>
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                        <option value="bird">Bird</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="image">Select an Image:</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                </div>
                
                <div class="mb-3">
                    <label for="caption">Image Caption:</label>
                    <input type="text" id="caption" name="caption" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="age">Age (months):</label>
                    <input type="number" id="age" name="age" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
