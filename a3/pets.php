<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

$result = $conn->query("SELECT * FROM pets");
?>

<div class="container">
    <h2>All Pets</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Pet</th>
                <th>Type</th>
                <th>Age (months)</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pet = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <a href="details.php?id=<?php echo $pet['petid']; ?>">
                            <?php echo htmlspecialchars($pet['petname']); ?>
                        </a>
                        <br>
                        <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['petname']); ?>" width="80" height="80">
                    </td>
                    <td><?php echo htmlspecialchars($pet['type']); ?></td>
                    <td><?php echo htmlspecialchars($pet['age']); ?></td>
                    <td><?php echo htmlspecialchars($pet['location']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.inc'; ?>
