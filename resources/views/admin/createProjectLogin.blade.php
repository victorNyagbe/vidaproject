<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>GoProject</title>
    <link rel="stylesheet" href="{{ asset('styles/admin/plugins/fonts/roboto.css') }}">
    <link href="{{ asset('styles/mdb/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/admin/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
    <link href="{{ asset('styles/admin/createProjectLogin.css') }}" rel='stylesheet'>
</head>
<body class='snippet-body'>
    <section class="body">
        <div class="container">
            @include('admin.includes.messageReturned')
            <div class="login-box">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="logo">
                            <center><img src="{{ asset('assets/logos/goproject-03.png') }}" alt=""></center>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <br>
                        <h3 class="header-title">CREER UN PROJET</h3>
                        <form class="login-form" action="{{ route('admin.home.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="project_name" id="project_name" class="form-control" placeholder="Nom du projet">
                            </div>
                            <!-- <div class="form-group">
                                <input type="text" class="form-control" placeholder="Mot clé*">
                            </div> -->
                            <div class="form-group">
                                <select name="project_type" id="project_type" class="select2 form-control" multiple="multiple" data-placeholder="Choisir le type de projet" style="width: 100%;">
                                    <option>Application web</option>
                                    <option>Application mobile</option>
                                    <option>Application destop</option>
                                    <option>Site web</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">CREER</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 hide-on-mobile">
                        <div id="demo" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                                <li data-target="#demo" data-slide-to="1"></li>
                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="slider-feature-card">
                                        <img src="{{ asset('assets/icons/cloud.png') }}" alt="">
                                        <h3 class="slider-title">Title Here</h3>
                                        <p class="slider-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, odio!</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="slider-feature-card">
                                        <img src="{{ asset('assets/icons/user.png') }}" alt="">
                                        <h3 class="slider-title">Title Here</h3>
                                        <p class="slider-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, debitis?</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('styles/admin/plugins/jquery/jquery.js') }} "></script>
    <script src="{{ asset('styles/admin/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('styles/admin/plugins/select2/js/select2.full.js') }}"></script>
    <script src="{{ asset('styles/admin/plugins/select2/js/select2.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })
        })
    </script>
</body>
</html>