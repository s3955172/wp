<?php 
include('includes/header.inc');
include('includes/nav.inc');
?>

<main class="container-fluid">
    <h1 class="text-center">Welcome to Pets Victoria</h1>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $stmt = $pdo->query("SELECT image FROM pets ORDER BY petid DESC LIMIT 4");
            $first = true;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $active = $first ? 'active' : '';
                echo "<div class='carousel-item $active'>";
                echo "<img src='images/" . htmlspecialchars($row['image']) . "' class='d-block w-100' alt='Pet Image' style='max-height: 500px;'>";
                echo "</div>";
                $first = false;
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
