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
                        <a href="{{ route('admin.projectBoard.rapport.index', $project) }}"
                            class="name-project">Rapport</a><span class="page-name">/ Détails</span>

                        @if (session()->get('accessLevel') == 'Owner' || session()->get('id') == $rapport->user_id)
                            <form action="{{ route('admin.projectBoard.rapport.destroy', $rapport) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-danger send-link"
                                    onclick="return confirm('Êtes-vous certain de vouloir supprimer ce rapport ? Cette action est irréversible.');"><i
                                        class="bi bi-trash-fill"></i> Supprimer</button>
                            </form>
                        @endif

                        <form action="{{ route('admin.projectBoard.rapport.downloadPdf', $rapport) }}" method="post"
                            target="_blank">
                            @csrf
                            <button type="submit" class="btn btn-primary show-btn"><i
                                    class="bi bi-file-earmark-arrow-down"></i> Télécharger</button>
                        </form>
                        <!-- <form action="{{ route('admin.projectBoard.rapport.viewPdf') }}" method="post" target="_blank">
                                                                                    @csrf
                                                                                    <button type="submit" class="btn btn-warning show-btn"><i class="bi bi-file-earmark-pdf"></i> Voir en PDF</button>
                                                                                  </form> -->
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-8 pb-5">
                        <form action="" method="" enctype="">
                            <div class="form-row">
                                <div class="col-4 info-title">Titre :</div>
                                <div class="col-8 info-detail">{{ $rapport->title }}</div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-4 info-title">Nom du projet :</div>
                                <div class="col-8 info-detail">{{ $project->nom }}</div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-4 info-title">Nom du chef projet :</div>
                                <div class="col-8 info-detail">{{ $project->user->fullname }}</div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-4 info-title">Numéro du projet :</div>
                                <div class="col-8 info-detail">{{ $rapport->key }}</div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-4 info-title">Date de début :</div>
                                <div class="col-8 info-detail">
                                    {{ \Carbon\Carbon::parse($rapport->date_debut)->format('d-m-Y') }}</div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-4 info-title">Date de fin :</div>
                                <div class="col-8 info-detail">
                                    {{ \Carbon\Carbon::parse($rapport->date_fin)->format('d-m-Y') }}</div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-4 info-title">Montant du budget :</div>
                                <div class="col-8 info-detail">{{ $rapport->budget }}</div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-4 info-title">Stade du projet :</div>
                                <div class="col-8 info-detail">{{ $level->nom }}</div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-4 info-title">Publié le :</div>
                                <div class="col-8 info-detail">
                                    {{ \Carbon\Carbon::parse($rapport->created_at)->format('d-m-Y') }}</div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-12 info-title">Résumé :</div>
                                <div class="col-12 info-description">{{ $rapport->resume }}</div>
                            </div>
                            <hr>
                        </form>
                    </div>

                    <!-- modals of show all rapports -->

                    <!-- <div class="modal fade" id="showRapport" role="dialog">
                                                                              <div class="modal-dialog modal-lg" role="document">
                                                                                  <div class="modal-content bg-secondary">
                                                                                      <div class="modal-header">
                                                                                          <h5 class="modal-title text-uppercase">Vos Rapports</h5>
                                                                                          <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                                                                                              <span aria-hidden="true">&times;</span>
                                                                                          </button>
                                                                                      </div>
                                                                                      <div class="modal-body">
                                                                                        <form action="#" method="">
                                                                                          <div class="form-row">
                                                                                            <div class="col-11 rapport-title ">rapport de l'année 2021-2022</div>
                                                                                            <div class="col-1"><a href="{{-- route('admin.project.showBord') --}}" class="btn btn-info btn-sm {{-- $page=='admin.project.showBord'?'active':'' --}}"><i class="fas fa-eye"></i></a></div>
                                                                                          </div>
                                                                                        </form>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                            </div> -->

                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <h6>Rédigé par : {{ $user->fullname }}</h6>
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
