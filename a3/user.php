<?php 
include('includes/header.inc');
include('includes/nav.inc');

// Check if the username is provided in the URL
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Retrieve the user ID associated with the provided username
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<p>User not found.</p>";
        exit;
    }

    $user_id = $user['user_id'];

    // Fetch pets uploaded by this user
    $stmt = $pdo->prepare("SELECT petid, petname, type, location, image, caption FROM pets WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "<p>No user specified.</p>";
    exit;
}
?>

<main class="container">
    <h2>Pets Uploaded by <?php echo htmlspecialchars($username); ?></h2>

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
        <p>No pets uploaded by this user.</p>
    <?php endif; ?>
</main>

<?php include('includes/footer.inc'); ?>
