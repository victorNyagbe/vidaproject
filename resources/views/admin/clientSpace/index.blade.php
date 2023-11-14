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
                @forelse ($projects as $project)
                <tr>
                  <td>{{ $project->nom }}</td>
                  <td>{{ $project->user->fullname }}</td>
                  <td>|
                    {{-- @dd($project->project_types) --}}
                        @foreach ($project->project_types as $project_type)
                            {{ $project_type->nom . ' |' }}
                        @endforeach
                  </td>
                  @if ( ($project->date_debut && $project->date_fin) != null)
                    <td>{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->date_fin)->format('d-m-Y') }}</td>
                  @elseif ($project->date_debut != null)
                    <td>{{ \Carbon\Carbon::parse($project->date_debut)->format('d-m-Y') }}</td>
                    <td>Aucun</td>
                  @else
                  <td>Aucune</td>
                  <td>Aucune</td>
                  @endif
                  <td>
                    <a href="{{ route('admin.clientSpace.show', $project) }}" class="btn btn-info btn-sm {{ $page == 'admin.clientSpace' ? 'active' : '' }}"><i class="bi bi-patch-plus"> Détails</i></a>
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

@endsection
