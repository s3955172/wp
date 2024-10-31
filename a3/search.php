<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyword = "%" . htmlspecialchars($_POST['keyword']) . "%";
    $type = $_POST['type'] !== "all" ? htmlspecialchars($_POST['type']) : "";

    // Prepare the SQL statement based on whether a type is selected
    if ($type) {
        $stmt = $conn->prepare("SELECT * FROM pets WHERE (petname LIKE ? OR description LIKE ?) AND type = ?");
        $stmt->bind_param("sss", $keyword, $keyword, $type);
    } else {
        $stmt = $conn->prepare("SELECT * FROM pets WHERE petname LIKE ? OR description LIKE ?");
        $stmt->bind_param("ss", $keyword, $keyword);
    }

    // Execute and fetch results
    $stmt->execute();
    $searchResults = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<div class="container">
    <h2>Search Pets</h2>
    <form method="post" action="">
        <label for="keyword">Keyword:</label>
        <input type="text" name="keyword" id="keyword" required>

        <label for="type">Type:</label>
        <select name="type">
            <option value="all">All Types</option>
            <option value="Cat">Cat</option>
            <option value="Dog">Dog</option>
        </select>

        <button type="submit">Search</button>
    </form>

    <div class="results">
        <?php if ($searchResults): ?>
            <ul>
                <?php foreach ($searchResults as $pet): ?>
                    <li>
                        <a href="details.php?id=<?php echo $pet['petid']; ?>">
                            <?php echo htmlspecialchars($pet['petname']); ?>
                        </a> - <?php echo htmlspecialchars($pet['type']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.inc'; ?>
