<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Victoria</title>
    
    <!-- Link to custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Link to Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    
    <!-- Link to custom JavaScript file -->
    <script src="js/scripts.js" defer></script>
</head>
<body>
<header class="main-header">
    <div class="logo-title">
        <a href="index.php">
            <img src="images/logo.png" alt="Pets Victoria Logo" class="logo">
        </a>
        <span class="site-title">Pets Victoria</span>
    </div>
    
    <!-- Search Bar and Dropdown Menu -->
    <div class="header-right d-flex align-items-center gap-3">
        <!-- Search Bar -->
        <form action="search.php" method="get" class="search-bar-form d-flex align-items-center">
            <input type="text" name="pet_name" placeholder="Search for pets..." class="form-control me-2" style="width: auto;">
            <button type="submit" class="btn btn-primary btn-sm">Search</button>
        </form>

        <!-- Dropdown Menu -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="pageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Pages
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="pageDropdown">
                <li><a class="dropdown-item" href="index.php">Home</a></li>
                <li><a class="dropdown-item" href="pets.php">Pets</a></li>
                <li><a class="dropdown-item" href="gallery.php">Gallery</a></li>
                <li><a class="dropdown-item" href="add.php">Add Pet</a></li>
                <li><a class="dropdown-item" href="user.php">My Pets</a></li>
                <li><a class="dropdown-item" href="login.php">Login</a></li>
                <li><a class="dropdown-item" href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Include the Navigation -->
    <?php include 'nav.inc'; ?>
</header>

<!-- Main Content -->
<!-- Content for the page goes here -->

<!-- Footer -->
<?php include 'includes/footer.inc'; ?>

<!-- Bootstrap JavaScript CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
