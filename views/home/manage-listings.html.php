<?php
function asset($path): string
{
    // Ensure there's no leading slash
    $trimmedPath = ltrim($path, '/');
    // Construct the full path
    $fullPath = "/" . $trimmedPath;
    // Log for debugging purposes
    error_log("Generated asset path: " . $fullPath);
    return $fullPath;
}

?>


<main>
    <div style="width: 100%; height: 15px; background: rgb(131, 58, 180); background: linear-gradient(90deg, rgba(131, 58, 180, 0.6671043417366946) 0%, rgba(253, 29, 29, 0.7287289915966386) 50%, rgba(252, 176, 69, 0.6502976190476191) 100%);"></div>
    <div class="container">
        <div class="row justify-content-center" style="padding: 30px 0;">
            <div class="col-md-12">
                <div>
                    <h1 style="padding-bottom: 15px;">Account</h1>
                    <?php if (!empty($user)): ?>
                        <p><strong>First Name:</strong> <?= htmlspecialchars($user->firstname ?? '') ?></p>
                        <p><strong>Last Name:</strong> <?= htmlspecialchars($user->lastname ?? '') ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($user->phone ?? '') ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($user->email ?? '') ?></p>
                    <?php else: ?>
                        <p>No user data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div style="width: 100%; height: 2px; margin-bottom: 60px; background: rgb(131, 58, 180); background: linear-gradient(90deg, rgba(131, 58, 180, 0.6671043417366946) 0%, rgba(253, 29, 29, 0.7287289915966386) 50%, rgba(252, 176, 69, 0.6502976190476191) 100%);"></div>

        <div class="container">
            <h1>Manage Your Listings</h1>

            <?php if (empty($listings)): ?>
                <p>You have no listings. <a href="/residence">Add a new listing</a></p>
            <?php else: ?>
                <table class="table table-striped">
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
                            <td><?= htmlspecialchars($listing->getPricePerNight() ?? '') ?> €</td>
                            <td>
                                <a href="/user/edit-residence/<?= $listing->getId() ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="/user/delete-residence/<?= $listing->getId() ?>" method="post"
                                      style="display:inline;"
                                      onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div style="width: 100%; height: 2px; margin-bottom: 60px; background: rgb(131, 58, 180); background: linear-gradient(90deg, rgba(131, 58, 180, 0.6671043417366946) 0%, rgba(253, 29, 29, 0.7287289915966386) 50%, rgba(252, 176, 69, 0.6502976190476191) 100%);"></div>

        <div class="row">
            <?php
            $isHost = false;
            if (!empty($listings)) {
                foreach ($listings as $listing) {
                    if (!empty($listing->user_id) && $listing->user_id == $user->id) {
                        $isHost = true;
                        break;
                    }
                }
            }
            ?>

            <?php if ($isHost): ?>
                <h1>Your Listings:</h1>
            <?php endif; ?>


            <?php if (empty($listings)): ?>
                <p>You have no listings. <a href="/residence">Add a new listing</a></p>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($listings as $listing): ?>
                        <?php if ($listing->user_id == $user->id && (!property_exists($listing, 'deleted') || !$listing->deleted)): ?>
                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
                                <div class="card">
                                    <div id="carousel<?= htmlspecialchars($listing->id) ?>" class="carousel slide"
                                         data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php if (!empty($listing->photo_url)): ?>
                                                <div class="carousel-item active">
                                                    <?php
                                                    $imagePath = asset($listing->photo_url);
                                                    error_log("Main Image URL for listing {$listing->id}: " . $imagePath);
                                                    ?>
                                                    <img src="<?= htmlspecialchars($imagePath) ?>" class="d-block w-100"
                                                         alt="Listing Image">
                                                </div>
                                            <?php endif; ?>
                                            <?php
                                            $i = 0;
                                            if (!empty($photos[$listing->getId()])) {
                                                foreach ($photos[$listing->getId()] as $photo) {
                                                    $image_path = asset($photo->image_path ?? '');
                                                    error_log("Photo Image URL for listing {$listing->id}: " . $image_path);
                                                    ?>
                                                    <div class="carousel-item<?= ($i == 0 && empty($listing->photo_url)) ? ' active' : '' ?>">
                                                        <img src="<?= htmlspecialchars($image_path) ?>"
                                                             class="d-block w-100" alt="Photo Image">
                                                    </div>
                                                    <?php
                                                    $i = 1;
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php if ($i == 1 || !empty($listing->photo_url)): ?>
                                            <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carousel<?= htmlspecialchars($listing->id) ?>"
                                                    data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                                </span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carousel<?= htmlspecialchars($listing->id) ?>"
                                                    data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true">
                                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                                </span>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($listing->title) ?></h5><br>
                                        <p class="card-text"><?= htmlspecialchars($listing->description) ?></p><br>
                                        <p class="card-text">
                                            <strong><?= htmlspecialchars($listing->price_per_night ?? '') ?> € per guest</strong>
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <?php if (property_exists($listing, 'disactive') && $listing->disactive == 0): ?>
                                                    <a href="/disable/<?= htmlspecialchars($listing->id) ?>"
                                                       class="btn btn-sm btn-outline-warning">Disable</a>
                                                <?php elseif (property_exists($listing, 'disactive') && $listing->disactive == 1): ?>
                                                    <a href="/enable/<?= htmlspecialchars($listing->id) ?>"
                                                       class="btn btn-sm btn-outline-success">Enable</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
