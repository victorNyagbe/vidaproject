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
                                    <label class="control-label input-label info-title" for="startTime">Nom du projet :</label><span class="info-details">Golfe1</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Type du projet :</label><span class="info-details">Site web</span>
                                </div>
                            </div>                
                        </div>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nom du chef projet :</label><span class="info-details">gomez felix</span>
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
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Date de début du projet :</label><span class="info-details">2/05/2023</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Date de fin du projet :</label><span class="info-details">12/05/2023</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Gestionnaire du projet</legend>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nom :</label><span class="info-details">GOMEZ</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Prénom :</label><span class="info-details">Felix</span>
                                </div>
                            </div>                
                        </div>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Email :</label><span class="info-details">gomezfelix310@gmail.com</span>
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

        <div class="row">
            <div class="col-12">
                <form action="">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Informations personnelles</legend>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Nom :</label><span class="info-details">GOMEZ</span>
                                </div>
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Prénom :</label><span class="info-details">Felix</span>
                                </div>
                            </div>                
                        </div>
                        <div class="control-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="control-label input-label info-title" for="startTime">Email :</label><span class="info-details">gomezfelix310@gmail.com</span>
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
