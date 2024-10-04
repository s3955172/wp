<?php include('includes/header.inc'); ?>
<?php include('includes/nav.inc'); ?>
<main>
    <h2>Add a New Pet</h2>
    <form action="process_add.php" method="POST" enctype="multipart/form-data">
        <label for="name">Pet Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
            <option value="bird">Bird</option>
        </select><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="age">Age (months):</label>
        <input type="number" id="age" name="age" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" required><br>

        <button type="submit">Submit</button>
    </form>
</main>
<?php include('includes/footer.inc'); ?>
