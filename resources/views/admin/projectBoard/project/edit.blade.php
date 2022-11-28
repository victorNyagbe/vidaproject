@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/admin/projects/projectUpdate.css') }}">
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
      @include('admin.includes.messageReturned')
      <div class="row">
        <div class="col-12 pb-5">
            <h6 class="page-title">Kozah 3</h6><span>/ détails</span>
            <a href="{{ route('admin.project.edit.destroy', $project) }}" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce projet ? Cette action est irréversible.');"  class="btn btn-danger delete-link"><i class="fas fa-trash-alt"></i> <b>Supprimer</b></a>
        </div>
      </div>
      <div class="row card-container">
        <div class="col-12 col-lg-10">
          <div class="card bg-gradient-light">
            <div class="card-header">
              <div class="logo-profil">
                <div class="logo-container">
                  <img src=" {{ asset('storage/app/public/' . $project->logo) }} " class="project-logo" alt="logo">
                </div>
              </div>
              <!-- <div class="logo-update-btn">
                <a href="#!" class="btn btn-gradient-light"><i class="fas fa-edit"></i> Changer le logo</a>
              </div> -->
            </div>
            <div class="card-body">
              <form action="{{ route('admin.project.update', $project) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                  <label for="logo">Logo du projet</label>
                  <input type="file" name="logo" id="logo" class="form-control">
                </div>
                <div class="form-group">
                  <label for="project_name">Nom du projet</label>
                  <input type="text" name="project_name" id="project_name" class="form-control" value="{{ $project->nom }}" placeholder="Saisir le nom du projet">
                </div>
                <div class="form-group">
                  <label for="project_type">Type de projet (vous pouvez en choisir plusieurs)</label>
                  <select name="project_type" id="project_type" class="select2 form-control" multiple="multiple" value="{{ $project->type }}" data-placeholder="Choisir le type de projet" style="width: 100%;">
                      @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->nom }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="project-manager">Chef de projet</label>
                  <select name="project-manager" id="project-manager" class="form-control">
                    <option value="" disabled>Choisir le chef de projet</option>
                    <option value="1">gomez felix</option>
                    <option value="2">john sena</option>
                  </select>
                </div>
                <div class="form-group start-input">
                  <label for="date_debut">Date de début du projet</label>
                  <input name="date_debut" id="date_debut" value="{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}" placeholder="Select date" type="date" class="form-control">
                </div>
                <div class="form-group end-input">
                  <label for="date_fin">Date de fin du projet</label>
                  <input name="date_fin" id="date_fin" value="{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}" placeholder="Select date" type="date" class="form-control">
                </div>
                <div class="form-group md-form mb-4 pink-textarea active-pink-textarea">
                  <label for="description">Description de votre projet</label>
                  <textarea name="description" id="form18" class="md-textarea form-control" rows="3" placeholder="Saisir la description de votre projet ...">{{ $project->description }}</textarea>
                </div>
                <div class="form-group">
                  <label for="statut">Statut du projet</label>
                  <select name="statut" id="statut" value="{{ $project->status }}" class="form-control">
                    <option value="" selected hidden disabled>Selectionner le statut actuel de votre projet</option>
                    @foreach($statuses as $status)
                      <option value="{{ $status->id }}">{{ $status->nom }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary text-uppercase">Modifier</button>
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
