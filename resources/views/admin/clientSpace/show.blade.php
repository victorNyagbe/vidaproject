@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/clientSpace/show.css') }}">
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pb-4">
                <h6 class="name-project">ESPACE CLIENT</h6>
                <div class="mt-4">
                    <a href="{{ route('admin.clientSpace.index') }}" class="link" ><i class="bi bi-arrow-right"></i> Projets</a><span class="page-name">/ Projet</span>
                    <a href="{{ route('admin.clientSpace.email.mail', $project) }}" class="btn btn-info mail-btn {{ $page == 'admin.clientSpace' ? 'active' : '' }}"><i class="bi bi-envelope-exclamation"></i> Boîte de messagerie</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Informations du projet</legend>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nom du projet :</label><span class="info-details">{{ $project->nom }}</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Type du projet :</label><span class="info-details">|
                                        @foreach ($project->project_types as $project_type)
                                            {{ $project_type->nom . ' |' }}
                                        @endforeach</span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nom du chef projet :</label><span class="info-details">{{ $project->user->fullname }}</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Stade d'avancement du projet :</label><span class="info-details">finalisé</span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nombre de tâche :</label><span class="info-details">10</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nombre de tâche finalisé :</label><span class="info-details">10</span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-row">
                                @if ( ($project->date_debut && $project->date_fin) != null)
                                    <div class="col-6">
                                        <label class="control-label input-label info-title" for="startTime">Date de début du projet :</label><span class="info-details">{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}</span>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label input-label info-title" for="startTime">Date de fin du projet :</label><span class="info-details">{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}</span>
                                    </div>
                                @elseif ($project->date_debut != null)
                                    <div class="col-6">
                                        <label class="control-label input-label info-title" for="startTime">Date de début du projet :</label><span class="info-details">{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}</span>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label input-label info-title" for="startTime">Date de fin du projet :</label><span class="info-details">Aucune</span>
                                    </div>
                                @else
                                    <div class="col-6">
                                        <label class="control-label input-label info-title" for="startTime">Date de début du projet :</label><span class="info-details">Aucune</span>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label input-label info-title" for="startTime">Date de fin du projet :</label><span class="info-details">Aucune</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        @php
            $parts = explode(' ', $project->user->fullname);
            $firstName = $parts[0];
            $lastName = $parts[1];
        @endphp

        <div class="row">
            <div class="col-12">
                <form action="">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Gestionnaire du projet</legend>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nom :</label><span class="info-details">{{ $lastName }}</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Prénom :</label><span class="info-details">{{ $firstName }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Email :</label><span class="info-details">{{ $project->user->email }}</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Téléphone :</label><span class="info-details">+228 90 XX XX XX</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        @php
            $parts = explode(' ', session()->get('fullname'));
            $firstName = $parts[0];
            $lastName = $parts[1];
        @endphp

        <div class="row">
            <div class="col-12">
                <form action="">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Informations personnelles</legend>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nom :</label><span class="info-details">{{ $lastName }}</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Prénom :</label><span class="info-details">{{ $firstName }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Email :</label><span class="info-details">{{ session()->get('email') }}</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nombre de projet :</label><span class="info-details">15</span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Projets en cours :</label><span class="info-details">5</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Projets finalisés :</label><span class="info-details">10</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
  </section>
</div>
@endsection

@section('script')

@endsection
