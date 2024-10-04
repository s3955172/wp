<?php 
include('includes/db_connect.inc');
include('includes/header.inc');
include('includes/nav.inc');
?>

<main>
    <h2>Pets Victoria Gallery</h2>
    <div class="gallery-grid">
        <?php
        $stmt = $pdo->query("SELECT petid, image, caption FROM pets");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='gallery-item'>";
            echo "<a href='details.php?id=" . $row['petid'] . "'>";
            echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['caption']) . "'>";
            echo "<div class='gallery-caption'>" . htmlspecialchars($row['caption']) . "</div>";
            echo "</a>";
            echo "</div>";
        }
        ?>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
