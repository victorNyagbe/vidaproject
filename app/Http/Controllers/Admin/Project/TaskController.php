<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'task_title' => 'required',
            'project_user' => 'required|exists:users,id',
        ], [
            'task_title.required' => 'Le titre de la tâche est requise',
            'project_user.required' => 'Veuillez lier la tâche à un collaborateur',
            'project_user.exists' => 'Le collaborateur selectionné est inconnu'
        ]);

        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $ifOwnerProject = Project::where([
            ['owner_id', '=', session()->get('id')],
            ['id', '=', $project->id]
        ])->first();

        if ($ifOwnerProject == null) {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation d\'accéder au panel');
        }

        Task::create([
            'project_id' => $project->id,
            'project_user_id' => $request->project_user,
            'title' => $request->task_title,
            'deadline' => $request->task_date_end,
            'description' => $request->task_description
        ]);

        return redirect()->back()->with('success', 'La tâche a bien été ajoutée avec succès');

    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'task_title' => 'required',
            'project_user' => 'required|exists:users,id',
        ], [
            'task_title.required' => 'Le titre de la tâche est requise',
            'project_user.required' => 'Veuillez lier la tâche à un collaborateur',
            'project_user.exists' => 'Le collaborateur selectionné est inconnu'
        ]);

        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $task = Task::where('id', $task->id)->first();

        if ($task == null) {
            abort('404');
        }

        $ifOwnerProject = Project::where([
            ['owner_id', '=', session()->get('id')],
            ['id', '=', $task->project_id]
        ])->first();

        if ($ifOwnerProject == null) {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation d\'accéder au panel');
        }

        $task->update([
            'project_user_id' => $request->project_user,
            'title' => $request->task_title,
            'deadline' => $request->task_date_end,
            'description' => $request->task_description
        ]);

        return redirect()->back()->with('success', 'La tâche a bien été modifiée avec succès');

    }

    public function updateStatus(Project $project, Task $task, $value)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $task = Task::where('id', $task->id)->first();

        if ($task == null) {
            abort('404');
        }

        $ifOwnerProject = Project::where([
            ['owner_id', '=', session()->get('id')],
            ['id', '=', $task->project_id]
        ])->first();

        if ($ifOwnerProject == null) {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation d\'accéder au panel');
        }

        $task->update([
            'status' => $value
        ]);

        return redirect()->back()->with('success', 'La tâche a bien été modifiée avec succès');
    }

    public function destroy(Task $task)
    {
        $task = Task::where('id', $task->id)->first();

        if ($task == null) {
            abort('404');
        }

        $ifOwnerProject = Project::where([
            ['owner_id', '=', session()->get('id')],
            ['id', '=', $task->project_id]
        ])->first();

        if ($ifOwnerProject == null) {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation d\'accéder au panel');
        }


        $task->delete();

        return redirect()->back()->with('success', 'La tâche a bien été supprimée avec succès');
    }
}
