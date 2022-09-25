@extends('admin.layouts.project.master')

@section('style')
<link rel="stylesheet" href="{{ asset('styles/admin/client.css') }}">
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pb-5">
                <a href="#" class="name-project">Gestion de projet</a><span class="page-name">/ Client</span>
                <a href="#" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Ajouter un client</a>
            </div>
        </div>
        <!-- /.col -->
        <div class="row">
            <div class="col-12">
            <div class="card bg-secondary">
              <div class="card-header cardHeader">
                    Liste des clients de votre projet : Gestion de projet
              </div>
              <div class="card-body">
                    <div class="row small-card">
                        <div class="col-12 col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user shadow">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header small-card-header">
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2" src="{{ asset('styles/admin/dist/img/user1-128x128.jpg') }}" alt="User Avatar">
                                </div>
                                <div class="card-footer bg-light p-4">
                                    <div class="row">
                                        <label for="">NOM : </label>
                                        <p class="info-client1">GOMEZ</p>
                                    </div>
                                    <div class="row">
                                        <label for="">PRENOM : </label>
                                        <p class="info-client">Félix</p>
                                    </div>
                                    <div class="row">
                                        <label for="">PROFESSION : </label>
                                        <p class="info-client">Entrepreneur</p>
                                    </div>
                                    <div class="row">
                                        <label for="">ADRESSE : </label>
                                        <p class="info-client">Agoè-logopé</p>
                                    </div>
                                    <div class="row">
                                        <label for="">CONTACT : </label>
                                        <p class="info-client">+228 90 xx xx xx / 22 xx xx xx xx</p>
                                    </div>
                                    <div class="row">
                                        <label for="">EMAIL : </label>
                                        <p class="info-client">lenom@gmail.com</p>
                                    </div>
                                    <div class="row">
                                        <label for="">STATUT : </label>
                                        <p class="info-client">personnel</p>
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                        <!-- /.col -->
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

@endsection
