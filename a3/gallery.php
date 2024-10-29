<?php 
include('includes/header.inc');
include('includes/nav.inc');
?>

<main class="container">
    <h2>Pet Gallery</h2>
    <p>Select a type to filter the pets:</p>
    
    <!-- Dropdown for pet type filtering -->
    <select id="type-filter" class="form-select" onchange="filterPetsByType()">
        <option value="">All Types</option>
        <?php
        $types = $pdo->query("SELECT DISTINCT type FROM pets");
        while ($type = $types->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . htmlspecialchars($type['type']) . "'>" . htmlspecialchars($type['type']) . "</option>";
        }
        ?>
    </select>

    <div class="gallery-grid mt-4">
        <?php
        $typeFilter = isset($_GET['type']) ? $_GET['type'] : '';
        $query = "SELECT petid, petname, image, caption FROM pets";
        if ($typeFilter) {
            $query .= " WHERE type = :type";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['type' => $typeFilter]);
        } else {
            $stmt = $pdo->query($query);
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='gallery-item'>
                    <a href='details.php?id=" . urlencode($row['petid']) . "'>
                        <img src='images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['caption']) . "' class='img-thumbnail'>
                        <div class='gallery-caption'>" . htmlspecialchars($row['petname']) . "</div>
                    </a>
                  </div>";
        }
        ?>
    </div>
</main>

<script>
function filterPetsByType() {
    var type = document.getElementById("type-filter").value;
    window.location.href = "gallery.php?type=" + encodeURIComponent(type);
}
</script>

<?php include('includes/footer.inc'); ?>
