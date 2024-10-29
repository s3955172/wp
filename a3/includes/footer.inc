<?php
// footer.inc file - shared footer for all pages
?>

<div class="container-fluid mt-4">
    <footer class="py-3">
        <p class="text-center">&copy; Pets Victoria. All rights reserved.</p>

        <!-- User Navigation Links -->
        <div class="mt-4">
            <h5 class="text-center">Browse Pets by User</h5>
            <ul class="list-unstyled d-flex justify-content-center flex-wrap">
                <?php
                // Query to fetch users who have uploaded at least one pet
                $stmt = $pdo->query("SELECT DISTINCT users.username FROM users JOIN pets ON users.user_id = pets.user_id");

                // Loop through each user and display as a link
                while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li class='me-3'>
                            <a href='user.php?username=" . urlencode($user['username']) . "' class='text-decoration-none'>" . htmlspecialchars($user['username']) . "</a>
                          </li>";
                }
                ?>
            </ul>
        </div>
    </footer>
</div>

</body>
</html>
