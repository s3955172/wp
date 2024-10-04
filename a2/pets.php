<?php include('includes/header.inc'); ?>
<?php include('includes/nav.inc'); ?>
<main>
    <h2>Available Pets</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Age</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('includes/db_connect.inc');
            $stmt = $pdo->query("SELECT petid, petname, type, age, location FROM pets");
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td><a href='details.php?id=" . $row['petid'] . "'>" . $row['petname'] . "</a></td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['age'] . " months</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</main>
<?php include('includes/footer.inc'); ?>
