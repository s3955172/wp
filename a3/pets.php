<?php
include('includes/header.inc');
include('includes/nav.inc');
?>

<main class="container-fluid">
    <h2 class="text-center">All Available Pets</h2>
    <table class="table table-responsive table-bordered table-hover">
        <thead>
            <tr>
                <th>Pet Name</th>
                <th>Type</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT petid, petname, type, location FROM pets");
            while ($pet = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>" . htmlspecialchars($pet['petname']) . "</td>
                        <td>" . htmlspecialchars($pet['type']) . "</td>
                        <td>" . htmlspecialchars($pet['location']) . "</td>
                        <td><a href='details.php?id=" . urlencode($pet['petid']) . "' class='btn btn-primary btn-sm'>View Details</a></td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<?php include('includes/footer.inc'); ?>
