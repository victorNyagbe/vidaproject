<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>goproject</title>
    <link rel="stylesheet" href="{{ asset('styles/mdb/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/mdb/css/mdb.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/mdb/css/mdb.lite.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/fontawesome/css/all.css') }}">
    <link href="{{ asset('assets/logos/goproject-03.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'MontSerrat', sans-serif;
        }
        .container-custom {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #333;
        }

        .login-panel {
            border: 2px solid white;
            background-color: #eff;
            padding: 12px 15px;
            border-radius: 15px;
        }

        .panel-logo {
            justify-content: center;
            text-align: center;
            background-color: #eff;
        }

        .img-fluid {
            width: 40%;
            border-radius: 50%;
        }

        .panel-text {
            font-size: 1.4rem;
        }
    </style>
</head>
<body>

    <div class="container-custom">
        <div class="container-fluid">
            @include('admin.includes.messageReturned')
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible mb-3" role="alert">
                            {{ $message }}
                            <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h5 class="text-center text-white panel-text">Remplissez le formulaire de connexion !</h5>
                    <div class="login-panel">
                        <div class="panel-logo mb-4">
                            <img src="{{ asset('assets/logos/goproject-03.png') }}" alt="" class="img-fluid">
                        </div>
                        <form action="{{ route('partners.invitePartnerLogin') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="loginEmail" id="defaultRegisterFormEmail" class="form-control" placeholder="E-mail">
                                <small class="error-log" id="errorEmail"></small>
                            </div>
                            <div class="form-group">
                                <input type="password" name="loginPassword" id="defaultRegisterFormPassword" class="form-control register_password" placeholder="Mot de passe">
                            </div>
                            <div class="custom-control custom-checkbox custum-box">
                                <input type="checkbox" class="custom-control-input" id="show_or_hide_password">
                                <label class="custom-control-label" for="show_or_hide_password">Afficher le mot de passe</label>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" class="btn btn-green text-white">Connexion</button>
                                </div>
                            </div>
                            <p>
                                <a href="#!" id="passwordResetButton">mot de passe oublié ? </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('styles/mdb/js/jquery.js') }}"></script>
    <script src="{{ asset('styles/mdb/js/popper.js') }}"></script>
    <script src="{{ asset('styles/mdb/js/bootstrap.js') }}"></script>
    <script>
        $(document).ready(function () {
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
                if (registerFirstName.val() == '' || registerLastName.val() == '' || registerEmail.val() == '' || registerPassword.val() == '' || registerPasswordConfirmed == '') {
                    if (registerFirstName.val() == '') {
                        $.registerFirstNameNonValidated(errorFirstNameMessage)
                    } else {
                        $.registerFirstNameValidated()
                    }

                    if (registerLastName.val() == '') {
                        $.registerLastNameNonValidated(errorLastNameMessage)
                    } else {
                        $.registerLastNameValidated()
                    }

                    if (registerEmail.val() == '') {
                        $.registerEmailNonValidated(errorEmailMessage)
                    } else {
                        $.registerEmailValidated()
                    }

                    if (registerPassword.val() == '' || registerPasswordConfirmed == '') {
                        $.registerPasswordNotInformed(errorPasswordNotInformed)
                    } else {
                        $.registerPasswordNotConformed(errorPasswordNotConformed)
                    }
                }
            }

            /* -- End of the part of registration -- */

            $('.passResetSubmit').click(function (event) {
                event.preventDefault()
                $('#passResetCode').fadeIn()
                $('#log-message').fadeIn()
            });

            $('.toConnect').click(function (event) {
                event.preventDefault()
                $()
                window.location.href = ‘https://ExampleURL.com/’;
                $('#alertInfo').fadeIn()
            });
        });
    </script>
</body>
</html>
