@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/admin/projects/index.css') }}">
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
      @include('admin.includes.messageReturned')
       <div class="row">
          <div class="col-12 pb-5">
              <h6 class="name-project">TOUS VOS PROJETS</h6>
              <a href="#!" data-toggle="modal" data-target="#addProject" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Créer un projet</a>
          </div>
        </div>
        <div class="row">
          <div class="col-12 group-name-block">
            <p class="projects-group-name">
               Projets en tant que gestionnaire de projet
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive text-nowrap table-responsive-md">
              <table class="table bg-secondary">
                <thead>
                  <tr>
                    <th scope="col">Nom du projet</th>
                    <th scope="col">Nombre de Collaborateur</th>
                    <th scope="col">Chef projet</th>
                    <th scope="col">Type de projet</th>
                    <th scope="col">Date de début</th>
                    <th scope="col">Date de finalisation</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  @foreach ($projects as $project)
                  <tr>
                    <td>{{ $project->nom }}</td>
                    <td>5</td>
                    <td>Vic</td>
                    <td>{{ $project->type }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}</td>
                    <td>
                      <a href="{{ route('admin.projectBoard.project.showBoard', $project) }}" class="btn btn-info btn-sm {{ $page == 'admin.project.showBord' ? 'active' : '' }}"><i class="fas fa-eye"></i></a>
                      <a href="{{ route('admin.projectBoard.project.edit', $project) }}" class="btn btn-warning btn-sm {{ $page == 'admin.project' ? 'active' : '' }}"><i class="fas fa-edit"></i></a>
                      <a href="{{ route('admin.project.project.destroy', $project) }}" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce projet ? Cette action est irréversible.');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach                
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="modal fade" id="addProject" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un projet</h5>
                        <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('admin.project.project.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="logo">Logo du projet</label>
                          <input type="file" name="logo" id="logo" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="project_name">Nom du projet</label>
                          <input type="text" name="project_name" id="project_name" class="form-control" placeholder="Saisir le nom du projet">
                        </div>
                        <div class="form-group">
                          <label for="project_type">Type de projet (vous pouvez en choisir plusieurs)</label>
                          <select name="project_type" id="project_type" class="select2 form-control" multiple="multiple" data-placeholder="Choisir le type de projet" style="width: 100%;">
                            @foreach ($types as $type)
                              <option value="{{ $type->id }}">{{ $type->nom }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group checkboxs-form">
                          <label for="checkbox">Quel date voulez-vous renseigner ?</label>
                          <div class="custom-control custom-checkbox first-checkbox">
                            <div class="checkbox-block1">
                              <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                              <label for="customCheckbox1" class="custom-control-label">Date de début</label>
                            </div>
                          </div>
                          <div class="custom-control custom-checkbox second-checkbox">
                            <div class="checkbox-block2">
                              <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2">
                              <label for="customCheckbox2" class="custom-control-label">Date de finalisation</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group start-input">
                          <label for="date_debut">Date de début du projet</label>
                          <input name="date_debut" id="date_debut" placeholder="Select date" type="date" class="form-control">
                        </div>
                        <div class="form-group end-input">
                          <label for="date_fin">Date de fin du projet</label>
                          <input name="date_fin" id="date_fin" placeholder="Select date" type="date" class="form-control">
                        </div>
                        <div class="form-group md-form mb-4 pink-textarea active-pink-textarea">
                          <label for="description">Description de votre projet</label>
                          <textarea name="description" id="form18" class="md-textarea form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                          <div class="d-flex justify-content-center">
                              <button type="submit" class="btn btn-primary text-uppercase">Ajouter le projet</button>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 group-name-block mt-4">
            <p class="projects-group-name">
               Projets en tant que collaborateur
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive text-nowrap table-responsive-md">
              <table class="table bg-secondary">
                <thead>
                  <tr>
                    <th scope="col">Nom du projet</th>
                    <th scope="col">Nombre de Collaborateur</th>
                    <th scope="col">Chef projet</th>
                    <th scope="col">Type de projet</th>
                    <th scope="col">Date de début</th>
                    <th scope="col">Date de finalisation</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  @foreach ($projects as $project)
                  <tr>
                    <td>{{ $project->nom }}</td>
                    <td>5</td>
                    <td>Vic</td>
                    <td>{{ $project->type }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}</td>
                    <td>
                      <a href="{{ route('admin.projectBoard.project.showBoard', $project) }}" class="btn btn-info btn-sm {{ $page == 'admin.project.showBord' ? 'active' : '' }}"><i class="fas fa-eye"></i></a>
                      <a href="{{ route('admin.projectBoard.project.edit', $project) }}" class="btn btn-warning btn-sm {{ $page == 'admin.project' ? 'active' : '' }}"><i class="fas fa-edit"></i></a>
                      <a href="{{ route('admin.project.project.destroy', $project) }}" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce projet ? Cette action est irréversible.');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach                
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
  </section>
</div>
@endsection

@section('script')
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

@endsection
