<br>
<br>
<div class="container">
    <h1>Manage Your Listings</h1>

    <?php if (empty($listings)): ?>
        <p>You have no listings. <a href="/residence">Add a new listing</a></p>
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price per Night</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($listings as $listing): ?>
                <tr>
                    <td><?= htmlspecialchars($listing->getTitle()) ?></td>
                    <td><?= htmlspecialchars($listing->getDescription()) ?></td>
                    <td><?= htmlspecialchars($listing->getPricePerNight()) ?></td>
                    <td>
                        <a href="/user/edit-residence/<?= $listing->getId() ?>">Edit</a>
                        <form action="/user/delete-residence/<?= $listing->getId() ?>" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<br>
<br>