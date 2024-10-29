<?php 
include('includes/header.inc');
include('includes/nav.inc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = hash('sha256', $_POST['password']); 

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->rowCount() > 0) {
        echo "Username already exists.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $password]);
        echo "Registration successful. <a href='login.php'>Log in</a>.";
    }
}
?>

<main class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <h2 class="text-center">Register</h2>
            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
        </div>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
