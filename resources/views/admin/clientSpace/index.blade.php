@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/clientSpace/index.css') }}">
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12 pb-4">
              <h6 href="#" class="name-project">ESPACE CLIENT</h6>
              <h6 class="page-name mt-4"><i class="bi bi-arrow-right"></i> Projets</h6>
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
                <tr>
                  <td>Golfe1</td>
                  <td>Vic</td>
                  <td>Application web</td>
                  <td>02/05/2023</td>
                  <td>12/06/2023</td>
                  <td>
                    <a href="{{ route('admin.clientSpace.show') }}" class="btn btn-info btn-sm {{ $page == 'admin.clientSpace' ? 'active' : '' }}"><i class="bi bi-patch-plus"> Détails</i></a>
                  </td>
                </tr>               
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- <div class="row">
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
                  @foreach ($projects as $project)
                  <tr>
                    <td>{{ $project->nom }}</td>
                    <td>Vic</td>
                    <td>{{ $project->type }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}</td>
                    <td>
                      <a href="{{ route('admin.projectBoard.project.showBoard', $project) }}" class="btn btn-info btn-sm {{ $page == 'admin.project.showBord' ? 'active' : '' }}"><i class="fas fa-eye"></i></a>
                      <a href="{{ route('admin.projectBoard.project.edit', $project) }}" class="btn btn-warning btn-sm {{ $page == 'admin.project' ? 'active' : '' }}"><i class="fas fa-edit"></i></a>
                      <a href="{{ route('admin.project.project.destroy', $project) }}" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce projet ? Cette action est irréversible.');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach                
                </tbody>
              </table>
            </div>
          </div>
        </div> -->

    </div>
  </section>
</div>
@endsection

@section('script')

@endsection
