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
            <div class="login-back">
                <div class="login-filter">
                    <div class="container">
                        <div class="row login-content">
                            <div class="col-12 col-lg-6">
                                <div class="">
                                    <div class="login-img" data-aos="fade-right" data-aos-duration="1000"></div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <!-- Default form register -->
                                <form class="text-center border login-form p-5" action="#!">

                                    <p class="h2 mb-4">Démarrer</p>

                                    <!-- Sign up Email button -->
                                    <button class="btn btn-custum" type="submit">
                                        <img src="{{ asset('assets/images/google.png') }}" alt="" class="google-logo"> Continuer avec google
                                    </button>

                                    <div class="orBlock">
                                        <span class="forOr">OU</span>
                                    </div>

                                    <!-- E-mail -->
                                    <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">

                                    <!-- Password -->
                                    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Mot de passe" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                                    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text log-advice mb-4">
                                        Entrer au minimum 8 charactères
                                    </small>

                                    <!-- Newsletter -->
                                    <div class="custom-control custom-checkbox custum-box">
                                        <input type="checkbox" class="custom-control-input" id="defaultRegisterFormNewsletter">
                                        <label class="custom-control-label" for="defaultRegisterFormNewsletter">Afficher le mot de passe</label>
                                    </div>

                                    <!-- Sign up button -->
                                    <button class="btn btn-validate my-4 btn-block" type="submit">Se connecter</button>

                                    <!-- Terms of service -->
                                    <p>Si vous n'avez pas de compte,
                                        <a href="" target="_blank">créer un compte</a>
                                    </p>
                                    <p>
                                        <a href="" target="_blank">mot de passe oublié ? </a>
                                    </p>
                                </form>
                                <!-- Default form register -->
                            </div>

                            <!-- CREATE NEW ACCOUNT LOGIN -->

                            <div id="createAccount" class="col-12 col-lg-6">
                                <!-- Default form register -->
                                <form class="text-center border login-form p-5" action="#!">

                                    <p class="h2 mb-4">Démarrer</p>

                                    <!-- Sign up Email button -->
                                    <button class="btn btn-custum" type="submit">
                                        <img src="{{ asset('assets/images/google.png') }}" alt="" class="google-logo"> Continuer avec google
                                    </button>

                                    <div class="orBlock">
                                        <span class="forOr">OU</span>
                                    </div>

                                    <div class="form-row mb-4">
                                        <div class="col">
                                            <!-- First name -->
                                            <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="Nom">
                                        </div>
                                        <div class="col">
                                            <!-- Last name -->
                                            <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Prénom">
                                        </div>
                                    </div>
                                    
                                    <!-- E-mail -->
                                    <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">

                                    <!-- Password -->
                                    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Mot de passe" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                                    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text log-advice mb-4">
                                        Entrer au minimum 8 charactères
                                    </small>

                                    <!-- Newsletter -->
                                    <div class="custom-control custom-checkbox custum-box">
                                        <input type="checkbox" class="custom-control-input" id="defaultRegisterFormNewsletter">
                                        <label class="custom-control-label" for="defaultRegisterFormNewsletter">Afficher le mot de passe</label>
                                    </div>

                                    <!-- Sign up button -->
                                    <button class="btn btn-validate my-4 btn-block" type="submit">Se connecter</button>

                                    <!-- Terms of service -->
                                    <p>Si vous avez un compte,
                                        <a href="" target="_blank">connectez-vous</a>
                                    </p>
                                </form>
                                <!-- Default form register -->
                            </div>

                            <!-- FORGOTTEN PASSWORD -->
                            <div id="passReset" class="col-12 col-lg-6">
                                <!-- Default form register -->
                                <form class="text-center border login-form p-5" action="#!">

                                    <p class="h2 mb-2">GoProjects</p>

                                    <p class="h6 mb-4">Ici sera renseigner un petit text</p>

                                    <!-- E-mail -->
                                    <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">

                                    <!-- Sign up button -->
                                    <button class="btn btn-validate my-4 btn-block" type="submit">Se connecter</button>

                                </form>
                                <!-- Default form register -->
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
            easing: 'linear', // default easing for AOS animations
            once: false, // whether animation should happen only once - while scrolling down
            mirror: false, // whether elements should animate out while scrolling past them
            anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

            });
        </script>
    </body>
</html>
