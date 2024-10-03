<?php include 'includes/header.inc'; ?>
<?php include 'includes/nav.inc'; ?>

<main>
    <h2>Add a New Pet</h2>
    <form action="process_new_pet.php" method="post" enctype="multipart/form-data">
        <label for="petname">Pet Name:</label>
        <input type="text" id="petname" name="petname" required>

        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
        </select>

        <label for="age">Age (in months):</label>
        <input type="number" id="age" name="age" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="image">Pet Image:</label>
        <input type="file" id="image" name="image" required>

        <button type="submit">Add Pet</button>
    </form>
</main>

<?php include 'includes/footer.inc'; ?>
