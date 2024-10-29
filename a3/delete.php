<?php
include('includes/header.inc');
include('includes/nav.inc');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $petid = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM pets WHERE petid = :petid AND user_id = :user_id");
    $stmt->execute(['petid' => $petid, 'user_id' => $_SESSION['user_id']]);
    $pet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        echo "<p>Pet not found or you don't have permission to delete it.</p>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (file_exists("images/" . $pet['image'])) {
            unlink("images/" . $pet['image']);
        }

        $stmt = $pdo->prepare("DELETE FROM pets WHERE petid = :petid AND user_id = :user_id");
        $stmt->execute(['petid' => $petid, 'user_id' => $_SESSION['user_id']]);

        echo "<p>Pet record deleted successfully.</p>";
        header("Location: pets.php");
        exit;
    }
}
?>

<main class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <h2>Delete Pet</h2>
            <p>Are you sure you want to delete the pet "<?php echo htmlspecialchars($pet['petname']); ?>"?</p>
            
            <form method="post">
                <button type="submit" class="btn btn-danger w-100 mb-2">Yes, Delete</button>
                <a href="details.php?id=<?php echo htmlspecialchars($pet['petid']); ?>" class="btn btn-secondary w-100">Cancel</a>
            </form>
        </div>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
