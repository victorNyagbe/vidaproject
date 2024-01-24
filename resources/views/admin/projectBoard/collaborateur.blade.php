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
                        <a href="#" class="name-project">{{ $project->nom }}</a><span class="page-name">/
                            Collaborateurs</span>
                        @if (session()->get('accessLevel') == 'Owner')
                            <a href="#!" data-toggle="modal" data-target="#addCollab" class="add-link"><i
                                    class="bi bi-plus-circle-dotted"></i> Ajouter un collaborateur</a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header cardHeader">
                                <h3 class="card-title count-header-title">Liste des collaborateurs sur le projet <span
                                        class="your-project-name">{{ $project->nom }}</span></h3>
                            </div>
                            <div class="card-body bg-secondary">
                                <div class="row">
                                    @forelse ($projectUsers as $projectUser)
                                        <div class="col-md-4">
                                            <!-- Widget: user widget style 2 -->
                                            <div class="card card-widget widget-user-2 shadow-sm">
                                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                                <div class="widget-user-header small-card-header">
                                                    <div class="widget-user-image">
                                                        <img class="img-circle elevation-2"
                                                            src="{{ $projectUser->user->profile }}" alt="User Avatar">
                                                    </div>
                                                    <!-- /.widget-user-image -->
                                                    <h3 class="widget-user-username">{{ $projectUser->user->fullname }}</h3>
                                                    {{-- <h5 class="widget-user-desc">Developpeur</h5> --}}
                                                </div>
                                                <div class="card-footer p-0">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item">
                                                            <?php
                                                            $nbTasks = 0;
                                                            $nbTasksEnded = 0;
                                                            $nbTasksInProgress = 0;
                                                            $nbTasks = \App\Models\Task::where([['project_id', '=', $project->id], ['project_user_id', '=', $projectUser->user_id]])->count();
                                                            $nbTasksEnded = \App\Models\Task::where([['project_id', '=', $project->id], ['project_user_id', '=', $projectUser->user_id], ['status', '=', 2]])->count();
                                                            $nbTasksInProgress = \App\Models\Task::where([['project_id', '=', $project->id], ['project_user_id', '=', $projectUser->user_id], ['status', '=', 1]])->count();
                                                            ?>
                                                            <a class="nav-link collab-link">
                                                                Tâches <span
                                                                    class="float-right badge bg-info">{{ $nbTasks }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link collab-link">
                                                                Tâches en cours <span
                                                                    class="float-right badge bg-primary">{{ $nbTasksInProgress }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link collab-link">
                                                                Tâches finalisées <span
                                                                    class="float-right badge bg-success">{{ $nbTasksEnded }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="mailto:{{ $projectUser->user_mail }}"
                                                                class="nav-link collab-link">
                                                                Email <span
                                                                    class="float-right collab-mail-link">{{ $projectUser->user_mail }}</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- /.widget-user -->
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <h6 class="text-center">Vous n'avez ajouté aucun collaborateur!</h6>
                                        </div>
                                    @endforelse

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
                                <button type="button" class="close" aria-label="close" data-dismiss="modal"
                                    style="outline: 0;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.projectBoard.sendInvitationForCollab', $project) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Saisir le l'adresse email du collaborateur" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="typePartner" id="typePartner" value="collab">
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary text-uppercase">Envoyer une
                                                demande</button>
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
    <script>
        // if ("{{ session()->get('accessLevel') }}" === 'Collab') {
        //     const dureeAutoChargement = 5000;

        //     // Fonction pour effectuer une requête AJAX et mettre à jour le contenu
        //     function autoChargementPage() {
        //         $.ajax({
        //             url: window.location.href, // URL de la page actuelle
        //             type: 'GET',
        //             success: function(data) {
        //                 // Mettez à jour le contenu de la page avec les données reçues
        //                 $('body').html(data);
        //             }
        //         });
        //     }

        //     // Déclencher le rechargement automatique à intervalles réguliers
        //     setInterval(autoChargementPage, dureeAutoChargement);
        // }
    </script>
    {{-- <script>
        $(document).ready(function () {
            // Affichez le modal lorsque la page est prête
            $('#addCollab').modal('show');
        });
    </script> --}}
@endsection
