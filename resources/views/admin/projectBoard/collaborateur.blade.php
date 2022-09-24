@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/collaborateur.css') }}">
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content pt-4">
       <div class="container-fluid">
          <div class="row">
              <div class="col-12 pb-5">
                  <a href="#" class="name-project">Gestion de projet</a><span class="page-name">/ Client</span>
                  <a href="#" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Ajouter un collaborateur</a>
              </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header cardHeader">
                  Liste des collaborateurs sur votre projet : Gestion de projet
                </div>
                <div class="card-body bg-secondary">
                  <div class="row">
                    <div class="col-md-4">
                        <!-- Widget: user widget style 2 -->
                      <div class="card card-widget widget-user-2 shadow-sm">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header small-card-header">
                          <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ asset('styles/admin/dist/img/user7-128x128.jpg') }}" alt="User Avatar">
                          </div>
                          <!-- /.widget-user-image -->
                          <h3 class="widget-user-username">GOMEZ Felix</h3>
                          <h5 class="widget-user-desc">Developpeur</h5>
                        </div>
                        <div class="card-footer p-0">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Projets <span class="float-right badge bg-primary">31</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Tâches <span class="float-right badge bg-info">5</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Projets finalisés <span class="float-right badge bg-success">12</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Contact <span class="float-right badge bg-light">90 xx xx xx</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Email <span class="float-right badge bg-light">lemail@gmail.com</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </div>
                    <div class="col-md-4">
                        <!-- Widget: user widget style 2 -->
                      <div class="card card-widget widget-user-2 shadow-sm">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header small-card-header">
                          <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ asset('styles/admin/dist/img/user7-128x128.jpg') }}" alt="User Avatar">
                          </div>
                          <!-- /.widget-user-image -->
                          <h3 class="widget-user-username">GOMEZ Felix</h3>
                          <h5 class="widget-user-desc">Developpeur</h5>
                        </div>
                        <div class="card-footer p-0">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Projets <span class="float-right badge bg-primary">31</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Tâches <span class="float-right badge bg-info">5</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Projets finalisés <span class="float-right badge bg-success">12</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Contact <span class="float-right badge bg-light">90 xx xx xx</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Email <span class="float-right badge bg-light">lemail@gmail.com</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </div>
                    <div class="col-md-4">
                        <!-- Widget: user widget style 2 -->
                      <div class="card card-widget widget-user-2 shadow-sm">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header small-card-header">
                          <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ asset('styles/admin/dist/img/user7-128x128.jpg') }}" alt="User Avatar">
                          </div>
                          <!-- /.widget-user-image -->
                          <h3 class="widget-user-username">GOMEZ Felix</h3>
                          <h5 class="widget-user-desc">Developpeur</h5>
                        </div>
                        <div class="card-footer p-0">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Projets <span class="float-right badge bg-primary">31</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Tâches <span class="float-right badge bg-info">5</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Projets finalisés <span class="float-right badge bg-success">12</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Contact <span class="float-right badge bg-light">90 xx xx xx</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Email <span class="float-right badge bg-light">lemail@gmail.com</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </div>
                  </div>
                </div>
              </div>
          </div>
         </div>   
       </div>
    </section>
</div>
@endsection

@section('script')

@endsection
