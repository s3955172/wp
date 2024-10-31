<?php
session_start();
include 'db_connect.inc';
include 'header.inc';

if (!isset($_SESSION['username'])) {
    echo "<p>You must be logged in to view this page.</p>";
    include 'footer.inc';
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
    <?php if ($userPets): ?>
        <ul>
            <?php foreach ($userPets as $pet): ?>
                <li><a href="details.php?id=<?php echo $pet['id']; ?>"><?php echo htmlspecialchars($pet['name']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>You haven't uploaded any pets yet.</p>
    <?php endif; ?>
</div>

<?php include 'footer.inc'; ?>
