<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $keyword = isset($_GET['keyword']) ? "%" . htmlspecialchars($_GET['keyword']) . "%" : '';
    $type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '';

    // Prepare the SQL query based on whether type is specified
    if ($type) {
        $stmt = $conn->prepare("SELECT * FROM pets WHERE (petname LIKE ? OR description LIKE ?) AND type = ?");
        $stmt->bind_param("sss", $keyword, $keyword, $type);
    } else {
        $stmt = $conn->prepare("SELECT * FROM pets WHERE petname LIKE ? OR description LIKE ?");
        $stmt->bind_param("ss", $keyword, $keyword);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $searchResults = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Search Results</h2>
    <?php if (!empty($searchResults)): ?>
        <div class="row">
            <?php foreach ($searchResults as $pet): ?>
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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No results found. Please try again with a different keyword or type.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.inc'; ?>
