<?php
session_start();
include 'db_connect.inc';
include 'header.inc';

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
                    <td><a href="details.php?id=<?php echo $pet['id']; ?>"><?php echo htmlspecialchars($pet['name']); ?></a></td>
                    <td><?php echo htmlspecialchars($pet['type']); ?></td>
                    <td><?php echo htmlspecialchars($pet['age']); ?></td>
                    <td><?php echo htmlspecialchars($pet['location']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.inc'; ?>
