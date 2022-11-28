@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/board.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        /* #droppable: {height: 10vh;}
        #droppable:hover { height: 20vh; } */
        .deplacer: { height: 20vh; }
  </style>
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pb-5">
                <h6 class="name-project">{{ $project->nom }}</h6><span class="page-name">/ Bureau</span>
                <a href="#" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Ajouter un tableau</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <section class="content pb-3">
                    <div class="container-fluid h-100">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="card card-warning board-card">
                                    <div class="card-header">
                                        <h3 class="card-title board-card-title">
                                        LISTE TÂCHES
                                        </h3>
                                        <div class="board-card-icon">
                                            <a href="#" class="add-task">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body bg-secondary" id="card-body">
                                        <div id="external-events">
                                            <div class="card card-warning card-outline collapsed-card external-event " id="draggable">
                                                <div class="card-header bg-light" id="headingOne">
                                                    <div class="small-card-title-block">
                                                        <h5 class="card-title small-card-title">Création du module</h5>
                                                    </div>
                                                    <hr>
                                                    <div class="card-tools">
                                                        <a href="#" class="btn btn-tool">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                            <i class="bi bi-chat-left-dots"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-tool">
                                                            <i class="bi bi-x-lg"></i>
                                                        </a>
                                                        <!-- <i class="fas fa-plus signe" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"></i> -->
                                                    </div>
                                                </div>
                                                <div class="card-body bg-light">
                                                    <h6 class="text-justify text-secondary">Création du module :</h6>
                                                    <p>
                                                        Commentaire
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-light card-outline">
                                            <div class="card-header addTask-btn" data-toggle="modal" data-target="#addTaskList">
                                                <h5 class="card-title small-card-title">Nouvelle tâche</h5>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool text-light">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <!-- <div class="input-group">
                                                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                                    <div class="input-group-append">
                                                    <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal fade" id="addTaskLis" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content bg-secondary">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-uppercase">Ajouter une tâche</h5>
                                                <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="pb-4 text-dark text-uppercase">Liste des tâches</h6>
                                                <form action="#" method="">
                                                    <div class="form-group">
                                                        <label for="taskTitle">Titre de la tâche</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="taskNote">Commentaire</label>
                                                        <textarea name="note" id="note" class="form-control" placeholder="Veuillez laisser un commentaire"></textarea>
                                                    </div>
                                                    <div class="form-group text-center pt-4 pb-3">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-success text-uppercase">Ajouter la tâche</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card card-primary board-card">
                                    <div class="card-header">
                                        <h3 class="card-title board-card-title">
                                        À FAIRE
                                        </h3>
                                        <div class="board-card-icon">
                                            <a href="#">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body bg-secondary">
                                        <div id="external-events">
                                            <div class="card card-primary card-outline collapsed-card external-event">
                                                <div class="card-header bg-light " id="headingTwo ">  
                                                    <div class="small-card-title-block">
                                                        <h5 class="card-title small-card-title">1er solution</h5>
                                                    </div>
                                                    <hr>
                                                    <div class="card-tools">
                                                        <a href="#" class="btn btn-tool">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                            <i class="bi bi-chat-left-dots"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-tool">
                                                            <i class="bi bi-x-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="card-body bg-light">
                                                    <h6 class="text-justify text-secondary">1er solution :</h6>
                                                    <p>
                                                        Commentaire
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-light card-outline">
                                            <div class="card-header addTask-btn" data-toggle="modal" data-target="#addTaskTodo">
                                                <h5 class="card-title small-card-title">Nouvelle tâche</h5>
                                                    <div class="card-tools">
                                                    <button type="button" class="btn btn-tool text-light">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal fade" id="addTaskTodo" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content bg-secondary">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-uppercase">Ajouter une tâche</h5>
                                                <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="pb-4 text-dark text-uppercase">À FAIRE</h6>
                                                <form action="#" method="">
                                                    <div class="form-group">
                                                        <label for="taskTitle">Titre de la tâche</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="taskNote">Commentaire</label>
                                                        <textarea name="note" id="note" class="form-control" placeholder="Veuillez laisser un commentaire"></textarea>
                                                    </div>
                                                    <div class="form-group text-center pt-4 pb-3">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-success text-uppercase">Ajouter la tâche</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card card-default board-card">
                                    <div class="card-header bg-info">
                                        <h3 class="card-title small-card-title">
                                        EN COURS
                                        </h3>
                                        <div class="board-card-icon">
                                            <a href="#">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body bg-secondary">
                                        <div class="accordion" id="accordionThree">
                                            <div id="external-events">
                                                <div class="card card-info card-outline collapsed-card external-event">
                                                    <div class="card-header bg-light">
                                                        <div class="small-card-title-block">
                                                            <h5 class="card-title small-card-title">Créer le dépôt</h5>
                                                        </div>
                                                        <hr>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                                <i class="bi bi-chat-left-dots"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="bi bi-x-lg"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body bg-light">
                                                        <h6 class="text-justify text-secondary">Créer le dépôt :</h6>
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-light card-outline">
                                            <div class="card-header addTask-btn" data-toggle="modal" data-target="#addTaskLoad">
                                                <h5 class="card-title small-card-title">Nouvelle tâche</h5>
                                                    <div class="card-tools">
                                                    <button type="button" class="btn btn-tool text-light">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal fade" id="addTaskLoad" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content bg-secondary">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-uppercase">Ajouter une tâche</h5>
                                                <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="pb-4 text-dark text-uppercase">En COURS</h6>
                                                <form action="#" method="">
                                                    <div class="form-group">
                                                        <label for="taskTitle">Titre de la tâche</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="taskNote">Commentaire</label>
                                                        <textarea name="note" id="note" class="form-control" placeholder="Veuillez laisser un commentaire"></textarea>
                                                    </div>
                                                    <div class="form-group text-center pt-4 pb-3">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-success text-uppercase">Ajouter la tâche</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card card-success board-card">
                                    <div class="card-header">
                                        <h3 class="card-title board-card-title">
                                        TERMINÉ
                                        </h3>
                                        <div class="board-card-icon">
                                            <a href="#"><i class="bi bi-x-circle"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body bg-secondary">
                                        <div class="accordion" id="accordionFour">
                                            <div id="external-events">
                                                <div class="card card-success card-outline collapsed-card external-event">
                                                    <div class="card-header bg-light">
                                                        <div class="small-card-title-block">
                                                            <h5 class="card-title small-card-title">Créer le logo</h5>
                                                        </div>
                                                        <hr>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                                <i class="bi bi-chat-left-dots"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="bi bi-x-lg"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body bg-light">
                                                        <h6 class="text-justify text-secondary">Créer le logo :</h6>
                                                        <p>
                                                            Commentaire
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-light card-outline">
                                            <div class="card-header addTask-btn" data-toggle="modal" data-target="#addTaskEnd">
                                                <h5 class="card-title small-card-title">Nouvelle tâche</h5>
                                                    <div class="card-tools">
                                                    <button type="button" class="btn btn-tool text-light">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal fade" id="addTaskEnd" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content bg-secondary">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-uppercase">Ajouter une tâche</h5>
                                                <button type="button" class="close" aria-label="close" data-dismiss="modal" style="outline: 0;">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="pb-4 text-dark text-uppercase">TERMINÉ</h6>
                                                <form action="#" method="">
                                                    <div class="form-group">
                                                        <label for="taskTitle">Titre de la tâche</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="taskNote">Commentaire</label>
                                                        <textarea name="note" id="note" class="form-control" placeholder="Veuillez laisser un commentaire"></textarea>
                                                    </div>
                                                    <div class="form-group text-center pt-4 pb-3">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-success text-uppercase">Ajouter la tâche</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> 
                    </div>
                </section>
            </div>
        </div>
    </div>
  </section>
</div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        // $(function () {

        //     /* initialize the external events
        //     -----------------------------------------------------------------*/
        //     function ini_events(ele) {
        //     ele.each(function () {

        //         // create an Event Object (https://fullcalendar.io/docs/event-object)
        //         // it doesn't need to have a start or end
        //         var eventObject = {
        //         title: $.trim($(this).text()) // use the element's text as the event title
        //         }

        //         // store the Event Object in the DOM element so we can get to it later
        //         $(this).data('eventObject', eventObject)

        //         // make the event draggable using jQuery UI
        //         $(this).draggable({
        //         zIndex        : 1070,
        //         revert        : true, // will cause the event to go back to its
        //         revertDuration: 300  //  original position after the drag
        //         })

        //     })
        //     }

        //     ini_events($('#external-events div.external-event'))

        //     $('#add-new-event').click(function (e) {
        //     e.preventDefault()
        //     // Get value and make sure it is not null
        //     var val = $('#new-event').val()
        //     if (val.length == 0) {
        //         return
        //     }

          
        //     // Create events
        //     var event = $('<div />')
        //     event.addClass('external-event')
        //     event.text(val)
        //     $('#external-events').prepend(event)

        //     // Add draggable funtionality
        //     ini_events(event)

        //     // Remove event from text input
        //     $('#new-event').val('')
        //     })
        // })

         $( function() {
            $( "#draggable" ).draggable({
                zIndex        : 1070,
                revert        : true, // will cause the event to go back to its
                revertDuration: 300  //  original position after the drag
            });
            $( "#droppable" ).droppable({
            drop: function( event, ui ) {
                $( this )
                .addClass( "deplacer" )
                .find( "<div/>" )
                    
            }
            });
        } );
    </script>
@endsection
