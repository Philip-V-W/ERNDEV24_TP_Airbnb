<?php
function asset($path): string
{
    $trimmedPath = ltrim($path, '/');
    $fullPath = "/" . $trimmedPath;
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
                            <td><?= htmlspecialchars($listing->getTitle() ?? '') ?></td>
                            <td><span class="line-clamp"><?= htmlspecialchars($listing->getDescription() ?? '') ?></span></td>
                            <td><?= htmlspecialchars($listing->getPricePerNight() ?? '') ?> €</td>
                            <td>
                                <a href="/user/edit-residence/<?= $listing->getId() ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="/user/delete-residence/<?= $listing->getId() ?>" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <br>

        <div style="width: 100%; height: 2px; margin-bottom: 60px; background: rgb(131, 58, 180); background: linear-gradient(90deg, rgba(131, 58, 180, 0.6671043417366946) 0%, rgba(253, 29, 29, 0.7287289915966386) 50%, rgba(252, 176, 69, 0.6502976190476191) 100%);"></div>

        <div class="container">
            <h1>Your Listings</h1>

            <?php if (empty($listings)): ?>
                <p>You have no listings. <a href="/residence">Add a new listing</a></p>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($listings as $listing): ?>
                        <?php if ($listing->user_id == $user->id && (!property_exists($listing, 'deleted') || !$listing->deleted)): ?>
                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3"><br>
                                <div class="card">
                                    <a href="/rooms/<?= htmlspecialchars($listing->id) ?>" class="text-decoration-none text-reset">
                                        <?php
                                        $hasPhotos = !empty($photos[$listing->getId()]);
                                        $mainImagePath = !empty($listing->photo_url) ? asset($listing->photo_url) : null;
                                        ?>
                                        <?php if ($hasPhotos || $mainImagePath): ?>
                                            <div id="carousel<?= htmlspecialchars($listing->id) ?>" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php if ($mainImagePath): ?>
                                                        <div class="carousel-item active">
                                                            <img src="<?= htmlspecialchars($mainImagePath) ?>" class="d-block w-100" alt="Listing Image">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($hasPhotos): ?>
                                                        <?php foreach ($photos[$listing->getId()] as $index => $photo): ?>
                                                            <?php $image_path = asset($photo->image_path ?? ''); ?>
                                                            <div class="carousel-item<?= $mainImagePath ? '' : ($index === 0 ? ' active' : '') ?>">
                                                                <img src="<?= htmlspecialchars($image_path) ?>" class="d-block w-100" alt="Photo Image">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if ($hasPhotos && count($photos[$listing->getId()]) > 1): ?>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?= htmlspecialchars($listing->id) ?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                                </span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel<?= htmlspecialchars($listing->id) ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true">
                                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                                </span>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($listing->title ?? '') ?></h5>
                                            <p class="card-text">Hosted by <?= htmlspecialchars($user->lastname . ' ' . $user->firstname) ?></p>
                                            <p class="card-text">
                                                <strong><?= htmlspecialchars($listing->price_per_night ?? '') ?> € per night</strong>
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <?php if (property_exists($listing, 'disactive') && $listing->disactive == 0): ?>
                                                        <a href="/disable/<?= htmlspecialchars($listing->id) ?>" class="btn btn-sm btn-outline-warning">Disable</a>
                                                    <?php elseif (property_exists($listing, 'disactive') && $listing->disactive == 1): ?>
                                                        <a href="/enable/<?= htmlspecialchars($listing->id) ?>" class="btn btn-sm btn-outline-success">Enable</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div><br>


        <div style="width: 100%; height: 2px; margin-bottom: 60px; background: rgb(131, 58, 180); background: linear-gradient(90deg, rgba(131, 58, 180, 0.6671043417366946) 0%, rgba(253, 29, 29, 0.7287289915966386) 50%, rgba(252, 176, 69, 0.6502976190476191) 100%);"></div>

        <!-- New Reservations Section -->
        <div class="container">
            <h1>Reservations for Your Listings</h1>

            <?php if (empty($reservations)): ?>
                <p>No reservations have been made for your listings.</p>
            <?php else: ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Guest Email</th>
                        <th>Residence</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Number of Guests</th>
                        <th>Total Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?= htmlspecialchars($reservation['guest_firstname'] . ' ' . $reservation['guest_lastname'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['guest_email'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['residence_title'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['date_start'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['date_end'] ?? '') ?></td>
                            <td><?= htmlspecialchars(($reservation['nb_adults'] + $reservation['nb_children']) ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['price_total'] ?? '') ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div><br>

        <div style="width: 100%; height: 2px; margin-bottom: 60px; background: rgb(131, 58, 180); background: linear-gradient(90deg, rgba(131, 58, 180, 0.6671043417366946) 0%, rgba(253, 29, 29, 0.7287289915966386) 50%, rgba(252, 176, 69, 0.6502976190476191) 100%);"></div>

        <!-- New Section: Reservations Made by User on Other Listings -->
        <div class="container">
            <h1>Your Reservations on Other Listings</h1>

            <?php if (empty($user_reservations)): ?>
                <p>You have not made any reservations on other listings.</p>
            <?php else: ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Residence</th>
                        <th>Host Name</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Number of Guests</th>
                        <th>Total Price</th>
                        <th>Actions</th> <!-- Add actions column -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($user_reservations as $reservation): ?>
                        <tr>
                            <td><?= htmlspecialchars($reservation['residence_title'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['host_firstname'] . ' ' . $reservation['host_lastname'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['date_start'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['date_end'] ?? '') ?></td>
                            <td><?= htmlspecialchars(($reservation['nb_adults'] + $reservation['nb_children']) ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['price_total'] ?? '') ?> €</td>
                            <td>
                                <form action="/cancel-reservation/<?= htmlspecialchars($reservation['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            <?php endif; ?>
        </div><br>
    </div>
</main>
