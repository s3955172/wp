<?php
include('includes/header.inc');
include('includes/nav.inc');

// Fetch the pet details based on the provided pet ID
if (isset($_GET['id'])) {
    $petid = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM pets WHERE petid = :petid");
    $stmt->execute(['petid' => $petid]);
    $pet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        echo "<p>Pet not found.</p>";
        exit;
    }
}
?>

<main class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Pet Details: <?php echo htmlspecialchars($pet['petname']); ?></h2>
            <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['caption']); ?>" class="img-fluid mb-3">
            
            <ul class="list-group">
                <li class="list-group-item"><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></li>
                <li class="list-group-item"><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> months</li>
                <li class="list-group-item"><strong>Location:</strong> <?php echo htmlspecialchars($pet['location']); ?></li>
                <li class="list-group-item"><strong>Description:</strong> <?php echo htmlspecialchars($pet['description']); ?></li>
            </ul>
            
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $pet['user_id']): ?>
                <!-- Edit Button -->
                <a href="edit.php?id=<?php echo htmlspecialchars($pet['petid']); ?>" class="btn btn-primary mt-3">Edit</a>
                
                <!-- Delete Button with JavaScript Confirmation -->
                <a href="delete.php?id=<?php echo htmlspecialchars($pet['petid']); ?>" 
                   onclick="return confirm('Are you sure you want to delete this pet? This action cannot be undone.');" 
                   class="btn btn-danger mt-3">Delete</a>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
