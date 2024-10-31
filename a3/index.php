<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

// Execute the query to get the latest 4 images
$result = $conn->query("SELECT image FROM pets ORDER BY petid DESC LIMIT 4");

if ($result === false) {
    // Display an error message if the query fails
    echo "<p>Error fetching images: " . $conn->error . "</p>";
    exit;
}
?>

<div class="container">
    <h2>Welcome to Pets Victoria</h2>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $isActive = true;
            while ($image = $result->fetch_assoc()):
            ?>
                <div class="carousel-item <?php if ($isActive) { echo 'active'; $isActive = false; } ?>">
                    <img src="images/<?php echo htmlspecialchars($image['image']); ?>" class="d-block w-100" alt="Pet image">
                </div>
            <?php endwhile; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<?php include 'includes/footer.inc'; ?>
