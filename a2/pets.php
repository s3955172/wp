<?php 
include('db_connect.inc');
include('header.inc');
include('nav.inc');
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
        $sql = "SELECT petid, petname, type, age, location FROM pets";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='details.php?id=" . $row['petid'] . "'>" . $row['petname'] . "</a></td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No pets available</td></tr>";
        }
        ?>
        </tbody>
    </table>
</main>

<?php include('footer.inc'); ?>
