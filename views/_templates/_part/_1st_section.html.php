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
    <div class="container">

        <div class="container">
            <div class="row">
                <?php foreach ($listings as $listing): ?>
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3"><br>
                        <a href="/rooms/<?= htmlspecialchars($listing['id']) ?>" class="text-decoration-none text-reset">
                            <div class="card">
                                <div id="carousel<?= htmlspecialchars($listing['id']) ?>" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php if (!empty($listing['images'])): ?>
                                            <?php foreach ($listing['images'] as $index => $image): ?>
                                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                    <img src="<?= htmlspecialchars(asset($image)) ?>" class="d-block w-100" alt="Listing Image">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="carousel-item active">
                                                <img src="/assets/default-image.jpg" class="d-block w-100" alt="No Image Available">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($listing['images']) && count($listing['images']) > 1): ?>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?= htmlspecialchars($listing['id']) ?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"><img src="assets/icons/icons8-back-50.png" alt=""></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?= htmlspecialchars($listing['id']) ?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"><img src="assets/icons/icons8-forward-50.png" alt=""></span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($listing['title']) ?></h5>
                                    <p class="card-text">Hosted by <?= htmlspecialchars($listing['user_firstname'] . ' ' . $listing['user_lastname']) ?></p>
                                    <p class="card-text">
                                        <strong><?= htmlspecialchars($listing['price_per_night']) ?> € per guest</strong>
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <!-- Add your action buttons or links here -->
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

