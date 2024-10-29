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
        echo "<main>
                <img src='images/" . htmlspecialchars($pet['image']) . "' alt='" . htmlspecialchars($pet['caption']) . "' class='main-image'>
                <h2>" . htmlspecialchars($pet['petname']) . "</h2>
                <ul class='pet-info'>
                    <li><strong>Type:</strong> " . htmlspecialchars($pet['type']) . "</li>
                    <li><strong>Age:</strong> " . htmlspecialchars($pet['age']) . " months</li>
                    <li><strong>Location:</strong> " . htmlspecialchars($pet['location']) . "</li>
                </ul>
                <p>" . htmlspecialchars($pet['description']) . "</p>
              </main>";
    } else {
        echo "<main><h2>Pet not found.</h2></main>";
    }
} else {
    echo "<main><h2>No pet selected.</h2></main>";
}

include('includes/footer.inc');
?>
