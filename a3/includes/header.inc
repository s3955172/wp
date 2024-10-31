<!-- header.inc -->
<div class="main-header">
    <!-- Logo and Site Title -->
    <div class="logo-title d-flex align-items-center">
        <a href="index.php">
            <img src="images/logo.png" alt="Pets Victoria Logo" class="logo">
        </a>
        <span class="site-title ms-2">Pets Victoria</span>
    </div>
    
    <!-- Search Bar and Dropdown Menu in Top Right -->
    <div class="header-right d-flex align-items-center gap-3 ms-auto">
        <!-- Search Bar -->
        <form action="search.php" method="get" class="d-flex align-items-center">
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
</div>
