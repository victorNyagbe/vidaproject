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
                        <div class="row">
                            <div class="col-12 login-logo">
                                <img src="{{ asset('assets/logos/goproject-03.png') }}" alt="Logo">
                            </div>
                        </div>
                        <div class="row login-content">
                            <div class="col-12 col-lg-6">
                                <div class="">
                                    <div class="login-img" data-aos="fade-right" data-aos-duration="1000"></div>
                                </div>
                            </div>

                            @csrf

                            <div class="col-12 col-lg-6" id="loginAccount">
                                <!-- Default form register -->
                                <form class="text-center border login-form p-5" action="#!" id="login-form">

                                    <p class="h2 mb-4">Démarrer</p>

                                    <!-- Sign up Email button -->
                                    <a href="{{ route('guests.google.redirection') }}" class="btn btn-custum" type="submit">
                                        <img src="{{ asset('assets/images/google.png') }}" alt="" class="google-logo"> Continuer avec google
                                    </a>

                                    <div class="orBlock">
                                        <span class="forOr">OU</span>
                                    </div>

                                    <!-- E-mail -->
                                    <div class="form-group mb-3">
                                        <input type="email" name="loginEmail" id="defaultLoginFormEmail" class="form-control" placeholder="E-mail">
                                        <small class="error-log" id="errorLoginEmail"></small>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group mb-3">
                                        <input type="password" name="loginPassword" id="defaultLoginFormPassword" class="form-control" placeholder="Mot de passe">
                                        <small id="errorLoginPassword" class="error-log"></small>
                                    </div>

                                    <!-- Newsletter -->
                                    <div class="custom-control custom-checkbox custum-box">
                                        <input type="checkbox" class="custom-control-input" id="showHideLoginPassword">
                                        <label class="custom-control-label" for="showHideLoginPassword">Afficher le mot de passe</label>
                                    </div>

                                    <!-- Sign up button -->
                                    <button class="btn btn-validate my-4 btn-block" id="connection_button" type="submit">Se connecter</button>

                                    <!-- Terms of service -->
                                    <p>Je n'ai pas de compte,
                                        <a href="#!" id="createNewAccoutButton">créer un compte</a>
                                    </p>
                                    <p>
                                        <a href="#!" id="passwordResetButton">mot de passe oublié ? </a>
                                    </p>
                                </form>
                                <!-- Default form register -->
                            </div>

                            <!-- CREATE NEW ACCOUNT LOGIN -->

                            <div id="createAccount" class="col-12 col-lg-6">
                                <!-- Default form register -->
                                <form class="text-center border p-5" action="#!" id="register-form">

                                    <p class="h2 mb-4">Démarrer</p>

                                    <!-- Sign up Email button -->
                                    <a href="{{ route('guests.google.redirection') }}" class="btn btn-custum" type="submit">
                                        <img src="{{ asset('assets/images/google.png') }}" alt="" class="google-logo"> Continuer avec google
                                    </a>

                                    <div class="orBlock">
                                        <span class="forOr">OU</span>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <!-- First name -->
                                            <input type="text" name="registerFirstName" id="defaultRegisterFormFirstName" class="form-control" placeholder="Prénom">
                                            <small class="error-log" id="errorFirstName"></small>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <!-- Last name -->
                                            <input type="text" name="registerLastName" id="defaultRegisterFormLastName" class="form-control" placeholder="Nom ">
                                            <small class="error-log" id="errorLastName"></small>
                                        </div>
                                    </div>

                                    <!-- E-mail -->
                                    <div class="form-group mb-3">
                                        <input type="email" name="registerEmail" id="defaultRegisterFormEmail" class="form-control" placeholder="E-mail">
                                        <small class="error-log" id="errorEmail"></small>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group mb-3">
                                        <input type="password" name="registerPassword" id="defaultRegisterFormPassword" class="form-control register_password" placeholder="Mot de passe">
                                    </div>

                                    <div class="form-group mb-2">
                                        <input type="password" name="registerPassword_confirmation" id="defaultRegisterFormPasswordConfirmation" class="form-control register_password" placeholder="Confirmer le mot de passe">
                                        <small class="error-log" id="errorPassword"></small>
                                    </div>


                                    <!-- Newsletter -->
                                    <div class="custom-control custom-checkbox custum-box">
                                        <input type="checkbox" class="custom-control-input" id="show_or_hide_password">
                                        <label class="custom-control-label" for="show_or_hide_password">Afficher le mot de passe</label>
                                    </div>

                                    <!-- Sign up button -->
                                    <button class="btn btn-validate my-4 btn-block" type="submit" id="createAccountButton">Créer le compte</button>

                                    <!-- Terms of service -->
                                    <p>J'ai déjà un compte,
                                        <a href="#!" class="loginAccountButton">Me connecter</a>
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
                                    <input type="email" id="defaultForgetFormEmail" class="form-control mb-4" placeholder="E-mail">

                                    <!-- Authentification code -->
                                    <input type="email" id="passResetCode" class="form-control" placeholder="Entrer le code">
                                    <small id="log-message" class="form-text log-advice mb-4">
                                        Cet code ne sera plus valable après 5 minutes, veuillez vérifier votre boite mail !
                                    </small>

                                    <!-- Sign up button -->
                                    <button class="btn btn-validate my-4 btn-block passResetSubmit" type="submit">Valider</button>
                                    <p>
                                        <a href="#!" class="loginAccountButton">Me connecter</a>
                                    </p>

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
        <script src="{{ asset('styles/mdb/js/jquery.js') }}"></script>
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

            $(document).ready(function () {

                $.createAccountPanel = function () {

                    const createAccountUrl = "http://localhost/goproject/acces#inscription"
                    const createAccountTitle = "create account"
                    const createAccountState = {page: 'Create account'}

                    window.history.replaceState(createAccountState, createAccountTitle, createAccountUrl)

                    $('#loginAccount').hide()
                    $('#passReset').hide()
                    $('#createAccount').fadeIn()
                }

                $.loginAccountPanel = function () {

                    const loginAccountUrl = "http://localhost/goproject/acces#connexion"
                    const loginAccountTitle = "login account"
                    const loginAccountState = {page: 'Login account'}

                    window.history.replaceState(loginAccountState, loginAccountTitle, loginAccountUrl)

                    $('#passReset').hide()
                    $('#createAccount').hide()
                    $('#loginAccount').fadeIn()
                }

                $.passwordResetPanel = function () {

                    const passwordForgottentUrl = "http://localhost/goproject/acces#forgotten_password"
                    const passwordForgottenTitle = "password forgotten"
                    const passwordForgottenState = {page: 'Password forgotten'}

                    window.history.replaceState(passwordForgottenState, passwordForgottenTitle, passwordForgottentUrl)

                    $('#loginAccount').hide()
                    $('#createAccount').hide()
                    $('#passReset').fadeIn()
                }

                $('#createNewAccoutButton').click(function (event) {
                    event.preventDefault()
                    $.createAccountPanel()
                });

                $('#passwordResetButton').click(function (event) {
                    event.preventDefault()
                    $.passwordResetPanel()
                });

                $('.loginAccountButton').click(function (event) {
                    event.preventDefault()
                    $.loginAccountPanel()
                });

                if (window.location.href == "http://localhost/goproject/acces#inscription") {
                    $.createAccountPanel()
                }

                if (window.location.href == "http://localhost/goproject/acces#connexion" || window.location.href == "http://localhost/goproject/acces") {
                    $.loginAccountPanel()
                }

                if (window.location.href == "http://localhost/goproject/acces#forgotten_password") {
                    $.passwordResetPanel()
                }

                let _token = $("[name='_token']").attr('value')
                let status_text = ""

                /* -- Login function and methods -- */

                    let loginEmail = $('#defaultLoginFormEmail')
                    let loginPassword = $('#defaultLoginFormPassword')

                    let errorLoginEmailMessage = "Veuillez renseigner l'adresse mail de votre compte"
                    let errorLoginPasswordMessage = "Veuillez renseigner votre mot de passe"

                    let get_login_url = "{{ route('guests.login.processing') }}"

                    // Login Form Submitted
                    $('#login-form').on('submit', function(e) {
                        e.preventDefault()

                        $.loginProcessingButton()

                        $.validateLoginForm()

                        $.ajax({
                            type: "POST",
                            url: get_login_url,
                            data: {
                                loginEmail: loginEmail.val(),
                                loginPassword: loginPassword.val(),
                                _token: _token
                            },
                            success: function (response) {

                                if (response.status == '800') {
                                    $.loginEmailNonValidated(response.message)
                                } else if (response.status == 'password_error') {
                                    $.loginPasswordNotInformed(response.message)
                                } else if (response.status == 'email_error') {
                                    $.loginEmailNonValidated(response.message)
                                } else {
                                    window.location.href = response.message
                                }
                            },
                            error: function (error) {
                                let loginErrors = JSON.parse(error.responseText)

                                loginPassword.val('')

                                if (typeof(loginErrors.errors) != 'undefined') {

                                    if (typeof(loginErrors.errors.loginEmail) != 'undefined') {
                                        $.loginEmailNonValidated(loginErrors.errors.loginEmail)
                                    }

                                    if (typeof(loginErrors.errors.loginPassword) != 'undefined') {
                                        $.loginPasswordNotInformed(loginErrors.errors.loginPassword)
                                    }

                                } else {
                                    console.log('Une erreur s\'est produite')
                                }
                            }
                        })
                    })

                    // Show or Hide Login password
                    $('#showHideLoginPassword').change(function () {
                        if ($(this).is(':checked')) {
                            $(loginPassword).attr('type', 'text')
                        } else {
                            $(loginPassword).attr('type', 'password')
                        }
                    })

                    // Second login validation by inputs
                    loginEmail.on('keyup', function () {
                        if (loginEmail.val().length > 0) {
                            $.loginEmailValidated()
                        } else {
                            $.loginEmailNonValidated(errorLoginEmailMessage)
                        }
                    })

                    loginPassword.on('keyup', function () {
                        if (loginPassword.val().length > 0) {
                            loginPassword.removeClass('is-invalid')
                            loginPassword.addClass('is-valid')
                            $('#errorLoginPassword').hide()
                        } else {
                            loginPassword.addClass('is-invalid')
                            $('#errorLoginPassword').html(errorLoginPasswordMessage)
                            $('#errorLoginPassword').fadeIn()
                        }
                    })

                    $.loginProcessingButton = function() {
                        $('#connection_button').attr('disabled', true)
                        $('#connection_button').text('Connexion en cours...')
                    }

                    $.loginNotProcessingButton = function() {
                        $('#connection_button').attr('disabled', false)
                        $('#connection_button').text('Se connecter')
                    }

                    // Login Email validated
                    $.loginEmailValidated = function() {
                        loginEmail.removeClass('is-invalid')
                        loginEmail.addClass('is-valid')
                        $('#errorLoginEmail').hide()
                    }

                    // Login Email non validated
                    $.loginEmailNonValidated = function(status_text) {
                        loginEmail.addClass('is-invalid')
                        $('#errorLoginEmail').html(status_text)
                        $('#errorLoginEmail').fadeIn()
                    }

                    // Login Password not informed
                    $.loginPasswordNotInformed = function(status_text) {
                        loginPassword.addClass('is-invalid')
                        $('#errorLoginPassword').html(status_text)
                        $('#errorLoginPassword').fadeIn()
                    }

                    // First Validation of login
                    $.validateLoginForm = function() {
                        if (loginEmail.val() == '' || loginPassword.val() == '') {
                            if (loginEmail.val() == '') {
                                $.loginEmailNonValidated(errorLoginEmailMessage)
                            } else {
                                $.loginEmailValidated()
                            }

                            if (loginPassword.val() == '') {
                                $.loginPasswordNotInformed(errorLoginPasswordMessage)
                            } else {
                                loginPassword.removeClass('is-invalid')
                                loginPassword.addClass('is-valid')
                                $('#errorLoginPassword').hide()
                            }
                        }
                        $.loginNotProcessingButton()
                    }

                /* -- End of the part of login -- */



                /* -- Registration functions and methods -- */

                    // let match_password = /^.*(?=.{8,})((?=.*[!@#$%^&*()\-_=+{};:,<.>]){1})(?=.*\d)((?=.*[a-z]){1})((?=.*[A-Z]){1}).*$/g

                    let registerFirstName = $('#defaultRegisterFormFirstName')
                    let registerLastName = $('#defaultRegisterFormLastName')
                    let registerEmail = $('#defaultRegisterFormEmail')
                    let registerPassword = $('#defaultRegisterFormPassword')
                    let registerPasswordConfirmed = $('#defaultRegisterFormPasswordConfirmation')

                    let errorFirstNameMessage = "Veuillez renseigner votre prénom"
                    let errorLastNameMessage = "Veuillez renseigner votre nom"
                    let errorEmailMessage = "veuillez renseigner votre email"
                    let errorPasswordNotInformed = "Veuillez renseigner votre mot de passe"
                    let errorPasswordNotConformed = "Les mot de passe ne sont pas conformes"

                    let get_url = "{{ route('guests.registration') }}"

                    // Register Form Submitted
                    $('#register-form').on('submit', function(e) {
                        e.preventDefault();

                        $.validateRegisterForm()

                        console.log('right not: ' + $.validateRegisterForm())

                        if (!$.validateRegisterForm()) {
                            $.ajax({
                                type: "POST",
                                url: get_url,
                                data: {
                                    registerFirstName: registerFirstName.val(),
                                    registerLastName: registerLastName.val(),
                                    registerEmail: registerEmail.val(),
                                    registerPassword: registerPassword.val(),
                                    registerPassword_confirmation: registerPasswordConfirmed.val(),
                                    _token: _token
                                },
                                success: function (response) {
                                    window.location.href = response
                                },
                                error: function (error) {
                                    let getErrors = JSON.parse(error.responseText)

                                    registerPassword.val('')
                                    registerPasswordConfirmed.val('')

                                    if (typeof(getErrors.errors) != 'undefined') {

                                        if (typeof(getErrors.errors.registerFirstName) != 'undefined') {
                                            $.registerFirstNameNonValidated(getErrors.errors.registerFirstName)
                                        }

                                        if (typeof(getErrors.errors.registerLastName) != 'undefined') {
                                            $.registerLastNameNonValidated(getErrors.errors.registerLastName)
                                        }

                                        if (typeof(getErrors.errors.registerEmail) != 'undefined') {
                                            $.registerEmailNonValidated(getErrors.errors.registerEmail)
                                        }

                                        if (typeof(getErrors.errors.registerPassword) != 'undefined') {
                                            $.registerPasswordNotInformed(getErrors.errors.registerPassword)
                                        }
                                    } else {
                                        console.log('Une erreur s\'est produite')
                                    }
                                }
                            })
                        }
                    })

                    // Show or hide register password
                    $('#show_or_hide_password').change(function () {
                        if ($(this).is(':checked')) {
                            $('.register_password').attr('type', 'text')
                        } else {
                            $('.register_password').attr('type', 'password')
                        }
                    })

                    // Second register validation by inputs

                    registerFirstName.on('keyup', function () {
                        if (registerFirstName.val().length > 0) {
                            $.registerFirstNameValidated()
                        } else {
                            $.registerFirstNameNonValidated(errorFirstNameMessage)
                        }
                    })

                    registerLastName.on('keyup', function () {
                        if (registerLastName.val().length > 0) {
                            $.registerLastNameValidated()
                        } else {
                            $.registerLastNameNonValidated(errorLastNameMessage)
                        }
                    })

                    registerEmail.on('keyup', function () {
                        if (registerEmail.val().length > 0) {
                            $.registerEmailValidated()
                        } else {
                            $.registerEmailNonValidated(errorEmailMessage)
                        }
                    })

                    registerPassword.on('keyup', function () {
                        if (registerPassword.val().length > 0) {
                            registerPassword.removeClass('is-invalid')
                            registerPassword.addClass('is-valid')
                            registerPasswordConfirmed.addClass('is-invalid')
                            $('#errorPassword').hide()
                        } else {
                            registerPassword.addClass('is-invalid')
                            registerPasswordConfirmed.addClass('is-invalid')
                            $('#errorPassword').html(errorPasswordNotInformed)
                            $('#errorPassword').fadeIn()
                        }
                    })

                    registerPasswordConfirmed.on('keyup', function () {
                        if (registerPasswordConfirmed.val().length > 0) {
                            registerPassword.removeClass('is-invalid')
                            registerPassword.addClass('is-valid')
                            $('#errorPassword').html(errorPasswordNotConformed)
                            $('#errorPassword').fadeIn()
                            if (registerPassword.val() == registerPasswordConfirmed.val()) {
                                registerPasswordConfirmed.removeClass('is-invalid')
                                registerPasswordConfirmed.addClass('is-valid')
                                registerPassword.removeClass('is-invalid')
                                registerPassword.addClass('is-valid')
                                $('#errorPassword').hide()
                            } else {
                                registerPasswordConfirmed.removeClass('is-valid')
                                registerPasswordConfirmed.addClass('is-invalid')
                            }
                        } else {
                            registerPassword.addClass('is-invalid')
                            registerPasswordConfirmed.addClass('is-invalid')
                            $('#errorPassword').html(errorPasswordNotConformed)
                            $('#errorPassword').fadeIn()
                        }
                    })

                    // Register First name input validated
                    $.registerFirstNameValidated = function() {
                        registerFirstName.removeClass('is-invalid')
                        registerFirstName.addClass('is-valid')
                        $('#errorFirstName').hide()
                    }

                    // Register First name input non validated
                    $.registerFirstNameNonValidated = function(status_text) {
                        registerFirstName.addClass('is-invalid')
                        $('#errorFirstName').html(status_text)
                        $('#errorFirstName').fadeIn()
                    }

                    // Register Last name input validated
                    $.registerLastNameValidated = function() {
                        registerLastName.removeClass('is-invalid')
                        registerLastName.addClass('is-valid')
                        $('#errorLastName').hide()
                    }

                    // Register Last name input non validated
                    $.registerLastNameNonValidated = function(status_text) {
                        registerLastName.addClass('is-invalid')
                        $('#errorLastName').html(status_text)
                        $('#errorLastName').fadeIn()
                    }

                    // Register Email validated
                    $.registerEmailValidated = function() {
                        registerEmail.removeClass('is-invalid')
                        registerEmail.addClass('is-valid')
                        $('#errorEmail').hide()
                    }

                    // Register Email non validated
                    $.registerEmailNonValidated = function(status_text) {
                        registerEmail.addClass('is-invalid')
                        $('#errorEmail').html(status_text)
                        $('#errorEmail').fadeIn()
                    }

                    // Register Password not informed
                    $.registerPasswordNotInformed = function(status_text) {
                        registerPassword.addClass('is-invalid')
                        registerPasswordConfirmed.addClass('is-invalid')
                        $('#errorPassword').html(status_text)
                        $('#errorPassword').fadeIn()
                    }

                    // Register Password not conformed
                    $.registerPasswordNotConformed = function(status_text) {
                        registerPassword.addClass('is-invalid')
                        registerPasswordConfirmed.addClass('is-invalid')
                        $('#errorPassword').html(status_text)
                        $('#errorPassword').fadeIn()
                    }

                    // First Validation of register
                    $.validateRegisterForm = function() {

                        let errorStatus = false;

                        if (registerFirstName.val() == '' || registerLastName.val() == '' || registerEmail.val() == '' || registerPassword.val() == '' || registerPasswordConfirmed.val() == '') {
                            if (registerFirstName.val() == '') {
                                $.registerFirstNameNonValidated(errorFirstNameMessage)
                                errorStatus = true;
                            } else {
                                $.registerFirstNameValidated()
                            }

                            if (registerLastName.val() == '') {
                                $.registerLastNameNonValidated(errorLastNameMessage)
                                errorStatus = true;
                            } else {
                                $.registerLastNameValidated()
                            }

                            if (registerEmail.val() == '') {
                                $.registerEmailNonValidated(errorEmailMessage)
                                errorStatus = true;
                            } else {
                                $.registerEmailValidated()
                            }

                            if (registerPassword.val() == '' || registerPasswordConfirmed.val() == '') {
                                $.registerPasswordNotInformed(errorPasswordNotInformed)
                                errorStatus = true;
                            } else {
                                $.registerPasswordNotConformed(errorPasswordNotConformed)
                                errorStatus = true;
                            }
                        }

                        if (registerPassword.val() != registerPasswordConfirmed.val()) {
                            $.registerPasswordNotConformed(errorPasswordNotConformed)
                            errorStatus = true;
                        }

                        return errorStatus;
                        
                    }

                /* -- End of the part of registration -- */

                $('.passResetSubmit').click(function (event) {
                    event.preventDefault()
                    $('#passResetCode').fadeIn()
                    $('#log-message').fadeIn()
                });
            })
        </script>
    </body>
</html>
