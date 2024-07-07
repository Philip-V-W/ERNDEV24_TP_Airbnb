<?php
// Ensure the asset function is available
if (!function_exists('asset')) {
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
}
?>

<!--<head>-->
<!--    <base href="/">-->
<!--</head>-->
<body id="rooms">
<main class="container" id="third-page">

    <section class="container px-0 d-flex justify-content-between align-items-center py-2">
        <!-- Property name -->
        <div id="left-nav">
            <h1><?= htmlspecialchars($listing->title) ?></h1>
        </div>
        <!-- Save & Share buttons -->
        <div id="right-nav">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-upload" viewBox="0 0 16 16">
                        <path
                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                        <path
                                d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
                    </svg>
                    <span class="d-none d-lg-inline"><u>Share</u></span>
                </span>

            <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-heart" viewBox="0 0 16 16">
                        <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                    </svg>
                    <span class="d-none d-lg-inline"><u>Save</u></span>
                </span>

        </div>
    </section>
    <!-- Images container-->
    <section class="container d-none d-md-block">
        <?php
        $imagePaths = [];
        if (!empty($photos)) {
            $firstFivePhotos = array_slice($photos, 0, 5);
            foreach ($firstFivePhotos as $photo) {
                $imagePaths[] = asset($photo->image_path);
            }
        }
        ?>
        <div class="row" id="img-container">
            <div class="col-6 p-0 pe-2">
                <img src="<?= htmlspecialchars($imagePaths[0] ?? asset('assets/default-image.jpg')) ?>"
                     class="img-fluid" alt=""
                     data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6 p-0 pe-2">
                        <img src="<?= htmlspecialchars($imagePaths[1] ?? asset('assets/default-image.jpg')) ?>"
                             class="img-fluid" alt=""
                             data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                    </div>
                    <div class="col-6 p-0">
                        <img src="<?= htmlspecialchars($imagePaths[2] ?? asset('assets/default-image.jpg')) ?>"
                             class="img-fluid" alt=""
                             data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-6 p-0 pe-2">
                        <img src="<?= htmlspecialchars($imagePaths[3] ?? asset('assets/default-image.jpg')) ?>"
                             class="img-fluid" alt=""
                             data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                    </div>
                    <div class="col-6 p-0">
                        <img src="<?= htmlspecialchars($imagePaths[4] ?? asset('assets/default-image.jpg')) ?>"
                             class="img-fluid" alt=""
                             data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Images carousel container for small devices-->
    <section class="container-fluid px-0 d-flex overflow-x-scroll d-md-none">
        <img src="<?= htmlspecialchars($imagePaths[0] ?? asset('assets/default-image.jpg')) ?>" class="img-fluid mx-1"
             alt="">
        <img src="<?= htmlspecialchars($imagePaths[1] ?? asset('assets/default-image.jpg')) ?>" class="img-fluid mx-1"
             alt="">
        <img src="<?= htmlspecialchars($imagePaths[2] ?? asset('assets/default-image.jpg')) ?>" class="img-fluid mx-1"
             alt="">
        <img src="<?= htmlspecialchars($imagePaths[3] ?? asset('assets/default-image.jpg')) ?>" class="img-fluid mx-1"
             alt="">
        <img src="<?= htmlspecialchars($imagePaths[4] ?? asset('assets/default-image.jpg')) ?>" class="img-fluid mx-1"
             alt="">
    </section>

    <section class="container py-4">
        <div class="row">
            <div class="description col-12 col-lg-7 p-0">
                <!-- Property details and features -->
                <h2><?= htmlspecialchars($address->address . ', ' .
                        $address->city . ', ' .
                        $address->zip_code . ', ' .
                        $address->country) ?>
                </h2>
                <h3><?= htmlspecialchars($listing->nb_guests) . ' guests · ' .
                    $listing->nb_rooms . ' bedrooms · ' .
                    $listing->nb_beds . ' beds · ' .
                    $listing->nb_baths . ' bathrooms' ?>
                </h3>
                <div class="container mt-5">
                    <div class="guest-favourite d-flex align-items-center justify-content-around">
                        <div class="trophy">
                            <img src="/assets/icons/1.avif" alt="">
                            <span>Guest <br>favourite</span>
                            <img src="/assets/icons/2.avif" alt="">
                        </div>
                        <div class="d-none d-xl-flex flex-column">
                            <span>One of the most loved homes on</span>
                            <span>Airbnb, according to guests</span>
                        </div>
                        <div class="rating">
                            <span>4.97</span>
                            <span>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>
                        </div>
                        <div class="reviews">
                            <span>70</span>
                            <a href="#">Reviews</a>
                        </div>
                    </div>

                    <div class="container-fluid list-group mt-5">
                        <div class="row">
                            <span class="col-2"><img src="/assets/person4.jpg" alt=""></span>
                            <span class="col-10">
                                    <p>Hosted by <?= htmlspecialchars($user->lastname . ' ' . $user->firstname) ?></p>
                                    <p>Super Host · 9 years hosting</p>
                                </span>
                        </div>

                        <div class="features-description">
                            <p><?= htmlspecialchars($listing->description) ?></p>
                        </div>

                        <div class="features-list container-fluid p-0 pt-5">
                            <h3>What this place offers</h3>
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <ul>
                                        <?php foreach ($equipments as $equipment): ?>
                                            <li>
                                                <?php if (!empty($equipment['image_path'])): ?>
                                                    <img src="/<?= htmlspecialchars($equipment['image_path']) ?>"
                                                         alt="<?= htmlspecialchars($equipment['label']) ?>"
                                                         style="width:30px; height:30px;">
                                                <?php endif; ?>
                                                <span><?= htmlspecialchars($equipment['label']) ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Calendar -->

            </div>
            <!-- Reservation card-->
            <div class="col-12 col-lg-5 m-0 p-0 booking-modal">
                <div class="sticky container ms-xl-5 mt-2 d-flex justify-content-center">
                    <div class="reservation-card p-4">


                        <form id="reservation-form" method="POST">
                            <div class="price" id="price_per_night" data-price="<?= htmlspecialchars($listing->price_per_night) ?>">
                                <?= htmlspecialchars($listing->price_per_night) ?> €
                                <span class="text-muted" style="font-size: 16px;">night</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between reservation-details mb-3">
                                <div>
                                    <small>CHECK-IN</small>
                                    <input type="date" id="date_start" name="date_start" required onchange="calculateTotalPrice()">
                                </div>
                                <div>
                                    <small>CHECKOUT</small>
                                    <input type="date" id="date_end" name="date_end" required onchange="calculateTotalPrice()">
                                </div>
                            </div>
                            <div class="reservation-details mb-3">
                                <small>ADULTS</small>
                                <select class="form-control" id="nb_adults" name="nb_adults" required>
                                    <option value="">Select number of adults</option>
                                    <option value="1">1 guest</option>
                                    <option value="2">2 guests</option>
                                    <option value="3">3 guests</option>
                                    <option value="4">4 guests</option>
                                    <option value="5">5 guests</option>
                                    <option value="6">6 guests</option>
                                    <option value="7">7 guests</option>
                                    <option value="8">8 guests</option>
                                    <option value="9">9 guests</option>
                                    <option value="10">10 guests</option>
                                </select>
                            </div>
                            <div class="reservation-details mb-3">
                                <small>CHILDREN</small>
                                <select class="form-control" id="nb_children" name="nb_children" required>
                                    <option value="">Select number of children</option>
                                    <option value="1">1 guest</option>
                                    <option value="2">2 guests</option>
                                    <option value="3">3 guests</option>
                                    <option value="4">4 guests</option>
                                    <option value="5">5 guests</option>
                                    <option value="6">6 guests</option>
                                    <option value="7">7 guests</option>
                                    <option value="8">8 guests</option>
                                    <option value="9">9 guests</option>
                                    <option value="10">10 guests</option>
                                </select>
                            </div>

                            <input type="hidden" id="residence_id" name="residence_id" value="<?= htmlspecialchars($listing->id) ?>">
                            <input type="hidden" id="price_total" name="price_total" required>

                            <button class="reserve-btn mb-3" type="button" onclick="submitReservation()">Reserve</button>

                            <hr>
                            <div class="d-flex justify-content-between total-price">
                                <div>Total</div>
                                <div id="total_price_display">0 €</div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>