<?php 
include('db_connect.inc');
include('header.inc');
include('nav.inc');

$petid = $_GET['id'];
$sql = "SELECT * FROM pets WHERE petid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $petid);
$stmt->execute();
$result = $stmt->get_result();
$pet = $result->fetch_assoc();

if ($pet):
?>

<main>
    <h2><?php echo $pet['petname']; ?></h2>
    <img src="images/<?php echo $pet['image']; ?>" alt="<?php echo $pet['caption']; ?>">
    <p><?php echo $pet['description']; ?></p>
    <ul>
        <li>Age: <?php echo $pet['age']; ?> months</li>
        <li>Type: <?php echo $pet['type']; ?></li>
        <li>Location: <?php echo $pet['location']; ?></li>
    </ul>
</main>

<?php else: ?>
    <main>
        <h2>Pet not found.</h2>
    </main>
<?php endif; ?>

<?php include('footer.inc'); ?>
