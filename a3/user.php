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

<div class="container">
    <h2>Your Uploaded Pets</h2>
    <div class="gallery-container">
        <?php foreach ($userPets as $pet): ?>
            <div class="pet-item">
                <a href="details.php?id=<?php echo $pet['petid']; ?>">
                    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['petname']); ?>" class="pet-image">
                    <p><?php echo htmlspecialchars($pet['petname']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.inc'; ?>
