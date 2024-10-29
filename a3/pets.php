<?php 
include('includes/db_connect.inc');
include('includes/header.inc');
include('includes/nav.inc');
?>

<main>
    <h2>Available Pets</h2>
    <table>
        <thead>
            <tr>
                <th>Pet</th>
                <th>Type</th>
                <th>Age (months)</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $pdo->query("SELECT petid, petname, type, age, location FROM pets");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td><a href='details.php?id=" . urlencode($row['petid']) . "'>" . htmlspecialchars($row['petname']) . "</a></td>";
            echo "<td>" . htmlspecialchars($row['type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['age']) . "</td>";
            echo "<td>" . htmlspecialchars($row['location']) . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</main>

<?php include('includes/footer.inc'); ?>
