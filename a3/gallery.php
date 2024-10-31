<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

$result = $conn->query("SELECT * FROM pets");

?>

<div class="container">
    <h2>Gallery</h2>
    <div class="gallery-container">
        <?php while ($pet = $result->fetch_assoc()): ?>
            <div class="pet-item">
                <a href="details.php?id=<?php echo $pet['id']; ?>">
                    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                    <p><?php echo htmlspecialchars($pet['name']); ?></p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'footer.inc'; ?>
