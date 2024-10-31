<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

if (isset($_GET['id'])) {
    $pet_id = (int)$_GET['id'];
    
    $stmt = $conn->prepare("SELECT * FROM pets WHERE id = ?");
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();
    $pet = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$pet) {
        echo "Pet not found.";
        exit;
    }
}
?>

<div class="container">
    <h2><?php echo htmlspecialchars($pet['name']); ?></h2>
    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
    <p>Type: <?php echo htmlspecialchars($pet['type']); ?></p>
    <p>Age: <?php echo htmlspecialchars($pet['age']); ?> months</p>
    <p>Location: <?php echo htmlspecialchars($pet['location']); ?></p>
    <p>Description: <?php echo htmlspecialchars($pet['description']); ?></p>

    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === $pet['username']): ?>
        <a href="edit.php?id=<?php echo $pet['id']; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $pet['id']; ?>" onclick="return confirm('Are you sure you want to delete this pet?')">Delete</a>
    <?php endif; ?>
</div>

<?php include 'footer.inc'; ?>
