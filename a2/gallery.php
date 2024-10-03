<?php include 'includes/header.inc'; ?>
<?php include 'includes/nav.inc'; ?>

<main>
    <h2>Pet Gallery</h2>
    <div class="gallery">
        <?php
        include 'includes/db_connect.inc';
        $result = $conn->query("SELECT petid, image, caption FROM pets");

        while ($row = $result->fetch_assoc()) {
            echo "<div class='gallery-item'>";
            echo "<a href='details.php?id=" . $row['petid'] . "'>";
            echo "<img src='images/" . $row['image'] . "' alt='" . $row['caption'] . "'>";
            echo "<p>" . $row['caption'] . "</p>";
            echo "</a>";
            echo "</div>";
        }

        $conn->close();
        ?>
    </div>
</main>

<?php include 'includes/footer.inc'; ?>
