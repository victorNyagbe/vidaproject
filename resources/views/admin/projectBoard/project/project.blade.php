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
                        {{-- <a href="#!" data-toggle="modal" data-target="#addProject" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Créer un projet</a> --}}
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
                                    @foreach ($other_projects as $project)
                                        <tr>
                                            <td>{{ $project->nom }}</td>
                                            <td>{{ \App\Models\ProjectUser::where([['project_id', '=', $project->id], ['status', '=', 1]])->count() }}
                                            </td>
                                            <td>{{ $project->user->fullname }}</td>
                                            <td>|
                                                @foreach ($project->project_types as $project_type)
                                                    {{ $project_type->nom . ' |' }}
                                                @endforeach
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.projectBoard.project.showBoard', $project) }}"
                                                    class="btn btn-info btn-sm {{ $page == 'admin.projectBoard.project.showBoard' ? 'active' : '' }}"><i
                                                        class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.project.edit', $project) }}"
                                                    class="btn btn-warning btn-sm {{ $page == 'admin.project' ? 'active' : '' }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.project.project.destroy', $project) }}"
                                                    onclick="return confirm('Êtes-vous certain de vouloir supprimer ce projet ? Cette action est irréversible.');"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                        <th scope="col">Chef projet</th>
                                        <th scope="col">Type de projet</th>
                                        <th scope="col">Date de début</th>
                                        <th scope="col">Date de finalisation</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @forelse ($projectCollabs as $project)
                                        <tr>
                                            <td>{{ $project->nom }}</td>
                                            <td>{{ $project->user->fullname }}</td>
                                            <td>|
                                                @foreach ($project->project_types as $project_type)
                                                    {{ $project_type->nom . ' |' }}
                                                @endforeach
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.projectBoard.project.showBoard', $project) }}"
                                                    class="btn btn-info btn-sm {{ $page == 'admin.project.showBord' ? 'active' : '' }}"><i
                                                        class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.projectBoard.project.edit', $project) }}"
                                                    class="btn btn-warning btn-sm {{ $page == 'admin.project' ? 'active' : '' }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.project.project.destroy', $project) }}"
                                                    onclick="return confirm('Êtes-vous certain de vouloir supprimer ce projet ? Cette action est irréversible.');"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
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
        </section>
    </div>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('styles/admin/plugins/select2/js/select2.full.js') }}"></script>
    <script src="{{ asset('styles/admin/plugins/select2/js/select2.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })
    </script>
@endsection
