<?php 
include('includes/db_connect.inc');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Victoria - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poetsen+One&family=Ysabeau+SC&display=swap" rel="stylesheet">
    <script src="js/scripts.js" defer></script>
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>
    <header>
        <nav>
            <a href="index.php"><img src="images/logo.png" alt="Pets Victoria Logo" class="logo"></a>
            <select onchange="navigate(this.value)">
                <option value="">Select an Option...</option>
                <option value="index.php">Home</option>
                <option value="pets.php">Pets</option>
                <option value="add.php">Add More</option>
                <option value="gallery.php">Gallery</option>
            </select>
            <form id="search-form" action="search.php" method="get">
                <input type="text" name="query" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </nav>
    </header>
    <main>
        <h1 class="site-title">Pets Victoria</h1>
        <h2>Welcome to Pet Adoption</h2>
        
        <!-- Centered Image -->
        <img src="images/main.jpg" alt="Adopt a Pet" class="main-image">

        <p>Explore the pets we have available for adoption and learn how you can bring a new member to your family.</p>
    </main>
    <footer>
        <p>&copy; s3955172. All Rights Reserved | Designed for Pets Victoria</p>
    </footer>
</body>
</html>
