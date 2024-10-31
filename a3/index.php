<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

// Fetch the latest 4 images for the carousel
$result = $conn->query("SELECT image FROM pets ORDER BY petid DESC LIMIT 4");
?>

<!-- Main Content Container -->
<div class="container homepage">
    <!-- Carousel and Welcome Text Section -->
    <div class="carousel-and-title">
        <!-- Photo Carousel -->
        <div class="carousel-container">
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

        <!-- Welcome Text -->
        <div class="welcome-text">
            <h1>PETS VICTORIA</h1>
            <h3>WELCOME TO PET ADOPTION</h3>
        </div>
    </div>

    <!-- Search UI -->
    <div class="search-container">
        <form action="search.php" method="get">
            <input type="text" name="pet_name" placeholder="I am looking for (pet name)">
            <select name="pet_type">
                <option value="">Select your pet type</option>
                <option value="Cat">Cat</option>
                <option value="Dog">Dog</option>
                <!-- Add other types as needed -->
            </select>
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Discover Section -->
    <div class="discover-section">
        <h2>Discover Pets Victoria</h2>
        <p>Explore a range of pets waiting for a new home and find resources to help you choose your perfect companion.</p>
    </div>
</div>

<!-- Footer -->
<?php include 'includes/footer.inc'; ?>
