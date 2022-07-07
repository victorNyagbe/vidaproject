<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GoProjects</title>

        <!-- Fonts -->

        <!-- Vendor css files -->

        <link href="{{ asset('styles/guests/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('styles/guests/aos/aos.css') }}" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('styles/mdb/css/bootstrap.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('styles/guests/css/welcome.css') }}">
       
    </head>
    <body>
        <div class="container-fluid">
            <div class="back-img">
                <div class="filter">
                    <div class="container">
                        <div class="row welcome-content">
                            <div class="col-12 col-lg-6">
                                <div class="welcome-block">
                                    <div class="welcome-text" data-aos="zoom-in">
                                        <h2 class="welcome-title">
                                            Bienvenue sur la plateforme de <span class="welcome-name">GoProjects</span>
                                        </h2>
                                        <h6 class="welcome-title2">
                                            Garder le contrôle sur tous vos projets
                                        </h6>
                                        <a href="{{ route('guests.login') }}" class="welcome-btn">Commencer <i class="bi bi-play-circle-fill"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="welcome-block2">
                                    <div class="welcome-img" data-aos="fade-left"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main JS File -->
        <script src="{{ asset('styles/guests/aos/aos.js') }}"></script>
        <script>
            AOS.init();

            AOS.init({
            // Global settings:
            disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
            startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
            initClassName: 'aos-init', // class applied after initialization
            animatedClassName: 'aos-animate', // class applied on animation
            useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
            disableMutationObserver: false, // disables automatic mutations' detections (advanced)
            debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
            throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
            

            // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
            offset: 120, // offset (in px) from the original trigger point
            delay: 0, // values from 0 to 3000, with step 50ms
            duration: 3000, // values from 0 to 3000, with step 50ms
            easing: 'ease', // default easing for AOS animations
            once: false, // whether animation should happen only once - while scrolling down
            mirror: false, // whether elements should animate out while scrolling past them
            anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

            });
        </script>
    </body>
</html>
