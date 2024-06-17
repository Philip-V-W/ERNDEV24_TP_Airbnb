<!-- Show map button for medium devices footer section -->
<button class="mapbtn btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    <span>Show map</span>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-map-fill"
         viewBox="0 0 16 16">
        <path fill-rule="evenodd"
              d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.5.5 0 0 0-.196 0zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1z"/>
    </svg>
</button>
<!-- Map Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog .modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d831455.1969860896!2d139.11043959425993!3d35.50744653348493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x605d1b87f02e57e7%3A0x2e01618b22571b89!2sTokyo%2C%20Giappone!5e0!3m2!1sit!2sit!4v1716033083362!5m2!1sit!2sit"
                        width="600" height="450" style="border:0;width: -webkit-fill-available;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </div>
</div>

<main class="container-fluid" id="second-main">
    <!-- Cards container -->
    <section class="results container-fluid mx-0 px-0 px-lg-3">
        <p class="results-title">Over 1,000 places</p>
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel1" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel1indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel1indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel1indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result1/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result1/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result1/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel1"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel1"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Flat in Shinjuku</h5>
                        <p class="card-text">Stay with Mimiko</p>
                        <p class="card-text">£92 per night · <span><u>£920 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel2" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel2indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel2indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel2indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result2/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result2/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result2/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel2"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel2"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Villa in Koto</h5>
                        <p class="card-text">Entire villa - Machiya Style</p>
                        <p class="card-text">£144 per night · <span><u>£1440 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel3" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel3indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel3indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel3indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result3/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result3/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result3/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel3"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel3"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hut in Atami</h5>
                        <p class="card-text">Kominka Onsen</p>
                        <p class="card-text">£96 per night · <span><u>£960 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel4" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel4indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel4indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel4indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result4/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result4/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result4/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel4"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel4"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Room in Kiryu</h5>
                        <p class="card-text">Stay in a cultural home</p>
                        <p class="card-text">£57 per night · <span><u>£570 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel5" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel5indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel5indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel5indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result5/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result5/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result5/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel5"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel5"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Room in Adachi</h5>
                        <p class="card-text">Tokyo Senju</p>
                        <p class="card-text">£32 per night · <span><u>£320 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel6" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel6indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel6indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel6indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result6/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result6/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result6/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel6"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel6"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Room in Kiryu</h5>
                        <p class="card-text">Stay in a cultural home</p>
                        <p class="card-text">£57 per night · <span><u>£570 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel1" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel1indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel1indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel1indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result1/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result1/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result1/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel1"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel1"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Flat in Shinjuku</h5>
                        <p class="card-text">Stay with Mimiko</p>
                        <p class="card-text">£92 per night · <span><u>£920 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel2" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel2indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel2indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel2indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result2/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result2/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result2/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel2"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel2"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Villa in Koto</h5>
                        <p class="card-text">Entire villa - Machiya Style</p>
                        <p class="card-text">£144 per night · <span><u>£1440 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel3" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel3indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel3indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel3indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result3/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result3/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result3/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel3"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel3"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hut in Atami</h5>
                        <p class="card-text">Kominka Onsen</p>
                        <p class="card-text">£96 per night · <span><u>£960 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel4" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel4indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel4indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel4indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result4/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result4/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result4/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel4"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel4"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Room in Kiryu</h5>
                        <p class="card-text">Stay in a cultural home</p>
                        <p class="card-text">£57 per night · <span><u>£570 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel5" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel5indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel5indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel5indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result5/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result5/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result5/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel5"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel5"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Room in Adachi</h5>
                        <p class="card-text">Tokyo Senju</p>
                        <p class="card-text">£32 per night · <span><u>£320 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel6" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel6indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel6indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel6indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result6/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result6/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result6/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel6"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel6"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Room in Kiryu</h5>
                        <p class="card-text">Stay in a cultural home</p>
                        <p class="card-text">£57 per night · <span><u>£570 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel1" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel1indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel1indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel1indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result1/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result1/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result1/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel1"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel1"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Flat in Shinjuku</h5>
                        <p class="card-text">Stay with Mimiko</p>
                        <p class="card-text">£92 per night · <span><u>£920 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel2" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel2indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel2indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel2indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result2/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result2/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result2/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel2"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel2"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Villa in Koto</h5>
                        <p class="card-text">Entire villa - Machiya Style</p>
                        <p class="card-text">£144 per night · <span><u>£1440 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel3" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel3indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel3indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel3indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result3/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result3/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result3/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel3"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel3"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hut in Atami</h5>
                        <p class="card-text">Kominka Onsen</p>
                        <p class="card-text">£96 per night · <span><u>£960 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel4" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel4indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel4indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel4indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result4/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result4/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result4/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel4"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel4"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Room in Kiryu</h5>
                        <p class="card-text">Stay in a cultural home</p>
                        <p class="card-text">£57 per night · <span><u>£570 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel5" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel5indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel5indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel5indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result5/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result5/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result5/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel5"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel5"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Room in Adachi</h5>
                        <p class="card-text">Tokyo Senju</p>
                        <p class="card-text">£32 per night · <span><u>£320 in total</u></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div id="carousel6" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel6indicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel6indicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel6indicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Cards/PAGE2/result6/1.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result6/2.webp" class="img-fluid">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Cards/PAGE2/result6/3.webp" class="img-fluid">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel6"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-back-50.png" alt="">
                                </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel6"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true">
                                    <img src="assets/icons/icons8-forward-50.png" alt="">
                                </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Room in Kiryu</h5>
                        <p class="card-text">Stay in a cultural home</p>
                        <p class="card-text">£57 per night · <span><u>£570 in total</u></span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Map container -->
    <section class="map">
        <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d831455.1969860896!2d139.11043959425993!3d35.50744653348493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x605d1b87f02e57e7%3A0x2e01618b22571b89!2sTokyo%2C%20Giappone!5e0!3m2!1sit!2sit!4v1716033083362!5m2!1sit!2sit"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
</main>