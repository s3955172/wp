<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

// Fetch all pets
$result = $conn->query("SELECT * FROM pets");

if ($result === false) {
    echo "Error fetching pets: " . $conn->error;
    exit;
}
?>

<div class="container">
    <h2>Gallery</h2>
    <div class="gallery-container">
        <?php while ($pet = $result->fetch_assoc()): ?>
            <div class="pet-item">
                <a href="details.php?id=<?php echo $pet['petid']; ?>">
                    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['petname']); ?>">
                    <p><?php echo htmlspecialchars($pet['petname']); ?></p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.inc'; ?>
