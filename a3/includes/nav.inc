<nav>
    <a href="index.php">Home</a>
    <a href="gallery.php">Gallery</a>
    <?php if (isset($_SESSION['username'])): ?>
        <a href="add.php">Add Pet</a>
        <a href="user.php">My Pets</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>
