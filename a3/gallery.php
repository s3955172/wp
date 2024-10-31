<?php
session_start();
include 'db_connect.inc';
include 'header.inc';

$types = $conn->query("SELECT DISTINCT type FROM pets");
?>

<div class="container">
    <h2>Gallery</h2>

    <select id="petTypeFilter" onchange="filterPets()">
        <option value="all">All Types</option>
        <?php while ($type = $types->fetch_assoc()): ?>
            <option value="<?php echo htmlspecialchars($type['type']); ?>">
                <?php echo htmlspecialchars($type['type']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <div id="petGallery">
        <?php
        $pets = $conn->query("SELECT * FROM pets");
        while ($pet = $pets->fetch_assoc()):
        ?>
            <div class="pet-item" data-type="<?php echo htmlspecialchars($pet['type']); ?>">
                <a href="details.php?id=<?php echo $pet['id']; ?>">
                    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                    <p><?php echo htmlspecialchars($pet['name']); ?></p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
function filterPets() {
    let selectedType = document.getElementById("petTypeFilter").value;
    let pets = document.getElementsByClassName("pet-item");
    for (let pet of pets) {
        if (selectedType === "all" || pet.dataset.type === selectedType) {
            pet.style.display = "block";
        } else {
            pet.style.display = "none";
        }
    }
}
</script>

<?php include 'footer.inc'; ?>
