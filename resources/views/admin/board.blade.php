@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/board.css') }}">
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pb-5">
                <h6 class="name-project">Gozem</h6><span class="page-name">/ Bureau</span>
                <a href="#" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Ajouter un tableau</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <section class="content pb-3">
                    <div class="container-fluid h-100">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="card card-warning board-card">
                                    <div class="card-header">
                                        <h3 class="card-title board-card-title">
                                        LISTE TÂCHES
                                        </h3>
                                        <div class="board-card-icon">
                                            <a href="#" data-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left mr-4 mt-4">
                                                <a href="#" class="dropdown-item">
                                                    4 new messages
                                                </a>
                                            </div>
                                            <a href="#">
                                                <i class="bi bi-plus-circle-fill"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body bg-secondary">
                                        <div class="card card-warning card-outline">
                                            <div class="card-header bg-light" id="headingOne">
                                                <h5 class="card-title small-card-title">Création de l'i...</h5>
                                                <div class="card-tools">
                                                    <a href="#" class="btn btn-tool">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <!-- <i class="fas fa-plus signe" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"></i> -->
                                                </div>
                                            </div>
                                            <div class="card-body bg-light">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" disabled>
                                                    <label for="customCheckbox1" class="custom-control-label">Bug</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" disabled>
                                                    <label for="customCheckbox2" class="custom-control-label">Feature</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled>
                                                    <label for="customCheckbox3" class="custom-control-label">Enhancement</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" disabled>
                                                    <label for="customCheckbox4" class="custom-control-label">Documentation</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox5" disabled>
                                                    <label for="customCheckbox5" class="custom-control-label">Examples</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card card-primary board-card">
                                    <div class="card-header">
                                        <h3 class="card-title board-card-title">
                                        À FAIRE
                                        </h3>
                                        <div class="board-card-icon">
                                            <a href="#" data-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left ml-2 mt-4">
                                                <a href="#" class="dropdown-item text-dark">
                                                    4 new messages
                                                </a>
                                            </div>
                                            <a href="#"><i class="bi bi-plus-circle-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body bg-secondary">
                                        <div class="card card-primary card-outline">
                                            <div class="card-header bg-light" id="headingTwo">
                                                <h5 class="card-title small-card-title">1er solution</h5>
                                                    <div class="card-tools">
                                                    <a href="#" class="btn btn-tool">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                                <div class="card-body bg-light">
                                                    Commentaire
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card card-default board-card">
                                    <div class="card-header bg-info">
                                        <h3 class="card-title small-card-title">
                                        EN COURS
                                        </h3>
                                        <div class="board-card-icon">
                                            <a href="#" data-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left mt-4">
                                                <a href="#" class="dropdown-item">
                                                    4 new messages
                                                </a>
                                            </div>
                                            <a href="#"><i class="bi bi-plus-circle-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body bg-secondary">
                                        <div class="accordion" id="accordionThree">
                                            <div class="card card-info card-outline">
                                                <div class="card-header bg-light">
                                                    <h5 class="card-title small-card-title">Créer le dépôt</h5>
                                                    <div class="card-tools">
                                                        <a href="#" class="btn btn-tool">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body bg-light">
                                                    <p>
                                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card card-success board-card">
                                    <div class="card-header">
                                        <h3 class="card-title board-card-title">
                                        TERMINÉ
                                        </h3>
                                        <div class="board-card-icon">
                                            <a href="#" data-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left mr-2 mt-4">
                                                <a href="#" class="dropdown-item text-dark">
                                                    4 new messages
                                                </a>
                                            </div>
                                            <a href="#"><i class="bi bi-plus-circle-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body bg-secondary">
                                        <div class="accordion" id="accordionFour">
                                            <div class="card card-success card-outline">
                                                <div class="card-header bg-light">
                                                    <h5 class="card-title small-card-title">Créer le logo</h5>
                                                    <div class="card-tools">
                                                        <a href="#" class="btn btn-tool">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body bg-light">
                                                    <p>
                                                        Commentaire
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </section>
            </div>
        </div>
    </div>
  </section>
</div>
@endsection

@section('script')

@endsection
