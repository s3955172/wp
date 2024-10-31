<?php
// Include database connection if not already included
include 'includes/db_connect.inc';

// Fetch distinct usernames of users who have uploaded pets
$userResult = $conn->query("SELECT DISTINCT username FROM pets");
$users = $userResult->fetch_all(MYSQLI_ASSOC);
?>

<footer class="text-center p-3" style="background-color: #333; color: #fff;">
    <p>s3955172</p>
    <p>&copy; 2024 Pets Victoria. All rights reserved.</p>
    
    <!-- Display usernames with links to their pets -->
    <div class="user-links mt-3">
        <h5>Users who have uploaded pets:</h5>
        <nav class="user-nav">
            <?php foreach ($users as $user): ?>
                <a href="user.php?username=<?php echo htmlspecialchars($user['username']); ?>" class="text-light mx-2">
                    <?php echo htmlspecialchars($user['username']); ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</footer>

<!-- Bootstrap JavaScript CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
