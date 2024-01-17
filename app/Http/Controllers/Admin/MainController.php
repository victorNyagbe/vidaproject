<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Project;
use App\Models\Invitation;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Models\ConnectedSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function home()
    {
        $page = 'admin.home';
        return view('admin.home', compact('page'));
    }

    public function dashboard(Request $request)
    {
        $page = 'admin.dashboard';
        $invitations = Invitation::where('user_id', session()->get('id'))->where('status', 'en_attente')->get();

        $ownerId = session()->get('id');

        $projects = Project::where('owner_id', $ownerId)->get();

        $listProjects = Project::where('owner_id', $ownerId)
            ->latest()
            ->take(4)
            ->get();

        // $getProjectsCollab = ProjectUser::where([
        //     ['user_mail', '=', session()->get('email')],
        //     ['status', '<>', 2],
        //     ['status', '=', 1]
        // ])->latest()->get('project_id');

        // $collabProjectArray = [];

        // if ($getProjectsCollab->count() > 0) {
        //     foreach ($getProjectsCollab as $getProjectCollab) {
        //         $collabProject = Project::where('id', $getProjectCollab->project_id)->first();
        //         $collabProjectArray[] = $collabProject;
        //     }
        //     $projectCollabs = collect($collabProjectArray);
        // } else {
        //     $projectCollabs = collect([]);
        // }

        $getProjectsCollab = ProjectUser::where([
            ['user_mail', '=', session()->get('email')],
            ['status', '<>', 2],
            ['status', '=', 1]
        ])
        ->pluck('project_id'); // Utilisez pluck() pour récupérer uniquement les IDs des projets collaboratifs

        $projectCollabs = Project::whereIn('id', $getProjectsCollab)
            ->latest()
            ->get();

        $listProjectCollabs = $projectCollabs->take(4);

        $listAllProjects = $listProjects->merge($listProjectCollabs)->unique('id')->take(4);

        return view('admin.dashboard', compact('page', 'invitations', 'projects', 'projectCollabs', 'listProjects', 'listProjectCollabs', 'listAllProjects'));
    }

    // Dans votre méthode de contrôleur ou votre logique de service
    public function getUsersConnectedCount()
    {
        $connected_id = session()->get('id');
        $userConnectedProjects = Project::where('owner_id', $connected_id)->get();
        $getConnectedCollabUsers = ProjectUser::where([['user_mail', '=', session()->get('email')], ['status', '=', 1]])->get();

        $userConnectedProjectCollabs = collect();

        foreach ($getConnectedCollabUsers as $collab) {
            $userConnectedProjectCollabs = $userConnectedProjectCollabs->merge(Project::where('id', $collab->project_id)->get());
        }

        $listAllUserConnectedProjects = $userConnectedProjects->merge($userConnectedProjectCollabs)->unique('id');

        $currentUser = User::find(session('id'));

        $connectedUsers = ConnectedSession::where('session_email', '!=', $currentUser->email)->get();

        // Filtrer les utilisateurs connectés en fonction des projets
        // $connectedUsers = $connectedUsers->filter(function ($connectedUser) use ($listAllUserConnectedProjects) {
        //     return $listAllUserConnectedProjects->contains('owner_id', $connectedUser->user_id)
        //         || ProjectUser::where([
        //             ['user_id', $connectedUser->user_id],
        //             // ['project_id', $listAllUserConnectedProjects->pluck('id')],
        //         ])->exists()
        //         || $listAllUserConnectedProjects->contains(function ($project) use ($connectedUser) {
        //             return $project->project_client === $connectedUser->user_id;
        //         });
        // });

        $connectedUsers = $connectedUsers->filter(function ($connectedUser) use ($listAllUserConnectedProjects) {
            return $listAllUserConnectedProjects->contains('owner_id', $connectedUser->user_id)

                || ProjectUser::where([
                    ['user_id', $connectedUser->user_id],
                ])->exists()
                || $listAllUserConnectedProjects->contains('project_client', $connectedUser->user_id);
        });

        // Récupérer les détails des utilisateurs filtrés
        $filteredUsersDetails = User::whereIn('id', $connectedUsers->pluck('user_id'))->get();

        // Compter le nombre d'utilisateurs connectés correspondant à vos critères
        $connectedCount = $filteredUsersDetails->count();

        return $connectedCount;

    }

}
