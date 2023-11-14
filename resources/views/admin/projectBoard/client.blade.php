@extends('admin.layouts.project.master')

@section('style')
<link rel="stylesheet" href="{{ asset('styles/admin/client.css') }}">
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content pt-4">
        <div class="container-fluid">
            @include('admin.includes.messageReturned')
            <div class="row">
                <div class="col-12 pb-5">
                    <a href="#" class="name-project">{{ $project->nom }}</a><span class="page-name">/ Client</span>
                    <a href="#!" data-toggle="modal" data-target="#addClient" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Ajouter un client</a>
                </div>
            </div>
            <!-- /.col -->
            <div class="row">
                <div class="col-12">
                    <div class="card bg-secondary">
                        <div class="card-header cardHeader">
                            <h3 class="card-title count-header-title">Client du projet <span class="your-project-name">{{ $project->nom }}</span></h3>
                        </div>
                        <div class="card-body">
                            <div class="row small-card">
                                <div class="col-12 col-md-4">

                                    @if ($client != null)
                                        <!-- Widget: user widget style 1 -->
                                        <div class="card card-widget widget-user shadow">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            <div class="widget-user-header small-card-header">
                                            </div>
                                            <div class="widget-user-image">
                                                {{-- @dd($client->profile) --}}
                                                <img class="img-circle elevation-2" src="{{ $client->profile }}" alt="User Avatar">
                                            </div>
                                            @php
                                                $parts = explode(' ', $client->fullname);
                                                $firstName = $parts[0];
                                                $lastName = $parts[1];
                                            @endphp
                                            <div class="card-footer bg-light p-5">
                                                <div class="row">
                                                    <label for="">NOM : </label>
                                                    <p class="info-client1">{{ $lastName }}</p>
                                                </div>
                                                <div class="row">
                                                    <label for="">PRENOM : </label>
                                                    <p class="info-client">{{ $firstName }}</p>
                                                </div>
                                                <div class="row">
                                                    <label for="">EMAIL : </label>
                                                    <p class="info-client">{{ $client->email }}</p>
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                        </div>
                                        <!-- /.widget-user -->
                                    @else

                                    <h6>Aucune utilisateur ajouté</h6>

                                    @endif

                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addClient" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content bg-secondary">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter un client</h5>
                            <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('admin.projectBoard.sendInvitationForClient',$project) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Saisir le l'adresse email du client">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="typePartner" id="typePartner" value="client">
                            </div>
                            <div class="form-group">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary text-uppercase">Envoyer une demande</button>
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

@endsection
