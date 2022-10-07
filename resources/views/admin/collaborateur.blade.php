@extends('admin.layouts.master')

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
              <h6 href="#" class="name-project">TOUS VOS COLLABORATEURS</h6>
              <a href="#!" data-toggle="modal" data-target="#chooseProject" class="add-link"><i class="fas fa-hand-point-right"></i> Choisir le projet</a>
          </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header cardHeader">
              Vos collaborateurs sur le projet : Gozem
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
      
      <div class="modal fade" id="chooseProject" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Choisir le projet</h5>
              <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="">
                <div class="form-group">
                  <label for="statut">Voulez-vous afficher les collaborateurs de quel projet ?</label>
                  <select name="statut" id="statut" class="form-control">
                    <option value="" disabled><b>Vos projets</b></option>
                    <option value="1">Kozah 3</option>
                    <option value="2">Gozem</option>
                    <option value="3">Golfe 1</option>
                  </select>
                </div>
              </form>
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
