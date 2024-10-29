<?php
include('includes/header.inc');
include('includes/nav.inc');

if (isset($_GET['id'])) {
    $petid = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM pets WHERE petid = :petid");
    $stmt->execute(['petid' => $petid]);
    $pet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        echo "Pet not found.";
        exit;
    }
}
?>

<main class="container">
    <h2>Pet Details: <?php echo htmlspecialchars($pet['petname']); ?></h2>
    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['caption']); ?>" class="img-fluid">
    
    <ul class="list-group mt-3">
        <li class="list-group-item"><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></li>
        <li class="list-group-item"><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> months</li>
        <li class="list-group-item"><strong>Location:</strong> <?php echo htmlspecialchars($pet['location']); ?></li>
        <li class="list-group-item"><strong>Description:</strong> <?php echo htmlspecialchars($pet['description']); ?></li>
    </ul>
    
    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $pet['user_id']): ?>
        <a href="edit.php?id=<?php echo htmlspecialchars($pet['petid']); ?>" class="btn btn-primary mt-3">Edit</a>
        <a href="delete.php?id=<?php echo htmlspecialchars($pet['petid']); ?>" class="btn btn-danger mt-3">Delete</a>
    <?php endif; ?>
</main>

<?php include('includes/footer.inc'); ?>
