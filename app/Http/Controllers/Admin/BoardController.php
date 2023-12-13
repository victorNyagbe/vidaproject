<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class BoardController extends Controller
{
    public function board(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $ifOwnerProject = Project::where([
            ['owner_id', '=', session()->get('id')],
            ['id', '=', $project->id]
        ])->first();

        $ifUserIsProjectCollab = ProjectUser::where([
            ['user_id', '=', session()->get('id')],
            ['project_id', '=', $project->id]
        ])->first();

        if ($ifOwnerProject == null && $ifUserIsProjectCollab == null) {
            return redirect()->route('admin.project.project')->with('error', 'Vous n\'avez pas l\'autorisation d\'accéder au panel');
        }

        if ($ifUserIsProjectCollab == null) {
            session()->put('accessLevel', 'Collab');
        }

        if ($ifOwnerProject != null) {
            session()->put('accessLevel', 'Owner');
        }

        $projectUsers = ProjectUser::where([
            ['project_id', '=', $project->id],
            ['status', '=', 1]
        ])->get();

        $userFindArray = [];

        $ownerUser = User::where([
            ['id', '=', $project->owner_id]
        ])->first();

        if ($ownerUser != null) {
            $userFindArray[] = $ownerUser;
        }

        if (count($projectUsers) > 0) {
            foreach ($projectUsers as $projectUser) {
                $user = User::where([
                    ['email', '=', $projectUser->user_mail]
                ])->first();

                if ($user != null) {
                    $userFindArray[] = $user;
                }
            }

            $users = collect($userFindArray);
        } else {
            $users = collect($userFindArray);
        }

        $tasks = Task::where([
            ['project_id', '=', $project->id],
        ])->get();

        $page = 'admin.projectBoard.board';
        return view('admin.board', compact('project', 'page', 'projectUsers', 'users', 'tasks'));
    }
}
