<?php include('includes/header.inc'); ?>
<?php include('includes/nav.inc'); ?>
<main>
    <?php
    include('includes/db_connect.inc');
    $stmt = $pdo->prepare("SELECT * FROM pets WHERE petid = ?");
    $stmt->execute([$_GET['id']]);
    $pet = $stmt->fetch();
    ?>
    <h2><?php echo $pet['petname']; ?></h2>
    <p><strong>Type:</strong> <?php echo $pet['type']; ?></p>
    <p><strong>Age:</strong> <?php echo $pet['age']; ?> months</p>
    <p><strong>Description:</strong> <?php echo $pet['description']; ?></p>
    <p><strong>Location:</strong> <?php echo $pet['location']; ?></p>
    <img src="images/<?php echo $pet['image']; ?>" alt="<?php echo $pet['caption']; ?>">
</main>
<?php include('includes/footer.inc'); ?>
