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
        $stmt = $pdo->query("SELECT petid, petname, image, caption FROM pets");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imagePath = 'images/' . htmlspecialchars($row['image']);
            $petID = $row['petid'];

            echo "<div class='gallery-item'>
                    <a href='details.php?id=" . urlencode($petID) . "'>
                        <img src='$imagePath' alt='" . htmlspecialchars($row['caption']) . "'>
                        <div class='gallery-caption'>" . htmlspecialchars($row['petname']) . "</div>
                    </a>
                  </div>";
        }
        ?>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
