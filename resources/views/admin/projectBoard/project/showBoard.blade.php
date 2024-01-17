@extends('admin.layouts.project.master')

@section('style')
    <style>
        .task-img {
            position: absolute;
            bottom: 0.4em;
            border-radius: 50%;
            width: 30px;
        }
    </style>
@endsection
{{-- @foreach ($users as $index => $user)
    .task-img{{ $index + 1 }} {
    left: {{ $index * 1.5 }}em;
    }
@endforeach --}}


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
                                <i class="fas fa-user"></i>
                                <!-- <i class="ion bi bi-diagram-2-fill"></i> -->
                            </div>
                            <div class="inner">
                                <div class="box-info">
                                    <h3>{{ \App\Models\ProjectUser::where([
                                        ['project_id', '=', $project->id],
                                        ['status', '=', 1],
                                        ['id', '!=', $project->project_client],
                                    ])->count() }}
                                    </h3>
                                    <p>Collaborateurs</p>
                                </div>
                            </div>
                            <a href="" class="small-box-footer">More info <i
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
                                    <h3>{{ \App\Models\Task::where([['project_id', '=', $project->id]])->count() }}
                                    </h3>

                                    <p>Tâches</p>
                                </div>
                            </div>

                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
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
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> --}}
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="icon">
                                <i class="ion bi bi-person-lines-fill"></i>
                            </div>
                            <div class="inner">
                                <div class="box-info">

                                    <h3>{{ $filteredUsers->count() }}</h3>

                                    <p>En ligne</p>
                                </div>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
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
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="card bg-light mb-3 small-task-card">
                                            <div class="card-header small-task-header">Nom du projet</div>
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
                                                    <div class="task-profil">
                                                        @foreach ($users as $index => $user)
                                                            <img src="{{ $user->profile }}"
                                                                class="task-img task-img{{ $index + 1 }}"
                                                                alt="User Image" style="left: {{ $index * 1.5 }}em;">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4 col-sm-4">
                        <div class="card card-outline balance-card">
                            <div class="card-header bg-secondary ">
                                <h3 class="balance-header-title">Progression</h3>
                            </div>
                            <div class="card-body bg-secondary">
                                <div class="text-center">
                                    <div class="number-circle">
                                        <?php
                                        if ($totalTasks != 0) {
                                            $pourcent = ($completedTasks / $totalTasks) * 100;
                                        } else {
                                            $pourcent = 0;
                                        }
                                        
                                        ?>
                                        <p class="number">{{ round($pourcent) }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-sm-4">
                        <div class="card card-outline count-card">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title count-header-title">Nombre total de clients</h3>
                            </div>
                            <div class="card-body bg-secondary">
                                <div class="text-center">
                                    <div class="number-circle">
                                        <p class="number">
                                            {{ \App\Models\ProjectUser::where([
                                                ['project_id', '=', $project->id],
                                                ['status', '=', 1],
                                                ['id', '=', $project->project_client],
                                            ])->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-sm-4">
                        <div class="card card-outline count-card">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title count-header-title">Collaborations rejétées</h3>
                            </div>
                            <div class="card-body bg-secondary">
                                <div class="text-center">
                                    <div class="number-circle">
                                        <p class="number">
                                            {{ \App\Models\Invitation::where([
                                                ['project_id', '=', $project->id],
                                                ['status', '=', 'refusee'],
                                                ['id', '!=', $project->project_client],
                                            ])->count() }}
                                        </p>
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
