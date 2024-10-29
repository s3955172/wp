<?php 
include('includes/header.inc');
include('includes/nav.inc');

// Get search parameters from query
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$type = isset($_GET['type']) ? trim($_GET['type']) : '';

// Construct the SQL query based on provided search criteria
$query = "SELECT petid, petname, type, location, image, caption FROM pets WHERE 1=1";
$params = [];

if ($keyword) {
    $query .= " AND (petname LIKE :keyword OR description LIKE :keyword)";
    $params['keyword'] = '%' . $keyword . '%';
}

if ($type) {
    $query .= " AND type = :type";
    $params['type'] = $type;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container">
    <h2>Search for Pets</h2>
    
    <!-- Search Form -->
    <form action="search.php" method="get" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control" placeholder="Search by name or description" value="<?php echo htmlspecialchars($keyword); ?>">
            </div>
            <div class="col-md-4">
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <?php
                    // Fetch distinct pet types for dropdown
                    $types = $pdo->query("SELECT DISTINCT type FROM pets");
                    while ($row = $types->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($type === $row['type']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($row['type']) . "' $selected>" . htmlspecialchars($row['type']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    <?php if (!empty($pets)): ?>
        <div class="row">
            <?php foreach ($pets as $pet): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($pet['caption']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($pet['petname']); ?></h5>
                            <p class="card-text">
                                <strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?><br>
                                <strong>Location:</strong> <?php echo htmlspecialchars($pet['location']); ?>
                            </p>
                            <a href="details.php?id=<?php echo urlencode($pet['petid']); ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No pets found matching your search criteria.</p>
    <?php endif; ?>
</main>

<?php include('includes/footer.inc'); ?>
