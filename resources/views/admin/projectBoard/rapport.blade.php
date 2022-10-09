@extends('admin.layouts.project.master')

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/admin/rapport.css') }}">
@endsection

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12 pb-5">
              <h6 class="name-project">Gozem</h6><span class="page-name">/ Rapport</span>
              <a href="#" class="add-link"><i class="bi bi-send-fill"></i> Envoyer le rapport</a>
          </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-8">
          <form action="" method="" enctype="" id="createForm">
            <div class="form-group">
              <label for="title">Titre du projet </label>
              <input type="text" name="title" id="title" value="" class="form-control" placeholder="Saisir le titre du projet">
            </div>
            <div class="form-group">
              <label for="duration">Durée du projet </label>
              <input type="text" name="duration" id="duration" value="" class="form-control" placeholder="Saisir la durée du projet">
            </div>
            <div class="form-group">
              <label for="project_key">Clée du projet </label>
              <input type="text" name="project_key" id="project_key" value="" class="form-control" placeholder="Saisir la clée du projet">
            </div>
            <div class="form-group">
              <label for="date_debut">Date de Début </label>
              <input type="text" name="date_debut" id="date_debut" value="" class="form-control" placeholder="Saisir la date de début">
            </div>
            <div class="form-group">
              <label for="date_fin">Date de fin </label>
              <input type="text" name="date_fin" id="date_fin" value="" class="form-control" placeholder="Saisir la date de fin">
            </div>
            <div class="form-group">
              <label for="montant">Montant du budget </label>
              <input type="text" name="montant" id="montant" value="" class="form-control" placeholder="Saisir le montant du budget">
            </div>
            <div class="form-group">
              <label for="stade">Stade du projet</label>
              <select name="stade" id="stade" class="form-control">
                <option value="">Selectionner le niveau de progression du projet</option>
                <option value="">Stade de pré-amorçage</option>
                <option value="">Stade d'amorçage</option>
                <option value="">Stade de croissance</option>
                <option value="">phase de finalisation</option>
              </select>
            </div>
            <div class="form-group">
              <label for="description">Résumé</label>
              <textarea name="description" id="description" class="form-control description">
              </textarea>
            </div>
            
            <div class="form-group text-center pt-4 pb-5">
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success text-uppercase">valider</button>
              </div>
            </div>
          </form>
        </div>   
      </div>
    </div>
  </section>
</div>
    
@endsection

@section('script')

<script src="{{ asset('styles/admin/plugins/summernote/lang/summernote-fr-FR.js') }}"></script>
<script src="{{ asset('styles/admin/plugins/summernote/lang/summernote-fr-FR.js.map') }}"></script>
<script>
  $(function () {
    $(document).ready(function () {

      $('#editForm').on('submit', function(e) {
        const editorCode = $('.description').summernote('code').replace(/<\/?[^>]+(>|$)/g, " ");

        $('#descriptionText').val(editorCode);
      });

      $('#description').summernote({
        lang: 'fr-FR',
        minHeight: 400,
        tabsize: 2,
        placeholder: 'Veuillez rensigner le texte ici...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']]
        ]
      });
    });
  });
</script>

@endsection