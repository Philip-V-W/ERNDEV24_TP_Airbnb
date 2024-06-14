<footer class="footer">
    <div class="container">
        <div class="footer_top">
            <div class="column">
                <div class="footer_heading">ABOUT</div>
                <ul>
                    <li><a href="#">How Airbnb works</a></li>
                    <li><a href="#">Newsroom</a></li>
                    <li><a href="#">Airbnb 2021</a></li>
                    <li><a href="#">Investors</a></li>
                    <li><a href="#">Airbnb Plus</a></li>
                    <li><a href="#">Airbnb Luxe</a></li>
                    <li><a href="#">HotelTonight</a></li>
                    <li><a href="#">Airbnb for Work</a></li>
                    <li><a href="#">Made possible by Hosts</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Founders' Letter</a></li>
                </ul>
            </div>
            <div class="column">
                <div class="footer_heading">COMMUNITY</div>
                <ul>
                    <li><a href="#">Diversity & Belonging</a></li>
                    <li><a href="#">Against Discrimination</a></li>
                    <li><a href="#">Accessibility</a></li>
                    <li><a href="#">Airbnb Associates</a></li>
                    <li><a href="#">Host Afghan refugees</a></li>
                    <li><a href="#">Guest Referrals</a></li>
                    <li><a href="#">Gift cards</a></li>
                    <li><a href="#">Airbnb.org</a></li>
                </ul>
            </div>
            <div class="column">
                <div class="footer_heading">HOST</div>
                <ul>
                    <li><a href="#">Host your home</a></li>
                    <li><a href="#">Host an Online Experience</a></li>
                    <li><a href="#">Host an Experience</a></li>
                    <li><a href="#">Responsible hosting</a></li>
                    <li><a href="#">Resource Center</a></li>
                    <li><a href="#">Community Center</a></li>
                </ul>
            </div>
            <div class="column">
                <div class="footer_heading">SUPPORT</div>
                <ul>
                    <li><a href="#">Our COVID-19 Response</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Cancellation options</a></li>
                    <li><a href="#">Neighborhood Support</a></li>
                    <li><a href="#">Trust & Safety</a></li>
                </ul>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="left">
                <span>© 2021 Airbnb, Inc.</span>
                <ul>
                    <li>Privacy</li>
                    <li>Terms</li>
                    <li>Sitemap</li>
                </ul>
            </div>
            <div class="right">
                <div class="icons">
                    <div class="icon">
                        <i class="icon-country"></i>
                        <span>English (US)</span>
                    </div>
                    <div class="icon">
                        ₺
                        <span>TRY</span>
                    </div>
                </div>
                <div class="social">
                    <i class="icon-facebook"></i>
                    <i class="icon-twitter"></i>
                    <i class="icon-instagram"></i>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        // window.addEventListener("resize", () => {
        //     if (document.body.clientWidth > 728) {
        //         $(".sticky_menu").css("display", "block");
        //         $(".form").css("display", "none");
        //         $(".logo").css("display", "none");
        //         $(".menu2").css("display", "none");
        //         $(".profile").css("display", "none");
        //         $(".menu2").css("display", "none");
        //     } else {
        //         $(".sticky_menu").css("display", "none");
        //         // $(".form").css("display", "flex");
        //         // $(".logo").css("display", "flex");
        //         // $(".menu2").css("display", "flex");
        //         // $(".profile").css("display", "flex");
        //         // $(".menu2").css("display", "flex");
        //     }
        // });

        $(window).scroll(function () {
            if ($(document).scrollTop() > 1) {
                $(".sticky_menu").css("display", "block");
                $(".formm").css("display", "none");
                $(".logo").css("display", "none");
                $(".profile").css("display", "none");
                $(".menu2").css("opacity", "0");
            } else {
                $(".sticky_menu").css("display", "none");
                $(".formm").css("display", "flex");
                $(".logo").css("display", "flex");
                $(".profile").css("display", "flex");
                $(".menu2").css("opacity", "1");
            }
        });
        // const mediaQuery = window.matchMedia('(min-width: 744px)')
        // if (mediaQuery.matches) {
        //     // Then trigger an alert
        //     $(".sticky_menu").css("b", "flex");
        //     $(".form").css("display", "flex");
        // }

        // function responsive() {
        //     if (window.innerWidth < 744 && document.scrollTop() > 1) {
        //         $(".sticky_menu").css("background-color", "yellow");
        //         $(".sticky_menu").css("display", "flex");
        //     }
        //     else {
        //         $(".sticky_menu").css("display", "flex");
        //         $(".form").css("display", "flex");

        //     }
        // }
        // window.addEventListener("resize", responsive);
    });
</script>

<!-- import de la librairie popperjs -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"-->
<!--        integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ=="-->
<!--        crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<!-- import du script bootstrap -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"-->
<!--        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"-->
<!--        crossorigin="anonymous"></script>-->

</body>

</html>