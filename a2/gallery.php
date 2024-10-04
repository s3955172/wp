<?php 
include('db_connect.inc');
include('header.inc');
include('nav.inc');
?>

<main>
    <h2>Pets Victoria Gallery</h2>
    <div class="gallery-grid">
        <?php
        $sql = "SELECT petid, image, caption FROM pets";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='gallery-item'>";
                echo "<a href='details.php?id=" . $row['petid'] . "'>";
                echo "<img src='images/" . $row['image'] . "' alt='" . $row['caption'] . "'>";
                echo "<div class='gallery-caption'>" . $row['caption'] . "</div>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No pets found in the gallery.</p>";
        }
        ?>
    </div>
</main>

<?php include('footer.inc'); ?>
