<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

$result = $conn->query("SELECT * FROM pets");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">All Pets</h2>
    <div class="row">
        <?php while ($pet = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded">
                    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" class="card-img-top rounded-top" alt="<?php echo htmlspecialchars($pet['petname']); ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">
                            <a href="details.php?id=<?php echo $pet['petid']; ?>" class="text-decoration-none text-dark">
                                <?php echo htmlspecialchars($pet['petname']); ?>
                            </a>
                        </h5>
                        <p class="card-text"><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></p>
                        <p class="card-text"><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> months</p>
                        <p class="card-text"><strong>Location:</strong> <?php echo htmlspecialchars($pet['location']); ?></p>
                    </div>
                    <div class="card-footer bg-white text-center">
                        <a href="details.php?id=<?php echo $pet['petid']; ?>" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.inc'; ?>
