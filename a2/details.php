<?php include 'includes/header.inc'; ?>
<?php include 'includes/nav.inc'; ?>

<main>
    <?php
    include 'includes/db_connect.inc';
    $petid = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT petname, description, age, type, location, image FROM pets WHERE petid = ?");
    $stmt->bind_param("i", $petid);
    $stmt->execute();
    $stmt->bind_result($petname, $description, $age, $type, $location, $image);
    $stmt->fetch();

    if ($petname) {
        echo "<h1>$petname</h1>";
        echo "<p><strong>Type:</strong> $type</p>";
        echo "<p><strong>Age:</strong> $age months</p>";
        echo "<p><strong>Location:</strong> $location</p>";
        echo "<p><strong>Description:</strong> $description</p>";
        echo "<img src='images/$image' alt='$petname'>";
    } else {
        echo "<p>Pet not found.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
</main>

<?php include 'includes/footer.inc'; ?>
