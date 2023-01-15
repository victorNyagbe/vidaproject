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
        @include('admin.includes.messageReturned')
        <div class="row">
            <div class="col-12 pb-5">
                <h6 class="name-project">{{ $project->nom }}</h6><span class="page-name">/ Bureau</span>
                @if (session()->get('accessLevel') == 'Owner')
                    <a href="#!" data-toggle="modal" data-target="#addTask" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Ajouter une tâche</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <section class="content pb-3">
                    <div class="container-fluid h-100">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive text-wrap">
                                    <table class="table table-bordered table-sm table-valign-middle">
                                        <thead>
                                            <tr>
                                                <th class="taskNumber">N°</th>
                                                <th class="taskTitle">Titre</th>
                                                <th class="taskCollab">CEG</th>
                                                <th class="taskDeadline">DeadLine</th>
                                                <th class="taskStatus">Statut</th>
                                                <th class="taskDesc">Description</th>
                                                <th class="taskAction">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $compteur = 1; ?>
                                            @foreach ($tasks as $task)
                                                <tr>
                                                    <td>{{ $compteur }}</td>
                                                    <td>{{ $task->title }}</td>
                                                    <td>{{ \App\Models\User::where('id', $task->project_user_id)->value('fullname') }}</td>
                                                    <td>
                                                        @if ($task->deadline != null)
                                                            {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') }}
                                                        @else
                                                            Non Limité
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($task->status == 0)
                                                            A FAIRE
                                                        @elseif ($task->status == 1)
                                                            EN COURS
                                                        @else
                                                            TERMINE
                                                        @endif
                                                    </td>
                                                    <td class="desc">{{ \Illuminate\Support\Str::substr($task->description, 0, 55) . '....' }}</td>
                                                    <td>
                                                        @if (session()->get('accessLevel') == 'Owner')
                                                            <div class="btn-group" role="group" aria-label="Button group">
                                                                <a href="#!" data-toggle="modal" data-target="#showTask{{ $task->id }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                                <a href="#" data-toggle="modal" data-target="#editTask{{ $task->id }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                                <a href="{{ route('admin.task.destroy', $task) }}" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette tâche ?')"><i class="fas fa-trash"></i></a>
                                                                <div class="btn-group" role="group">
                                                                    <button id="dropdownId" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                        statut
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                                                                        <a class="dropdown-item" href="{{ route('admin.task.updateStatus', [$project, $task, 0]) }}">A faire</a>
                                                                        <a class="dropdown-item" href="{{ route('admin.task.updateStatus', [$project, $task, 1]) }}">En cours</a>
                                                                        <a class="dropdown-item" href="{{ route('admin.task.updateStatus', [$project, $task, 2]) }}">Terminé</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if (session()->get('accessLevel') == 'Collab')
                                                            <a href="#!" data-toggle="modal" data-target="#showTask{{ $task->id }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                                        @endif
                                                    </td>
                                                </tr>

                                                <div id="showTask{{ $task->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Détail de tâche</h6>
                                                                <button type="button" class="close" aria-label="close" data-dismiss="modal">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body task-show">
                                                                <h4><b>Titre : </b> {{ $task->title }}</h4>
                                                                <h4><b>Date de fin : </b> @if ($task->deadline != null)
                                                                    {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') }}
                                                                @else
                                                                    Non Limité
                                                                @endif</h4>
                                                                <h4><b>Collaborateur en charge : </b> {{ \App\Models\User::where('id', $task->project_user_id)->value('fullname') }}</h4>
                                                                <h4><b>Statut : </b> @if ($task->status == 0) A FAIRE @elseif ($task->status == 1) EN COURS @else TERMINE @endif</h4>
                                                                <h4><b>Description : </b></h4>
                                                                <p>{{ $task->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="editTask{{ $task->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Modifier une tâche</h6>
                                                                <button type="button" class="close" aria-label="close" data-dismiss="modal">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('admin.task.update', [$project, $task]) }}" method="post">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="form-group">
                                                                        <label for="task_title">Titre de tâche: </label>
                                                                        <input type="text" name="task_title" id="task_title" value="{{ $task->title }}" class="form-control" placeholder="Saisir le titre de la tâche...">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="task_date_end">Date de fin de la tâche: </label>
                                                                        <input type="date" name="task_date_end" value="{{ $task->deadline }}" id="task_date_end" class="form-control"s>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="task_description">Description</label>
                                                                        <textarea name="task_description" id="task_description" class="form-control" rows="5" placeholder="Saisir une description à la tâche...">
                                                                            {{ $task->description }}
                                                                        </textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="project_user">Lier un collaborateur à la tâche</label>
                                                                        <select name="project_user" id="project_user" class="form-control">
                                                                            @foreach ($users as $user)
                                                                                <option value="{{ $user->id }}" {{ $user->id == $task->project_user_id }}>{{ $user->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="d-flex justify-content-end">
                                                                            <button type="submit" class="btn btn-sm btn-success text-uppercase">Modifier la tâche</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php $compteur++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="addTask" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Ajouter une tâche</h6>
                                        <button type="button" class="close" aria-label="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.task.store', $project) }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="task_title">Titre de tâche: </label>
                                                <input type="text" name="task_title" id="task_title" class="form-control" placeholder="Saisir le titre de la tâche...">
                                            </div>
                                            <div class="form-group">
                                                <label for="task_date_end">Date de fin de la tâche: </label>
                                                <input type="date" name="task_date_end" id="task_date_end" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="task_description">Description</label>
                                                <textarea name="task_description" id="task_description" class="form-control" rows="5" placeholder="Saisir une description à la tâche..."></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="project_user">Lier un collaborateur à la tâche</label>
                                                <select name="project_user" id="project_user" class="form-control">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-sm btn-success text-uppercase">Ajouter la tâche</button>
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
