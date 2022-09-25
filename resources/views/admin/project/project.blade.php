@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/projects/index.css') }}">
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
       <div class="row">
          <div class="col-12 pb-5">
              <h6 class="name-project">LISTE DE VOS PROJETS</h6>
              <a href="#" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Créer un projet</a>
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
                    <th scope="col">Date de finalisation</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <tr>
                    <td>Gozem</td>
                    <td>5</td>
                    <td>Vic</td>
                    <td>Application mobile</td>
                    <td>02-09-2023</td>
                    <td>
                      <a href="{{ route('admin.project.showBord') }}" class="btn btn-info btn-sm {{ $page == 'admin.project.showBord' ? 'active' : '' }}"><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                      <a href="#" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce membre du conseil ? Cette action est irréversible.');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>Jira</td>
                    <td>6</td>
                    <td>Thornton</td>
                    <td>Application Web</td>
                    <td>09-12-2023</td>
                    <td>
                      <a href="{{ route('admin.project.showBord') }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                      <a href="#" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce membre du conseil ? Cette action est irréversible.');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>Apple</td>
                    <td>4</td>
                    <td>Gordonne</td>
                    <td>Site web</td>
                    <td>10-10-2023</td>
                    <td>
                      <a href="{{ route('admin.project.showBord') }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                      <a href="#" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce membre du conseil ? Cette action est irréversible.');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
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

@endsection
