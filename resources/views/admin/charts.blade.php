@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/charts.css') }}">
@endsection

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
       <div class="row">
          <div class="col-12 pb-5">
              <h6 class="name-project">DIAGRAMMES</h6>
              <a href="#" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Envoyer</a>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-outline count-card">
              <div class="card-header bg-secondary">
                <h3 class="card-title count-header-title">Diagramme statistique des projets</h3>
              </div>
              <div class="card-body bg-secondary">
                <div class="text-center">
                  <div id="piechart" class="pie-chart"></div>
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
    <script type="text/javascript" src="{{ asset('styles/admin/plugins/chart.js/googleCharts.js') }}"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Activities progress'],
          ['Projets en cours',     11],
          ['Projets suspendus',      7],
          ['Projets réalisés', 6]
        ]);

        var options = {
          title: 'Bilan de vos projets'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
@endsection