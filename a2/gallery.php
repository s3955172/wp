<?php include('includes/header.inc'); ?>
<?php include('includes/nav.inc'); ?>
<main>
    <div class="gallery-grid">
        <?php
        include('includes/db_connect.inc');
        $stmt = $pdo->query("SELECT petid, image, caption FROM pets");
        while ($row = $stmt->fetch()) {
            echo "<div class='gallery-item'>";
            echo "<a href='details.php?id=" . $row['petid'] . "'><img src='images/" . $row['image'] . "' alt='" . $row['caption'] . "'></a>";
            echo "</div>";
        }
        ?>
    </div>
</main>
<?php include('includes/footer.inc'); ?>
