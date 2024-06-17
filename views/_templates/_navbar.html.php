<!-- Header -->
<div class="d-flex container py-3 ">
    <div class="logo d-none d-lg-block">
        <a href="index.html"><img src="assets/logo-pink.png" alt="logo"></a>
    </div>
    <!-- search bar top -->
    <div class="container-fluid d-flex align-items-baseline ">
        <div class="container-fluid " id="spostaDiv">
            <div>
                <button>
                    <p>
                        Stays
                    </p>
                </button>
            </div>
            <div>
                <button>
                    <p>
                        Experiences
                    </p>
                </button>
            </div>
            <div>
                <button>
                    <p>
                        Online Experiences
                    </p>
                </button>
            </div>
        </div>

        <div class="user d-none d-lg-flex align-items-center">
            <div style="width: 130px;">
                <p>Airbnb your home</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-globe" viewBox="0 0 16 16">
                    <path
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855q.26-.487.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.7 13.7 0 0 1-.312 2.5m2.802-3.5a7 7 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7 7 0 0 0-3.072-2.472c.218.284.418.598.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z"/>
                </svg>
            </div>
        </div>

        <div class="btn-group">
            <button type="button" class="btn" data-bs-toggle="dropdown" data-bs-offset="1,10">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                     class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd"
                          d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>

            </button>
            <ul class="dropdown-menu dropdown-menu-end z-i">
                <!-- si je suis en session j'affiche mon compte -->
                <?php

                use Core\Session\Session;
                use App\Controller\ReservationController;

                if ($auth::isAuth()) $user_id = Session::get(Session::USER)->id;

                if ($auth::isAuth()) : ?>
                    <li>
                        <a class="dropdown-item" role="button" href="/register-form"><b>Sign up</b></a>
                    </li>
                <?php else : ?>
                    <li>
                        <a class="dropdown-item" role="button" href="/login-form">Log in</a>
                    </li>
                <?php endif ?>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <button class="dropdown-item modal-dialog modal-fullscreen-sm-down" type="button">Gift Cards</button>
                </li>
                <li>
                    <button class="dropdown-item" type="button">Airbnb your home</button>
                </li>
                <li>
                    <button class="dropdown-item" type="button">Help center</button>
                </li>
                <hr class="dropdown-divider">
                <div class="container-fluid rsp">
                    <form class="d-flex f-w" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">
                            <svg
                                xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#FF385C"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </ul>
        </div>
    </div>
</div>
<!-- search bar -->
<div class="d-flex justify-content-center" style="margin-bottom: 1%;">
    <div class="bar-container">
        <div>
            <button>
                <div>
                    <p>Where</p>
                </div>
                <div>
                    <input type="text" placeholder="Search destinations" style="padding: 0 !important;">
                </div>
            </button>
        </div>
        <div>
            <button>
                <div>
                    <p>Check-in</p>
                </div>
                <div>
                    <p>Add dates</p>
                </div>
            </button>
        </div>
        <div>
            <button>
                <div>
                    <p>Check-out</p>
                </div>
                <div>
                    <p>Add dates</p>
                </div>
            </button>
        </div>
        <div class="d-flex ">
            <button>
                <div>
                    <div>
                        <p>Who</p>
                    </div>
                    <div>
                        <p>Add guests</p>
                    </div>
            </button>
            <div style="background-color: #FF385C; width: 43px;">
                <button style="padding-top: 20%;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="white"
                         class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Icons Carousel-->
<nav class="container-fluid px-5 sticky-top ">
    <div id="iconsCarousel" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active ">
                <div class="container">
                    <div class="row">
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        local_activity
                                    </span>
                            <p>Icon</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        landscape
                                    </span>
                            <p>Countryside</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        pool
                                    </span>
                            <p>Pool</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        rocket
                                    </span>
                            <p>Wow</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        piano
                                    </span>
                            <p>Piano</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        nature
                                    </span>
                            <p>Park</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        castle
                                    </span>
                            <p>Castle</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        sailing
                                    </span>
                            <p>Boats</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        coffee
                                    </span>
                            <p>B&B</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        kayaking
                                    </span>
                            <p>Lake</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        sports_golf
                                    </span>
                            <p>Golf</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        downhill_skiing
                                    </span>
                            <p>Skiing</p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        key
                                    </span>
                            <p>New</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        ac_unit
                                    </span>
                            <p>North Pole</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        local_fire_department
                                    </span>
                            <p>Trending</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        cabin
                                    </span>
                            <p>Cabins</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        surfing
                                    </span>
                            <p>Surf</p>
                        </div>
                        <div class="icon col-1 d-none d-lg-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        beach_access
                                    </span>
                            <p>Beach</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        self_improvement
                                    </span>
                            <p>Relax</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        location_city
                                    </span>
                            <p>City</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        local_dining
                                    </span>
                            <p>Kitchen</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        landscape_2
                                    </span>
                            <p>Mountain</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        attractions
                                    </span>
                            <p>Attractions</p>
                        </div>
                        <div class="icon col-2 col-lg-1 d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined">
                                        festival
                                    </span>
                            <p>Festival</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#iconsCarousel" data-bs-slide="prev">
        <img src="assets/icons/left.png" alt="">
    </button>
    <!-- Pulsante successivo -->
    <button class="carousel-control-next" type="button" data-bs-target="#iconsCarousel" data-bs-slide="next">
        <img src="assets/icons/right.png" alt="">
    </button>
</nav>