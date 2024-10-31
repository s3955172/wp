<?php
session_start();
include 'includes/db_connect.inc';
include 'includes/header.inc';

$result = $conn->query("SELECT * FROM pets");
?>

<div class="container mt-5">
    <!-- Updated Title and Description -->
    <h2 class="text-center mb-4">Discover Pets Victoria</h2>
    <p class="text-center" style="max-width: 800px; margin: 0 auto; color: #555;">
        Pets Victoria is a dedicated pet adoption organisation based in Victoria, Australia, focused on providing a safe and loving environment for the pets in need. With a compassionate approach, Pets Victoria works tirelessly to rescue, rehabilitate, and rehome dogs, cats, and other animals. Their mission is to connect these deserving pets with caring individuals and families, creating lifelong bonds. The organisation offers a range of services, including adoption counselling, pet education, and community support programs, all aimed at promoting responsible pet ownership and reducing the number of homeless animals.
    </p>

    <!-- Cards for Pets -->
    <div class="row mt-5">
        <?php while ($pet = $result->fetch_assoc()): ?>
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded h-100">
                    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" class="card-img-top rounded-top" alt="<?php echo htmlspecialchars($pet['petname']); ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center mb-3">
                            <a href="details.php?id=<?php echo $pet['petid']; ?>" class="text-decoration-none text-dark">
                                <?php echo htmlspecialchars($pet['petname']); ?>
                            </a>
                        </h5>
                        <p class="card-text"><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></p>
                        <p class="card-text"><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> months</p>
                        <p class="card-text"><strong>Location:</strong> <?php echo htmlspecialchars($pet['location']); ?></p>
                        <div class="mt-auto text-center">
                            <a href="details.php?id=<?php echo $pet['petid']; ?>" class="btn btn-primary btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.inc'; ?>
