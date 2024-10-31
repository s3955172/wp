<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

// Fetch all pets or filter by type if specified
$typeFilter = isset($_GET['type']) ? $_GET['type'] : 'all';
$query = "SELECT * FROM pets" . ($typeFilter != 'all' ? " WHERE type = ?" : "");
$stmt = $conn->prepare($query);

if ($typeFilter != 'all') {
    $stmt->bind_param("s", $typeFilter);
}

$stmt->execute();
$pets = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="container">
    <h2>Pet Gallery</h2>

    <!-- Pet Type Filter Dropdown -->
    <div class="filter-container">
        <label for="type">Filter by Type:</label>
        <select id="type-filter" name="type" onchange="filterPets()">
            <option value="all" <?php echo $typeFilter == 'all' ? 'selected' : ''; ?>>All Types</option>
            <option value="Cat" <?php echo $typeFilter == 'Cat' ? 'selected' : ''; ?>>Cat</option>
            <option value="Dog" <?php echo $typeFilter == 'Dog' ? 'selected' : ''; ?>>Dog</option>
        </select>
    </div>

    <!-- Gallery Display -->
    <div class="gallery-container">
        <?php foreach ($pets as $pet): ?>
            <div class="pet-item">
                <!-- Link to details.php with petid as parameter -->
                <a href="details.php?id=<?php echo $pet['petid']; ?>">
                    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['petname']); ?>" class="pet-image">
                    <p class="pet-name"><?php echo htmlspecialchars($pet['petname']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- JavaScript for Filtering Pets -->
<script>
function filterPets() {
    const type = document.getElementById('type-filter').value;
    window.location.href = "gallery.php?type=" + type;
}
</script>

<?php include 'includes/footer.inc'; ?>
