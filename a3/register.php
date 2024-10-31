<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = hash('sha1', $_POST['password']); // SHA-1 hash for compatibility

    $stmt = $conn->prepare("INSERT INTO users (username, password, reg_date) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php"); // Redirect to login page after successful registration
        exit;
    } else {
        $error = "Registration failed. Please try again.";
    }
    $stmt->close();
}
?>

<div class="container">
    <h2>Register</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Register</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</div>

<?php include 'includes/footer.inc'; ?>
