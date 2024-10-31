<nav class="main-nav">
    <!-- Logo as a clickable link to home -->
    <a href="index.php">
        <img src="images/logo.png" alt="Logo" class="logo">
    </a>
    <a href="index.php">Home</a>
    <a href="pets.php">Pets</a>
    <a href="gallery.php">Gallery</a>
    
    <?php if (isset($_SESSION['username'])): ?>
        <a href="add.php">Add Pet</a>
        <a href="user.php">My Pets</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    <?php endif; ?>
</nav>
