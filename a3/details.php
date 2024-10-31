<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

if (isset($_GET['id'])) {
    $pet_id = (int)$_GET['id'];
    
    // Prepare and execute the statement to fetch pet details by petid
    $stmt = $conn->prepare("SELECT * FROM pets WHERE petid = ?");
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
    <h2><?php echo htmlspecialchars($pet['petname']); ?></h2>
    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['petname']); ?>">
    <p>Type: <?php echo htmlspecialchars($pet['type']); ?></p>
    <p>Age: <?php echo htmlspecialchars($pet['age']); ?> months</p>
    <p>Location: <?php echo htmlspecialchars($pet['location']); ?></p>
    <p>Description: <?php echo htmlspecialchars($pet['description']); ?></p>

    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === $pet['username']): ?>
        <a href="edit.php?id=<?php echo $pet['petid']; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $pet['petid']; ?>" onclick="return confirm('Are you sure you want to delete this pet?')">Delete</a>
    <?php endif; ?>
</div>

<?php include 'includes/footer.inc'; ?>
