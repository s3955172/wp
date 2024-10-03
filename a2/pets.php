<?php include 'includes/header.inc'; ?>
<?php include 'includes/nav.inc'; ?>

<main>
    <h2>Available Pets</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Age</th>
            <th>Location</th>
        </tr>
        <?php
        include 'includes/db_connect.inc';
        $result = $conn->query("SELECT petid, petname, type, age, location FROM pets");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><a href='details.php?id=" . $row['petid'] . "'>" . $row['petname'] . "</a></td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['age'] . " months</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "</tr>";
        }

        $conn->close();
        ?>
    </table>
</main>

<?php include 'includes/footer.inc'; ?>
