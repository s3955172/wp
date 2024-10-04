<?php 
include('includes/db_connect.inc');
include('includes/header.inc');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Victoria - Gallery</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<main>
    <h2>Pets Victoria Gallery</h2>
    <p>Explore the pets we have available for adoption.</p>
    
    <div class="gallery-grid">
        <?php
        // Fetch all pets with their images
        $stmt = $pdo->query("SELECT petid, petname, image, caption FROM pets");
        
        // Display each pet's image in the gallery
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imagePath = 'images/' . htmlspecialchars($row['image']);
            $petName = htmlspecialchars($row['petname']);
            $caption = htmlspecialchars($row['caption']);
            $petID = $row['petid'];

            echo "<div class='gallery-item'>";
            echo "<a href='details.php?id=$petID'>";
            echo "<img src='$imagePath' alt='$caption'>";
            echo "<div class='gallery-caption'>$petName</div>";
            echo "</a>";
            echo "</div>";
        }
        ?>
    </div>
</main>

<footer>
    <p>&copy; 2024 Pets Victoria. All Rights Reserved.</p>
</footer>

</body>
</html>
