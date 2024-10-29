<?php
include('includes/db_connect.inc');
include('includes/header.inc');
include('includes/nav.inc');
?>

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

<?php include('includes/footer.inc'); ?>
