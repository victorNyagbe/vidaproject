@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/rapport.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content pt-4">
            <div class="container-fluid">
                @include('admin.includes.messageReturned')
                <div class="row">
                    <div class="col-12 pb-5">
                        <h6 class="project-title">{{ $project->nom }}</h6><span class="page-name">/ Rapport</span>
                        <!-- <a href="#" class="btn btn-primary send-link"><i class="bi bi-send-fill"></i> Envoyer le rapport</a> -->
                        <a href="#" data-toggle="modal" data-target="#showRapport"
                            class="btn btn-primary showRapports-btn"><i class="bi bi-file-earmark-pdf"></i> Vos rapports</a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-8">
                        <form action="{{ route('admin.projectBoard.rapport.store', $project) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Titre du rapport </label>
                                <input type="text" name="title" id="title" value="" class="form-control"
                                    placeholder="Saisir le titre du rapport">
                            </div>
                            <div class="form-group">
                                <label for="montant">Montant du budget </label>
                                <input type="text" name="montant" id="montant" value="" class="form-control"
                                    placeholder="Saisir le montant du budget">
                            </div>
                            <div class="form-group">
                                <label for="stade">Stade du projet</label>
                                <select name="stade" id="stade"
                                    data-placeholder="Choisir le stade d'avancement du projet" class="form-control">
                                    <option value="" selected hidden disabled>Selectionner le niveau de progression du
                                        projet</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->nom }}</option>>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Résumé</label>
                                <textarea name="description" id="description" class="form-control description">
              </textarea>
                            </div>
                            <div class="form-group text-center pt-4 pb-5">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success text-uppercase">Enregistrer</button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- modals of show all rapports -->

                    <div class="modal fade" id="showRapport" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content bg-secondary">
                                <div class="modal-header">
                                    <h5 class="modal-title text-uppercase">Vos Rapports</h5>
                                    <button type="button" class="close" aria-label="close" data-dismiss="modal"
                                        style="outline: 0;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="#" method="">
                                        @forelse ($rapports as $rapport)
                                            <div class="form-row">
                                                <div class="col-11 rapport-title ">{{ $rapport->title }}</div>
                                                <div class="col-1"><a
                                                        href="{{ route('admin.projectBoard.rapport.edit', [$rapport, $project]) }}"
                                                        class="btn btn-info btn-sm {{ $page == 'admin.projectBoard.rapport' ? 'active' : '' }}"><i
                                                            class="fas fa-eye"></i></a></div>
                                            </div>
                                            <hr>
                                        @empty
                                            <div class="form-row">
                                                <div class="col-12 justify-content-center">
                                                    <h6 class="text-center">Aucun rapport enregistré!</h6>
                                                </div>
                                            </div>
                                        @endforelse
                                    </form>
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
    <script src="{{ asset('styles/admin/plugins/summernote/lang/summernote-fr-FR.js') }}"></script>
    <script src="{{ asset('styles/admin/plugins/summernote/lang/summernote-fr-FR.js.map') }}"></script>
    <script>
        $(function() {
            $(document).ready(function() {

                $('#editForm').on('submit', function(e) {
                    const editorCode = $('.description').summernote('code').replace(
                        /<\/?[^>]+(>|$)/g, " ");

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
