<?php
include('includes/header.inc');
include('includes/nav.inc');

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Confirm deletion if a valid pet ID is provided
if (isset($_GET['id'])) {
    $petid = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM pets WHERE petid = :petid AND user_id = :user_id");
    $stmt->execute(['petid' => $petid, 'user_id' => $_SESSION['user_id']]);
    $pet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        echo "Pet not found or you don't have permission to delete it.";
        exit;
    }
    
    // Delete pet after confirmation
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Delete the pet's image from the file system
        if (file_exists("images/" . $pet['image'])) {
            unlink("images/" . $pet['image']);
        }

        // Delete the pet record from the database
        $stmt = $pdo->prepare("DELETE FROM pets WHERE petid = :petid AND user_id = :user_id");
        $stmt->execute(['petid' => $petid, 'user_id' => $_SESSION['user_id']]);

        echo "Pet record deleted successfully.";
        header("Location: pets.php");
        exit;
    }
}
?>

<main class="container">
    <h2>Delete Pet</h2>
    <p>Are you sure you want to delete the pet "<?php echo htmlspecialchars($pet['petname']); ?>"?</p>
    
    <form method="post">
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
        <a href="details.php?id=<?php echo htmlspecialchars($pet['petid']); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</main>

<?php include('includes/footer.inc'); ?>
