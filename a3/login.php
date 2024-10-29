<?php 
include('includes/header.inc');
include('includes/nav.inc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = hash('sha256', $_POST['password']); // Hash password

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $username, 'password' => $password]);

    if ($stmt->rowCount() == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid login credentials. Please try again.";
    }
}
?>

<main class="container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</main>

<?php include('includes/footer.inc'); ?>
