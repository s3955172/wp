<?php 
include('includes/db_connect.inc');
include('includes/header.inc');
include('includes/nav.inc');

if (isset($_GET['id'])) {
    $petid = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM pets WHERE petid = :petid");
    $stmt->execute(['petid' => $petid]);
    $pet = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pet) {
        ?>
        <main>
            <h2><?php echo htmlspecialchars($pet['petname']); ?></h2>
            <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['caption']); ?>">
            <p><?php echo htmlspecialchars($pet['description']); ?></p>
            <ul>
                <li>Age: <?php echo htmlspecialchars($pet['age']); ?> months</li>
                <li>Type: <?php echo htmlspecialchars($pet['type']); ?></li>
                <li>Location: <?php echo htmlspecialchars($pet['location']); ?></li>
            </ul>
        </main>
        <?php
    } else {
        echo "<main><h2>Pet not found.</h2></main>";
    }
} else {
    echo "<main><h2>No pet selected.</h2></main>";
}

include('includes/footer.inc');
?>
