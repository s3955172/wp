<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

$result = $conn->query("SELECT * FROM pets");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">All Pets</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
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
                        <a href="details.php?id=<?php echo $pet['petid']; ?>" class="text-decoration-none text-dark">
                            <?php echo htmlspecialchars($pet['petname']); ?>
                        </a>
                        <br>
                        <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['petname']); ?>" width="80" height="80" class="rounded">
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
