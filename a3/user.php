<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

if (!isset($_SESSION['username'])) {
    echo "<p>You must be logged in to view this page.</p>";
    include 'includes/footer.inc';
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
$stmt = $conn->prepare("SELECT * FROM pets WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$userPets = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Your Uploaded Pets</h2>
    <div class="row">
        <?php if (count($userPets) > 0): ?>
            <?php foreach ($userPets as $pet): ?>
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded h-100">
                        <a href="details.php?id=<?php echo $pet['petid']; ?>" class="text-decoration-none">
                            <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['petname']); ?>" class="card-img-top pet-image" style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($pet['petname']); ?></h5>
                            <p class="card-text"><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></p>
                            <p class="card-text"><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> months</p>
                            <p class="card-text"><strong>Location:</strong> <?php echo htmlspecialchars($pet['location']); ?></p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="edit.php?id=<?php echo $pet['petid']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?php echo $pet['petid']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this pet?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">You haven't uploaded any pets yet.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.inc'; ?>
