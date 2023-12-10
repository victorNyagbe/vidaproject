@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/collaborateur.css') }}">
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content pt-4">
       <div class="container-fluid">
        @include('admin.includes.messageReturned')
          <div class="row">
              <div class="col-12 pb-5">
                <a href="#" class="name-project">{{ $project->nom }}</a><span class="page-name">/ Collaborateurs</span>
                @if (session()->get('accessLevel') == 'Owner')
                    <a href="#!" data-toggle="modal" data-target="#addCollab" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Ajouter un collaborateur</a>
                @endif
              </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header cardHeader">
                  <h3 class="card-title count-header-title">Liste des collaborateurs sur votre projet <span class="your-project-name">{{ $project->nom }}</span></h3>
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
                          {{-- <h5 class="widget-user-desc">Developpeur</h5> --}}
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
                            {{-- <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Contact <span class="float-right badge bg-light">90 xx xx xx</span>
                              </a>
                            </li> --}}
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
                          <h3 class="widget-user-username">LEMON Christine</h3>
                          {{-- <h5 class="widget-user-desc">Developpeur</h5> --}}
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
                            {{-- <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Contact <span class="float-right badge bg-light">90 xx xx xx</span>
                              </a>
                            </li> --}}
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
                          <h3 class="widget-user-username">SUCCES Man</h3>
                          {{-- <h5 class="widget-user-desc">Developpeur</h5> --}}
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
                            {{-- <li class="nav-item">
                              <a href="#" class="nav-link collab-link">
                                Contact <span class="float-right badge bg-light">90 xx xx xx</span>
                              </a>
                            </li> --}}
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

        <!-- Modal Old -->
        {{-- <div class="modal fade" id="addCollab" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content bg-secondary">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un collaborateur</h5>
                        <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <div class="modal-body">
                  <form action="{{ route('admin.projectBoard.sendInvitationForCollab', $project) }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Saisir le l'adresse email du collaborateur">
                      </div>
                      <div class="form-group">
                          <input type="hidden" name="typePartner" id="typePartner" value="collab">
                      </div>
                      <div class="form-group">
                      <div class="d-flex justify-content-center">
                          <button type="submit" class="btn btn-primary text-uppercase">Envoyer une demande</button>
                      </div>
                      </div>
                  </form>
                  </div>
              </div>
          </div>
        </div> --}}

        <!-- Modal New-->
        <div class="modal fade" id="addCollab" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content bg-secondary">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un collaborateur</h5>
                        <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.projectBoard.sendInvitationForCollab', $project) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Saisir le l'adresse email du collaborateur" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="typePartner" id="typePartner" value="collab">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary text-uppercase">Envoyer une demande</button>
                                </div>
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

    {{-- <script>
        $(document).ready(function () {
            // Affichez le modal lorsque la page est prête
            $('#addCollab').modal('show');
        });
    </script> --}}

@endsection
