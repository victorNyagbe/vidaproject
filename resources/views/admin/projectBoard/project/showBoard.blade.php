@extends('admin.layouts.project.master')

@section('style')
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="icon">
                <i class="fas fa-user"></i>
                <!-- <i class="ion bi bi-diagram-2-fill"></i> -->
              </div>
              <div class="inner">
                <div class="box-info">
                    <h3>{{
                        \App\Models\ProjectUser::where([
                            ['project_id', '=', $project->id],
                            ['status', '=', 1]
                        ])->count()
                    }}</td></h3>
                  <p>Collaborateurs</p>
                </div>
              </div>
              <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="icon">
                <i class="ion bi-list-task"></i>
                <i class="bi bi-arrow-repeat task-icon"></i>
              </div>
              <div class="inner">
                <div class="box-info">
                      <h3>8</h3>

                      <p>Tâches en cours</p>
                </div>
              </div>

              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
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
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="icon">
                <i class="ion bi bi-person-lines-fill"></i>
              </div>
              <div class="inner">
                <div class="box-info">
                  <h3>3</h3>

                  <p>En ligne</p>
                </div>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card bg-secondary">
              <div class="card-header cardHeader">
                Avancement des tâches
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
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-6">
                    <div class="card bg-light mb-3 small-task-card" style="max-width: 18rem;">
                      <div class="card-header small-task-header">Nom du projet</div>
                      <div class="card-body">
                        <h5 class="card-title small-task-title">Tâches éffectués : 10/20</h5>
                        <div class="card-text">
                          <div class="progressbar">
                            <div class="progressbar-content"></div>
                          </div>
                          <div class="task-profil">
                            <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="task-img1" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user8-128x128.jpg') }} " class="task-img2" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user1-128x128.jpg') }} " class="task-img3" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user3-128x128.jpg') }} " class="task-img4" alt="User Image">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-6">
                    <div class="card bg-light mb-3 small-task-card" style="max-width: 18rem;">
                      <div class="card-header small-task-header">Nom du projet</div>
                      <div class="card-body">
                        <h5 class="card-title small-task-title">Tâches éffectués : 10/20</h5>
                        <div class="card-text">
                          <div class="progressbar">
                            <div class="progressbar-content"></div>
                          </div>
                          <div class="task-profil">
                            <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="task-img1" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user8-128x128.jpg') }} " class="task-img2" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user1-128x128.jpg') }} " class="task-img3" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user3-128x128.jpg') }} " class="task-img4" alt="User Image">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-6">
                    <div class="card bg-light mb-3 small-task-card" style="max-width: 18rem;">
                      <div class="card-header small-task-header">Nom du projet</div>
                      <div class="card-body">
                        <h5 class="card-title small-task-title">Tâches éffectués : 10/20</h5>
                        <div class="card-text">
                          <div class="progressbar">
                            <div class="progressbar-content"></div>
                          </div>
                          <div class="task-profil">
                            <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="task-img1" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user8-128x128.jpg') }} " class="task-img2" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user1-128x128.jpg') }} " class="task-img3" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user3-128x128.jpg') }} " class="task-img4" alt="User Image">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-6">
                    <div class="card bg-light mb-3 small-task-card" style="max-width: 18rem;">
                      <div class="card-header small-task-header">Nom du projet</div>
                      <div class="card-body">
                        <h5 class="card-title small-task-title">Tâches éffectués : 10/20</h5>
                        <div class="card-text">
                          <div class="progressbar">
                            <div class="progressbar-content"></div>
                          </div>
                          <div class="task-profil">
                            <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="task-img1" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user8-128x128.jpg') }} " class="task-img2" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user1-128x128.jpg') }} " class="task-img3" alt="User Image">
                            <img src=" {{ asset('styles/admin/dist/img/user3-128x128.jpg') }} " class="task-img4" alt="User Image">
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
          <div class="col-12 col-lg-6">
            <!-- Calendar -->
            <div class="card bg-gradient-secondary calendar-block">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
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
                  To Do List
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
                    <span class="text">Design a nice theme</span>
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
                    <span class="text">Make the theme responsive</span>
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
                    <span class="text">Let theme shine like a star</span>
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
                    <span class="text">Let theme shine like a star</span>
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
        </div>
    </div>
  </section>
</div>
@endsection

@section('script')

@endsection
