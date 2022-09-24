@extends('admin.layouts.project.master')

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
              <h6 class="name-project">Gozem</h6><span class="page-name">/ Diagramme</span>
              <a href="#" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Envoyer</a>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-outline count-card">
              <div class="card-header bg-secondary">
                <h3 class="card-title count-header-title">Diagramme de GANTT</h3>
              </div>
              <div class="card-body bg-secondary">
                <div class="text-center">
                    <div id="chart_div" class="gantt-chart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-outline count-card">
              <div class="card-header bg-secondary">
                <h3 class="card-title count-header-title">Diagramme d'avancement des tâches</h3>
              </div>
              <div class="card-body bg-secondary">
                <div class="text-center">
                    <input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125"
                        value="30" data-width="160" data-height="160" data-fgColor="#c6c46f">

                    <div class="knob-label knob-label2">15 tâches sont encore en cours : <span class="text-motivation">motivons l'équipe! <i class="fas fa-hand-point-right"></i></span>
                       <a href="#" class="happy-btn"><i class="bi bi-emoji-smile"></i></a></div>
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
    <script type="text/javascript" src="{{ asset('styles/admin/plugins/chart.js/gstatic.js') }}"></script>
    <script type="text/javascript">

    // gantt chart

    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('string', 'Resource');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      data.addRows([
        ['Research', 'Mise au point ', null,
         new Date(2015, 0, 1), new Date(2015, 0, 5), null,  100,  null],
        ['Write', 'Créer le logiciel', 'write',
         null, new Date(2015, 0, 9), daysToMilliseconds(3), 25, 'Research,Outline'],
        ['Cite', 'mise en developpement', 'write',
         null, new Date(2015, 0, 7), daysToMilliseconds(1), 20, 'Research'],
        ['Complete', 'mise en ligne du projet', 'complete',
         null, new Date(2015, 0, 10), daysToMilliseconds(1), 0, 'Cite,Write'],
        ['Outline', 'Période test', 'write',
         null, new Date(2015, 0, 6), daysToMilliseconds(1), 100, 'Research']
      ]);

      var options = {
        height: 275
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

      chart.draw(data, options);
    }


    $(function () {
    /* jQueryKnob */

      $('.knob').knob({
        /*change : function (value) {
        //console.log("change : " + value);
        },
        release : function (value) {
        console.log("release : " + value);
        },
        cancel : function () {
        console.log("cancel : " + this.value);
        },*/
          draw: function () 
          {

              // "tron" case
              if (this.$.data('skin') == 'tron') {

                  var a   = this.angle(this.cv)  // Angle
                      ,
                      sa  = this.startAngle          // Previous start angle
                      ,
                      sat = this.startAngle         // Start angle
                      ,
                      ea                            // Previous end angle
                      ,
                      eat = sat + a                 // End angle
                      ,
                      r   = true

                  this.g.lineWidth = this.lineWidth

                  this.o.cursor
                  && (sat = eat - 0.3)
                  && (eat = eat + 0.3)

                  if (this.o.displayPrevious) {
                      ea = this.startAngle + this.angle(this.value)
                      this.o.cursor
                      && (sa = ea - 0.3)
                      && (ea = ea + 0.3)
                      this.g.beginPath()
                      this.g.strokeStyle = this.previousColor
                      this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                      this.g.stroke()
                  }

                  this.g.beginPath()
                  this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                  this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                  this.g.stroke()

                  this.g.lineWidth = 2
                  this.g.beginPath()
                  this.g.strokeStyle = this.o.fgColor
                  this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
                  this.g.stroke()

                  return false
              }
          }
      })
    })
    /* END JQUERY KNOB */
    </script>
@endsection