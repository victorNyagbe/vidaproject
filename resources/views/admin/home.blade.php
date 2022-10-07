@extends('admin.layouts.master')

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/admin/home.css') }}">
  <style>
    .custom-img-fluid {
      width: 80%;
    }
  </style>
@endsection

@section('content')

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center pt-5">
        <div class="col-12">
            <div class="dashboard-logo mb-4">
              <center><img src="{{ asset('assets/logos/goproject-03.png') }}" alt="" class="img-fluid custom-img-fluid"></center>
            </div>
            <h6 class="text-uppercase text-center text-secondary font-weight-bold">Espace de gestion projets</h3>
            <!-- <h6 class="mt-4 text-center">Bienvenue, {{ session()->get('name') }}</h6> -->
        </div>
      </div>
    </div>
  </section>
</div>
    
@endsection

@section('script')

@endsection