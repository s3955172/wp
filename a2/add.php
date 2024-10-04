<?php 
include('db_connect.inc');
include('header.inc');
include('nav.inc');
?>

<main>
    <h2>Add a Pet</h2>
    <p>You can add a new pet here</p>
    <form action="process_add.php" method="post" enctype="multipart/form-data" class="pet-form">
        <label for="name">Pet Name:</label>
        <input type="text" id="name" name="petname" placeholder="Provide a name for the pet" required><br>

        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="">--Choose an option--</option>
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
            <option value="bird">Bird</option>
        </select><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" placeholder="Describe the pet briefly" required></textarea><br>

        <label for="image">Select an Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <span class="hint">Max image size: 500px</span><br>

        <label for="caption">Image Caption:</label>
        <input type="text" id="caption" name="caption" placeholder="Describe the image in one word" required><br>

        <label for="age">Age (months):</label>
        <input type="number" id="age" name="age" placeholder="Age of the pet in months" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" placeholder="Location of the pet" required><br>

        <div class="form-actions">
            <button type="submit" class="submit-button">Submit</button>
            <button type="reset" class="clear-button">Clear</button>
        </div>
    </form>
</main>

<?php include('footer.inc'); ?>
