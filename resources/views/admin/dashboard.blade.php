@extends('admin.layouts.master')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .success-icon {
            font-size: 120px;
        }

        .successMessage {
            text-align: center;
            font-size: 1.2em;
        }

        .failure-icon {
            font-size: 120px;
        }

        .failureMessage {
            text-align: center;
            font-size: 1.2em;
        }

        .task-img {
            position: absolute;
            bottom: 0.4em;
            border-radius: 50%;
            width: 30px;
        }
    </style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content pt-4">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="icon">
                                <i class="fas fa-project-diagram"></i>
                                <!-- <i class="ion bi bi-diagram-2-fill"></i> -->
                            </div>
                            <?php
                            $totalProjects = $projects->count();
                            $totalProjectCollabs = $projectCollabs->count();
                            $totalProjectAll = $totalProjects + $totalProjectCollabs;
                            ?>
                            <div class="inner">
                                <div class="box-info">
                                    <h3>{{ $totalProjectAll }}</h3>

                                    <p>Projets</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.project.project') }}" class="small-box-footer">Voir plus <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="icon">
                                <i class="ion bi-list-task"></i>
                                <i class="bi bi-arrow-repeat task-icon"></i>
                            </div>
                            <div class="inner">
                                <div class="box-info">
                                    <h3>{{ \App\Models\Task::where([['project_user_id', '=', session()->get('id')]])->count() }}
                                    </h3>

                                    <p>Tâches</p>
                                </div>
                            </div>

                            <a href="#!" data-toggle="modal" data-target="#taskModal" class="small-box-footer">Voir
                                plus <i class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>
                    <!-- ./col -->
                    {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="icon">
                <i class="ion bi bi-calendar-date-fill"></i>
              </div>
              <div class="inner">
                <div class="box-info">
                  <h3>5</h3>

                  <p>Calendrier</p>
                </div>
              </div>
              <a href="#" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> --}}
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="icon">
                                <i class="ion bi bi-person-lines-fill"></i>
                            </div>
                            <?php
                            // $connected_id = session()->get('id');
                            // $userConnectedProjects = \App\Models\Project::where('owner_id', $connected_id)->get();
                            // $getConnectedCollabUsers = \App\Models\ProjectUser::where([['user_mail', '=', session()->get('email')], ['status', '=', 1]])->get();
                            
                            // $userConnectedProjectCollabs = collect();
                            
                            // foreach ($getConnectedCollabUsers as $collab) {
                            //     $userConnectedProjectCollabs = $userConnectedProjectCollabs->merge(\App\Models\Project::where('id', $collab->project_id)->get());
                            // }
                            
                            // $listAllUserConnectedProjects = $userConnectedProjects->merge($userConnectedProjectCollabs)->unique('id');
                            
                            // $allSessions = app('session.store')->all();
                            
                            // $allSessions = count(app('session.store')->all());
                            
                            // Obtenez la requête HTTP correctement
                            // $request = app('request');
                            
                            // $allSessions = $request->session()->all();
                            
                            // dd($allSessions);
                            
                            // Assurez-vous que $allSessions est un tableau
                            // if (is_array($allSessions)) {
                            //     $allSessionKeys = array_keys($allSessions);
                            //     dd($allSessionKeys);
                            // } else {
                            //     // Gérez le cas où $allSessions n'est pas un tableau
                            //     dd("La variable \$allSessions n'est pas un tableau.");
                            // }
                            
                            // $allSessionKeys = array_keys($allSessions);
                            // dd($allSessionKeys);
                            
                            // $usersOnline = collect($allSessions)->reject(function ($value, $key) use ($connected_id) {
                            //     return $key == 'id:' . $connected_id;
                            // });
                            
                            // Récupérer toutes les sessions actives
                            // $allSessions = \Illuminate\Support\Facades\Session::all();
                            
                            // $prefix = config('session.cookie');
                            
                            // $usersOnline = collect($allSessions)->reject(function ($value, $key) use ($prefix, $connected_id) {
                            //     return $key == $prefix . ':id:' . $connected_id;
                            // });
                            // dd($usersOnline);
                            
                            // dd($usersOnline);
                            
                            // dd(count($usersOnline));
                            
                            // foreach ($listAllUserConnectedProjects as $project) {
                            
                            //     if ($usersOnline) {
                            //         # code...
                            //     }
                            // }
                            ?>

                            @php
                                $connectedCount = app()->call('App\Http\Controllers\Admin\MainController@getUsersConnectedCount');
                            @endphp
                            <div class="inner">
                                <div class="box-info">
                                    <h3>{{ $connectedCount }}</h3>

                                    <p>En ligne</p>
                                </div>
                            </div>
                            <a href="#!" data-toggle="modal" data-target="#onlineModal" class="small-box-footer">Voir
                                plus <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    {{-- Modal de la partie des tâches --}}
                    <div class="col-12">
                        <div class="modal fade show" id="taskModal" tabindex="-1" role="dialog"
                            aria-labelledby="successModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-success" id="successModalLabel">Liste des tâches</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="task-content">
                                            <div class="row">
                                                <div class="col-6 text-center project-name">
                                                    <h6>Projets</h6>
                                                </div>
                                                <div class="col-4 text-center task-counter">
                                                    <h6>Nombre de tâches</h6>
                                                </div>
                                                <div class="col-2 text-center task-action">
                                                    <h6>Action</h6>
                                                </div>
                                            </div>
                                            <hr style="height: 0.4rem;">
                                            <div class="row">
                                                @forelse($listAllMyProjects as $project)
                                                    <div class="col-6 text-center project-name">{{ $project->nom }}</div>
                                                    <div class="col-4 text-center task-counter">
                                                        {{ \App\Models\Task::where([['project_user_id', '=', session()->get('id')], ['project_id', '=', $project->id]])->count() }}
                                                    </div>
                                                    <div class="col-2 text-center task-action">
                                                        <a href="{{ route('admin.board', $project) }}"
                                                            class="btn btn-info btn-sm {{ $page == 'admin.projectBoard.board' ? 'active' : '' }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <hr style="height: 0.2rem;">
                                                @empty
                                                    <div class="col-12">
                                                        <h6 class="text-center">
                                                            Pas de tâche disponible!
                                                        </h6>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modale de la partie des personnes connectés --}}
                    <div class="modal fade show" id="onlineModal" tabindex="-1" role="dialog"
                        aria-labelledby="successModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-success" id="successModalLabel">Toutes Les Personnes
                                        Connectés</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6 text-center project-name">
                                            <h6>Projets</h6>
                                        </div>
                                        <div class="col-6 text-center connect-counter">
                                            <h6>Nombre de Connectés</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        @forelse($listAllMyProjects as $project)
                                            <div class="col-6 text-center project-name">{{ $project->nom }}</div>
                                            <?php
                                            $userProjects = \App\Models\User::find(session('id'));
                                            
                                            $connectedUsers = \App\Models\ConnectedSession::where('session_email', '!=', $userProjects->email)->get();
                                            
                                            $filteredUsers = collect();
                                            
                                            foreach ($connectedUsers as $connectedUser) {
                                                if ($userProjects->id == $project->owner_id) {
                                                    // L'utilisateur actuel est le propriétaire du projet, récupérer les collaborateurs
                                                    $projectCollabs = \App\Models\ProjectUser::where([['user_id', $connectedUser->user_id], ['project_id', $project->id]])->get();
                                            
                                                    foreach ($projectCollabs as $projectCollab) {
                                                        $collabUser = \App\Models\User::find($projectCollab->user_id);
                                                        $filteredUsers->push($collabUser);
                                                    }
                                                } else {
                                                    // L'utilisateur actuel n'est pas le propriétaire du projet
                                                    $projectOwner = \App\Models\User::find($project->owner_id);
                                                    $filteredUsers->push($projectOwner);
                                            
                                                    // Ajouter les collaborateurs liés au projet à la collection
                                                    $projectCollabs = \App\Models\ProjectUser::where([['user_id', $connectedUser->user_id], ['project_id', $project->id]])->get();
                                            
                                                    foreach ($projectCollabs as $projectCollab) {
                                                        $collabUser = \App\Models\User::find($projectCollab->user_id);
                                                        $filteredUsers->push($collabUser);
                                                    }
                                                }
                                            }
                                            
                                            $filteredUsers = $filteredUsers->unique('id');
                                            ?>
                                            <div class="col-6 text-center connect-counter">
                                                {{ $filteredUsers->count() }}
                                            </div>
                                            <hr style="height: 0.2rem;">
                                        @empty
                                            <div class="col-12">
                                                <h6 class="text-center">
                                                    Pas de personne connecté!
                                                </h6>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card bg-secondary">
                            <div class="card-header cardHeader">
                                Projets
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm">
                                        <li class="page-item"><a href="{{ route('admin.project.project') }}"
                                                class="page-link">voir plus</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap table-responsive-md">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nom du projet</th>
                                                <th scope="col">Nombre de Collaborateur</th>
                                                <th scope="col">Chef projet</th>
                                                <th scope="col">Type de projet</th>
                                                <th scope="col">Date de finalisation</th>
                                                <th scope="col">Progression</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            @forelse($listProjects as $project)
                                                <tr>
                                                    <td>{{ $project->nom }}</td>
                                                    <td>{{ \App\Models\ProjectUser::where([
                                                        ['project_id', '=', $project->id],
                                                        ['status', '=', 1],
                                                        ['id', '!=', $project->project_client],
                                                    ])->count() }}
                                                    </td>
                                                    <td>{{ $project->user->fullname }}</td>
                                                    <td>
                                                        @foreach ($project->project_types as $project_type)
                                                            {{ $project_type->nom . ' |' }}
                                                        @endforeach
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}
                                                    </td>
                                                    <?php
                                                    $totalTasks = \App\Models\Task::where('project_id', $project->id)->count();
                                                    $completedTasks = \App\Models\Task::where('project_id', $project->id)
                                                        ->where('status', 2)
                                                        ->count();
                                                    $percentageCompleted = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                                                    ?>
                                                    <td>{{ round($percentageCompleted) }}%</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Pas de projet trouvé</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-secondary">
                            <div class="card-header cardHeader">
                                Vos projets en tant que collaborateurs
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm">
                                        <li class="page-item"><a href="{{ route('admin.project.project') }}"
                                                class="page-link">voir plus</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap table-responsive-md">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nom du projet</th>
                                                <th scope="col">Nombre de Collaborateur</th>
                                                <th scope="col">Chef projet</th>
                                                <th scope="col">Type de projet</th>
                                                <th scope="col">Date de finalisation</th>
                                                <th scope="col">Progression</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            @forelse($listProjectCollabs as $project)
                                                <tr>
                                                    <td>{{ $project->nom }}</td>
                                                    <td>
                                                        {{ \App\Models\ProjectUser::where([
                                                            ['project_id', '=', $project->id],
                                                            ['status', '=', 1],
                                                            ['id', '!=', $project->project_client],
                                                        ])->count() }}
                                                    </td>
                                                    <td>{{ $project->user->fullname }}</td>
                                                    <td>
                                                        @foreach ($project->project_types as $project_type)
                                                            {{ $project_type->nom . ' |' }}
                                                        @endforeach
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}
                                                    </td>
                                                    <?php
                                                    $totalTasks = \App\Models\Task::where('project_id', $project->id)->count();
                                                    $completedTasks = \App\Models\Task::where('project_id', $project->id)
                                                        ->where('status', 2)
                                                        ->count();
                                                    $percentageCompleted = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                                                    ?>
                                                    <td>{{ round($percentageCompleted) }}%</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Pas de projet trouvé</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-secondary">
                            <div class="card-header cardHeader">
                                Avancement des tâches
                                {{-- <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div> --}}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @forelse ($listAllProjects as $project)
                                        <div class="col-lg-3 col-md-3 col-6">
                                            <div class="card bg-light mb-3 small-task-card" style="max-width: 18rem;">
                                                <div class="card-header small-task-header">{{ $project->nom }}</div>
                                                <div class="card-body">
                                                    <?php
                                                    $totalTasks = \App\Models\Task::where('project_id', $project->id)->count();
                                                    $completedTasks = \App\Models\Task::where('project_id', $project->id)
                                                        ->where('status', 2)
                                                        ->count();
                                                    $percentageCompleted = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                                                    ?>
                                                    <h5 class="card-title small-task-title">Tâches éffectués :
                                                        {{ $completedTasks }}/{{ $totalTasks }}
                                                    </h5>
                                                    <div class="card-text">
                                                        <div class="progressbar">
                                                            <div class="progressbar-content"
                                                                style="width: {{ $percentageCompleted }}%;">
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $taskUserIds = \App\Models\Task::where('project_id', $project->id)
                                                            ->pluck('project_user_id')
                                                            ->toArray();
                                                        $users = \App\Models\User::whereIn('id', $taskUserIds)->get();
                                                        ?>
                                                        <div class="task-profil">
                                                            @foreach ($users as $index => $user)
                                                                <img src="{{ $user->profile }}"
                                                                    class="task-img task-img{{ $index + 1 }}"
                                                                    alt="User Image"
                                                                    style="left: {{ $index * 1.5 }}em;">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 d-flex justify-content-center align-items-center">
                                            <h6>Aucune information</h6>
                                        </div>
                                    @endforelse

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
          <div class="col-12 col-lg-6">
            <!-- Calendar -->
            <div class="card bg-gradient-secondary calendar-block">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendrier
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Ajouter un évènement</a>
                      <a href="#" class="dropdown-item">Supprimer un évènement</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">Voir calendrier</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-secondary btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-secondary btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%" class="color"></div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <!-- TO DO List -->
            <div class="card bg-secondary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-clipboard mr-1"></i>
                  Liste de tâches
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo1" id="todoCheck1">
                      <label for="todoCheck1"></label>
                    </div>
                    <!-- todo text -->
                    <span class="text">Concevoir un design de thème</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                      <label for="todoCheck2"></label>
                    </div>
                    <span class="text">Rendre le thème responsive</span>
                    <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo3" id="todoCheck3">
                      <label for="todoCheck3"></label>
                    </div>
                    <span class="text">Dynamiser le login</span>
                    <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo4" id="todoCheck4">
                      <label for="todoCheck4"></label>
                    </div>
                    <span class="text">Dynamiser la première interface</span>
                    <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div> --}}
                <div class="row">
                    <div class="col-12 col-lg-4 col-sm-4">
                        <div class="card card-outline balance-card">
                            <div class="card-header bg-secondary ">
                                <h3 class="balance-header-title">Bilan des projets</h3>
                            </div>
                            <div class="card-body bg-secondary">
                                <div class="text-center">
                                    <?php
                                    $connected_id = session()->get('id');
                                    $connectedProjects = \App\Models\Project::where('owner_id', $connected_id)->get();
                                    $getCollabUsers = \App\Models\ProjectUser::where([['user_mail', '=', session()->get('email')], ['status', '=', 1]])->get();
                                    
                                    $connectedProjectCollabs = collect();
                                    
                                    foreach ($getCollabUsers as $collab) {
                                        $connectedProjectCollabs = $connectedProjectCollabs->merge(\App\Models\Project::where('id', $collab->project_id)->get());
                                    }
                                    
                                    $listAllConnectedProjects = $connectedProjects->merge($connectedProjectCollabs)->unique('id');
                                    
                                    $inProgress = 0;
                                    $isFinished = 0;
                                    $isSuspended = 0;
                                    
                                    foreach ($listAllConnectedProjects as $allConnectedProject) {
                                        $totalConnectedTasks = \App\Models\Task::where('project_id', $allConnectedProject->id)->count();
                                        $completedConnectedTasks = \App\Models\Task::where('project_id', $allConnectedProject->id)
                                            ->where('status', 2)
                                            ->count();
                                        $connectedPercentageCompleted = $totalConnectedTasks > 0 ? ($completedConnectedTasks / $totalConnectedTasks) * 100 : 0;
                                    
                                        if ($connectedPercentageCompleted == 100) {
                                            $isFinished++;
                                        } elseif ($connectedPercentageCompleted < 100) {
                                            if ($connectedPercentageCompleted > 0) {
                                                $inProgress++;
                                            } else {
                                                $inProgressConnectedTasks = \App\Models\Task::where('project_id', $allConnectedProject->id)
                                                    ->where('status', 1)
                                                    ->count();
                                    
                                                if ($inProgressConnectedTasks) {
                                                    $inProgress++;
                                                } else {
                                                    $isSuspended++;
                                                }
                                            }
                                        }
                                    }
                                    ?>

                                    <div class="col-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-warning"><i
                                                    class="far fas fa-project-diagram"></i></span>
                                            <div class="info-box-content">
                                                <span class="balance-title">PROJETS EN COURS</span>
                                                <span class="balance-numero text-warning"> {{ $inProgress }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-success"><i
                                                    class="far fas fa-project-diagram"></i></span>
                                            <div class="info-box-content">
                                                <span class="balance-numero text-success">{{ $isFinished }}</span>
                                                <span class="balance-title">PROJETS RÉALISÉS</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="info-box pb-3">
                                            <span class="info-box-icon bg-danger"><i
                                                    class="far fas fa-project-diagram"></i></span>
                                            <div class="info-box-content">
                                                <span class="balance-title">PROJETS SUSPENDUS</span>
                                                <span class="balance-numero text-danger">{{ $isSuspended }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-sm-4">
                        <div class="card card-outline count-card">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title count-header-title">Projets en tant que clients</h3>
                            </div>
                            <div class="card-body bg-secondary">
                                <div class="text-center">
                                    <div class="number-circle">
                                        <?php
                                        $users = \App\Models\ProjectUser::where([['user_mail', '=', session()->get('email')], ['status', '=', 1]])->get();
                                        $projectsClientCount = $users->sum(function ($user) {
                                            return \App\Models\Project::where([['id', '=', $user->project_id], ['project_client', '=', $user->id]])->count();
                                        });
                                        ?>
                                        <p class="number">{{ $projectsClientCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 col-sm-4">
                        <div class="card card-outline count-card">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title count-header-title">Nombre total de collaborations</h3>
                            </div>
                            <div class="card-body bg-secondary">
                                <div class="text-center">
                                    <div class="number-circle">
                                        <?php
                                        $users = \App\Models\ProjectUser::where([['user_mail', '=', session()->get('email')], ['status', '=', 1]])->get();
                                        $projectsCollabCount = $users->sum(function ($user) {
                                            return \App\Models\Project::where([['id', '=', $user->project_id], ['project_client', '!=', $user->id]])->count();
                                        });
                                        ?>
                                        <p class="number">{{ $projectsCollabCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="modal fade" id="annonce" tabindex="-1" role="dialog" data-backdrop="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 15px;">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-bell"></i> Notification</h5>
                        <button type="button" class="close" aria-label="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="d-flex justify-content-center annonceBell">
                        <span class="fa fa-bell"></span>
                    </div>
                    <div class="d-flex justify-content-center flex-column mt-3">
                        <img src="" alt="" class="img-fluid">
                        <p class="text-center my-2">Vous avez été ajouté à (1) nouveau(x) projet(s)!</p>
                        <p class="text-center pt-4">
                            <a href="" class="btn btn-success mr-4">Accepter</a>
                            <a href="" class="btn btn-danger ml-4">Refuser</a>
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        </div> --}}

                @foreach ($invitations as $invitation)
                    <!-- Modal pour chaque invitation -->
                    <div class="modal fade" id="invitationModal{{ $invitation->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="invitationModal{{ $invitation->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="border-radius: 15px;">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="fa fa-bell"></i> Notification</h5>
                                    <button type="button" class="close" aria-label="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-center annonceBell">
                                        <span class="fa fa-bell"></span>
                                    </div>
                                    <div class="d-flex justify-content-center flex-column mt-3">
                                        <img src="" alt="" class="img-fluid">
                                        <p class="text-center my-2">Vous avez été ajouté à un projet nommé
                                            <b class="text-primary">{{ $invitation->project_name }}</b> en tant que
                                            {{ $invitation->invite_type }}
                                        </p>
                                        <p class="text-center pt-4">
                                            <a href="{{ route('invitation.acceptee', $invitation) }}"
                                                class="btn btn-success mr-4">Accepter</a>
                                            {{-- <a href="#" class="btn btn-success mr-4 accepter-invitation" data-url="{{ route('invitation.acceptee', $invitation) }}">Accepter</a> --}}
                                            <a href="{{ route('invitation.rejetee', $invitation) }}"
                                                class="btn btn-danger ml-4">Refuser</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modal d'acceptation -->

                <div class="modal fade show" id="successModal" tabindex="-1" role="dialog"
                    aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-success" id="successModalLabel">Succès</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="success-icon text-center text-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <p class="successMessage">
                                    Projet accepté!
                                </p>
                            </div>
                            <div class="text-center mb-2 pb-3">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de refus -->

                <div class="modal fade show" id="failureModal" tabindex="-1" role="dialog"
                    aria-labelledby="failureModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-success" id="failureModalLabel">Succès</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="failure-icon text-center text-danger">
                                    <i class="bi bi-x-circle-fill"></i>
                                </div>
                                <p class="failureMessage">
                                    Projet rejeté!
                                </p>
                            </div>
                            <div class="text-center mb-2 pb-3">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Fermer</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            var modals = document.querySelectorAll('.modal');
            modals.forEach(function(modal) {
                // Ajoutez la classe 'show' à tous les modals pour les afficher automatiquement
                modal.classList.add('show');
            });
        });
    </script> --}}

    <script>
        // // Définir la durée en millisecondes (par exemple, 2000 pour 2 secondes)
        // const dureeAutoChargement = 3000;

        // // Fonction pour recharger la page
        // function autoChargementPage() {
        //     location.reload(
        //         true); // Le paramètre true force le rechargement depuis le serveur, sans utiliser le cache du navigateur
        // }

        // // Déclencher le rechargement automatique à intervalles réguliers
        // setInterval(autoChargementPage, dureeAutoChargement);
        // Définir la durée en millisecondes (60 000 pour 1 minute)
        const dureeAutoChargement = 15000;

        // Fonction pour effectuer une requête AJAX et mettre à jour le contenu
        function autoChargementPage() {
            $.ajax({
                url: window.location.href, // URL de la page actuelle
                type: 'GET',
                success: function(data) {
                    // Mettez à jour le contenu de la page avec les données reçues
                    $('body').html(data);
                }
            });
        }

        // Déclencher le rechargement automatique à intervalles réguliers
        setInterval(autoChargementPage, dureeAutoChargement);
    </script>

    @if (session('successModal'))
        <script>
            $(document).ready(function() {
                $('#successModal').modal('show');
            });
        </script>
    @endif

    @if (session('failureModal'))
        <script>
            $(document).ready(function() {
                $('#failureModal').modal('show');
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            @foreach ($invitations as $invitation)
                // Affichez automatiquement le modal pour chaque invitation
                $("#invitationModal{{ $invitation->id }}").modal('show');
            @endforeach
        });

        // Attendez que le document soit prêt
        $(document).ready(function() {
            console.log("helooo")
            // Écoutez le clic sur le bouton d'acceptation
            $('.accepter-invitation').on('click', function(event) {
                // Empêchez le comportement par défaut du lien
                event.preventDefault();

                // Récupérez l'URL depuis l'attribut data-url
                var accepterUrl = $(this).data('url');

                // Effectuez une requête AJAX pour accepter l'invitation
                $.ajax({
                    url: accepterUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#successModal').modal('show');
                        }
                    },
                    error: function(error) {
                        console.error('Erreur lors de l\'acceptation de l\'invitation', error);
                    }
                });
            });
        });
    </script>

    {{-- <script>

        $(document).ready(function () {
            // Affichez le modal lorsque la page est prête
            $('#annonce').modal('show');
        });

    </script> --}}
@endsection
