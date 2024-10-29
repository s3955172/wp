<?php 
include('includes/header.inc');
include('includes/nav.inc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = hash('sha256', $_POST['password']); // Hash password

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->rowCount() > 0) {
        echo "Username already exists. Please choose a different one.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $password]);
        echo "Registration successful. You can now <a href='login.php'>log in</a>.";
    }
}
?>

<main class="container">
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <div class="mb-3">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</main>

<?php include('includes/footer.inc'); ?>
