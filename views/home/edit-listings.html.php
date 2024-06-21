<br>
<br>
<div class="container">
    <h1>Edit Listing</h1>
    <form action="/edit-residence/<?= $listing->getId() ?>" method="post">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($listing->getTitle()) ?>" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?= htmlspecialchars($listing->getDescription()) ?></textarea>
        </div>
        <div>
            <label for="price_per_night">Price per Night:</label>
            <input type="text" id="price_per_night" name="price_per_night" value="<?= htmlspecialchars($listing->getPricePerNight()) ?>" required>
        </div>
        <!-- Add more fields as needed -->
        <div>
            <button type="submit">Save Changes</button>
        </div>
    </form>
</div>
<br>
<br>