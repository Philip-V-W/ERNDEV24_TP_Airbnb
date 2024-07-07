<main class="container" id="third-page">
    <section class="container px-0 d-flex justify-content-between align-items-center py-2">
        <!-- Property name -->
        <div id="left-nav">
            <h1><?= htmlspecialchars($listing->getTitle()) ?></h1>
        </div>
        <!-- Save & Share buttons -->
        <div id="right-nav">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
                </svg>
                <span class="d-none d-lg-inline"><u>Share</u></span>
            </span>

            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                </svg>
                <span class="d-none d-lg-inline"><u>Save</u></span>
            </span>
        </div>
    </section>

    <!-- Images container-->
    <section class="container d-none d-md-block">
        <div class="row" id="img-container">
            <?php foreach ($listing->getPhotos() as $index => $photo): ?>
                <div class="col-<?= $index == 0 ? '6' : '3' ?> p-0 pe-2">
                    <img src="<?= htmlspecialchars(asset($photo->image_path)) ?>" class="img-fluid" alt="Listing Image" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Modal -->
        <div class="modal" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-white d-flex flex-wrap">
                        <div class="container-fluid">
                            <div class="row g-2">
                                <?php foreach ($listing->getPhotos() as $photo): ?>
                                    <div class="col-6">
                                        <img src="<?= htmlspecialchars(asset($photo->image_path)) ?>" class="img-fluid" alt="Photo Image">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Images carousel container for small devices-->
    <section class="container-fluid px-0 d-flex overflow-x-scroll d-md-none">
        <?php foreach ($listing->getPhotos() as $photo): ?>
            <img src="<?= htmlspecialchars(asset($photo->image_path)) ?>" class="img-fluid mx-1" alt="Listing Image">
        <?php endforeach; ?>
    </section>

    <section class="container py-4">
        <div class="row">
            <!-- Property details and features-->
            <div class="description col-12 col-lg-7 p-0">
                <h2><?= htmlspecialchars($listing->getLocation()) ?></h2>
                <h3><?= htmlspecialchars($listing->getDetails()) ?></h3>

                <!-- Votes-->
                <div class="container mt-5">
                    <div class="guest-favourite d-flex align-items-center justify-content-around">
                        <div class="trophy">
                            <img src="assets/icons/1.avif" alt="">
                            <span>Guest <br>favourite</span>
                            <img src="assets/icons/2.avif" alt="">
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
                            <span class="col-2"><img src="assets/person4.jpg" alt=""></span>
                            <span class="col-10">
                                <p>Hosted by Hotaka</p>
                                <p>Super Host · 9 years hosting</p>
                            </span>
                        </div>
                        <div class="row">
                            <span class="col-2"><img src="assets/icons/trophy.avif" alt=""></span>
                            <span class="col-10">
                                <p>Top 10% of Homes</p>
                                <p>This home is highly ranked based on ratings, reviews and reliability.</p>
                            </span>
                        </div>
                        <div class="row">
                            <span class="col-2"><i class="bi bi-person-workspace"></i></span>
                            <span class="col-10">
                                <p>Dedicated workspace</p>
                                <p>A common area with wifi that’s well suited for working.</p>
                            </span>
                        </div>
                        <div class="row">
                            <span class="col-2"><i class="bi bi-calendar-event"></i></span>
                            <span class="col-10">
                                <p>Free cancellation for 48 hours</p>
                                <p>Get a full refund if you change your mind.</p>
                            </span>
                        </div>
                    </div>

                    <div class="features-description">
                        <p>Some info has been automatically translated. <a href="#"><u><b>Show original</b></u></a></p>
                        <p>Peaceful and spacious traditional Japanese old house in Tokyo.
                            <br>Like a cinema. With TOTORO's mountain & big lake!
                            <br>You can use this house only for yourself
                            <br>5 rooms, kitchen and bathroom.
                            <br>
                            <br>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#features-modal">
                                <u><b>Show more</b></u> >
                            </button>
                        <div class="modal fade" id="features-modal" tabindex="-1" aria-labelledby="features-modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-white rounded p-4">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="features-modalLabel">Peaceful Traditional House in the Japanese Countryside</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="features-body">
                                        <p>Peaceful and spacious traditional Japanese old house in Tokyo.
                                            <br>Like a cinema. With TOTORO's mountain & big lake!
                                            <br>You can use this house only for yourself
                                            <br>5 rooms, kitchen and bathroom.

                                            <br>At only 5 minutes walk you will find:
                                        <ul>
                                            <li>Amusement park</li>
                                            <li>Water park</li>
                                            <li>Skating park</li>
                                            <li>Two train stations (Seibuen & Seibu Yuenchi)</li>
                                            <li>Super Market</li>
                                            <li>Cafes & Restaurants nearby</li>
                                            <li>20000 Cherry Blossoms</li>
                                        </ul>

                                        <br><b>Shinjuku Station at only 35 minute by train</b>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </p>
                    </div>

                    <div class="features-list container-fluid p-0 pt-5">
                        <h3>What this place offers</h3>
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <ul>
                                    <li>
                                        <span class="material-symbols-outlined">location_city</span>
                                        <span>City Skyline View</span>
                                    </li>
                                    <li>
                                        <span class="material-symbols-outlined">water</span>
                                        <span>Lake access</span>
                                    </li>
                                    <li>
                                        <span class="material-symbols-outlined">wifi</span>
                                        <span>Wi-Fi</span>
                                    </li>
                                    <li>
                                        <span class="material-symbols-outlined">directions_car</span>
                                        <span>Free parking on premises</span>
                                    </li>
                                    <li>
                                        <span class="material-symbols-outlined">ac_unit</span>
                                        <span>Air conditioning</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-none d-xl-block col-xl-6">
                                <ul>
                                    <li>
                                        <span class="material-symbols-outlined">kitchen</span>
                                        <span>Kitchen</span>
                                    </li>
                                    <li>
                                        <span class="material-symbols-outlined">dishwasher</span>
                                        <span>Dishwasher</span>
                                    </li>
                                    <li>
                                        <span class="material-symbols-outlined">microwave</span>
                                        <span>Microwave</span>
                                    </li>
                                    <li>
                                        <span class="material-symbols-outlined">image</span>
                                        <span>Lake view</span>
                                    </li>
                                    <li>
                                        <span class="material-symbols-outlined">bathtub</span>
                                        <span>Bath</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Calendar-->
                <div class="calendar container mt-5 px-0">
                    <h4><?= htmlspecialchars($listing->getNights()) ?> nights in <?= htmlspecialchars($listing->getLocation()) ?></h4>
                    <h5><?= htmlspecialchars($listing->getCheckinDate()) ?> - <?= htmlspecialchars($listing->getCheckoutDate()) ?></h5>
                    <div class="container mt-5 px-3 px-lg-0" id="calendar-container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-light">&lt;</button>
                                    <h5>October 2024</h5>
                                    <h5 class="d-none d-md-block">November 2024</h5>
                                    <button class="btn btn-light">&gt;</button>
                                </div>
                                <div class="d-flex">
                                    <table class="table text-center">
                                        <thead>
                                        <tr>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                            <th>Sun</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td></td>
                                            <td class="bg-dark text-white">1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                            <td>11</td>
                                            <td>12</td>
                                            <td>13</td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td>15</td>
                                            <td>16</td>
                                            <td>17</td>
                                            <td>18</td>
                                            <td>19</td>
                                            <td class="bg-dark text-white">20</td>
                                        </tr>
                                        <tr>
                                            <td>21</td>
                                            <td>22</td>
                                            <td>23</td>
                                            <td>24</td>
                                            <td>25</td>
                                            <td>26</td>
                                            <td>27</td>
                                        </tr>
                                        <tr>
                                            <td>28</td>
                                            <td>29</td>
                                            <td>30</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table d-none d-md-block text-center">
                                        <thead>
                                        <tr>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                            <th>Sun</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>12</td>
                                            <td>13</td>
                                            <td>14</td>
                                            <td>15</td>
                                            <td>16</td>
                                            <td>17</td>
                                        </tr>
                                        <tr>
                                            <td>18</td>
                                            <td>19</td>
                                            <td>20</td>
                                            <td>21</td>
                                            <td>22</td>
                                            <td>23</td>
                                            <td>24</td>
                                        </tr>
                                        <tr>
                                            <td>25</td>
                                            <td>26</td>
                                            <td>27</td>
                                            <td>28</td>
                                            <td>29</td>
                                            <td>30</td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-light mt-2">Clear dates</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservation card-->
            <div class="col-12 col-lg-5 m-0 p-0 booking-modal">
                <div class="sticky container ms-xl-5 mt-2 d-flex justify-content-center">
                    <div class="reservation-card p-4">
                        <div class="price">£<?= htmlspecialchars($listing->getPricePerNight()) ?> <span class="text-muted" style="font-size: 16px;">night</span></div>
                        <hr>
                        <div class="d-flex justify-content-between reservation-details mb-3">
                            <div>
                                <small>CHECK-IN</small>
                                <div><?= htmlspecialchars($listing->getCheckinDate()) ?></div>
                            </div>
                            <div>
                                <small>CHECKOUT</small>
                                <div><?= htmlspecialchars($listing->getCheckoutDate()) ?></div>
                            </div>
                        </div>
                        <div class="reservation-details mb-3">
                            <small>GUESTS</small>
                            <select class="form-control">
                                <?php for ($i = 1; $i <= $listing->getMaxGuests(); $i++): ?>
                                    <option><?= $i ?> guest<?= $i > 1 ? 's' : '' ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <button class="reserve-btn mb-3">Reserve</button>
                        <div class="text-center reservation-details">You won't be charged yet</div>
                        <hr>
                        <div class="d-flex justify-content-between reservation-details">
                            <div><u>£<?= htmlspecialchars($listing->getPricePerNight()) ?> x <?= htmlspecialchars($listing->getNights()) ?> nights</u></div>
                            <div>£<?= htmlspecialchars($listing->getTotalPrice()) ?></div>
                        </div>
                        <div class="d-flex justify-content-between reservation-details">
                            <div><u>Service fee</u></div>
                            <div>£<?= htmlspecialchars($listing->getServiceFee()) ?></div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between total-price">
                            <div>Total</div>
                            <div>£<?= htmlspecialchars($listing->getTotalPrice() + $listing->getServiceFee()) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
