<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

// Fetch the latest 4 images for the carousel
$result = $conn->query("SELECT image FROM pets ORDER BY petid DESC LIMIT 4");
?>

<!-- Main Content Container -->
<div class="container-fluid homepage px-4">
    <!-- Carousel and Welcome Text Section -->
    <div class="carousel-and-title d-flex flex-column align-items-center">
        <!-- Photo Carousel -->
        <div class="carousel-container w-100 mb-4">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $isActive = true;
                    while ($image = $result->fetch_assoc()):
                    ?>
                        <div class="carousel-item <?php if ($isActive) { echo 'active'; $isActive = false; } ?>">
                            <img src="images/<?php echo htmlspecialchars($image['image']); ?>" class="d-block w-100" alt="Pet image" style="height: 250px; object-fit: cover;">
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
        <div class="welcome-text text-center mb-4">
            <h1>PETS VICTORIA</h1>
            <h3>WELCOME TO PET ADOPTION</h3>
        </div>
    </div>

    <!-- Full-Width Search UI -->
    <div class="search-container w-100 mb-4">
        <form action="search.php" method="get" class="d-flex gap-2">
            <input type="text" name="keyword" placeholder="Search by pet name or keyword..." class="form-control" style="flex: 2;">
            <select name="type" class="form-select" style="flex: 1;">
                <option value="">Select Pet Type</option>
                <option value="Cat">Cat</option>
                <option value="Dog">Dog</option>
                <!-- Add other types as needed -->
            </select>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Discover Section -->
    <div class="discover-section text-center mt-5">
        <h2>Discover Pets Victoria</h2>
        <p>Pets Victoria is a dedicated pet adoption organisation based in Victoria, Australia, focused on providing a safe and loving environment for pets in need. With a compassionate approach, Pets Victoria works tirelessly to rescue, rehabilitate, and rehome dogs, cats, and other animals. Their mission is to connect these deserving pets with caring individuals and families, creating lifelong bonds. The organisation offers a range of services, including adoption counseling, pet education, and community support programs, all aimed at promoting responsible pet ownership and reducing the number of homeless animals.</p>
    </div>
</div>

<!-- Footer -->
<?php include 'includes/footer.inc'; ?>
