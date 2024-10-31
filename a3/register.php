<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert only the username and password
    $stmt = $conn->prepare("INSERT INTO users (username, password, reg_date) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirect to the home page after successful registration
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
