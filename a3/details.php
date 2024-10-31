<?php
session_start();
include 'db_connect.inc';
include 'header.inc';

$pet_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("SELECT * FROM pets WHERE id = ?");
$stmt->bind_param("i", $pet_id);
$stmt->execute();
$result = $stmt->get_result();
$pet = $result->fetch_assoc();
$stmt->close();

if ($pet):
?>
<div class="container">
    <h2><?php echo htmlspecialchars($pet['name']); ?></h2>
    <img src="<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
    <p>Type: <?php echo htmlspecialchars($pet['type']); ?></p>
    <p>Age: <?php echo htmlspecialchars($pet['age']); ?> months</p>
    <p>Location: <?php echo htmlspecialchars($pet['location']); ?></p>
    <p>Description: <?php echo htmlspecialchars($pet['description']); ?></p>

    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === $pet['username']): ?>
        <a href="edit.php?id=<?php echo $pet_id; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $pet_id; ?>" onclick="return confirm('Are you sure you want to delete this pet?');">Delete</a>
    <?php endif; ?>
</div>
<?php
else:
    echo "<p>Pet not found.</p>";
endif;

include 'footer.inc';
$conn->close();
?>
