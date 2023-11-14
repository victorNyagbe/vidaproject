<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientSpaceController extends Controller
{
    public function index()
    {
        $users = ProjectUser::where('user_mail', session()->get('email'))->get();

        $projects = collect();

        foreach ($users as $user) {

            $projects = $projects->merge(Project::where('project_client', $user->id)->latest()->get());

        }

        // dd($projects);

        // $projects = Project::join('project_users', 'projects.project_client', '=', 'project_users.id')->where('project_users.user_mail', session()->get('email'))->get();
        $types = ProjectType::all();
        $page = 'admin.clientSpace';
        return view('admin.clientSpace.index', compact('page', 'types', 'projects'));
    }

    public function show(Project $project)
    {
        $verify_project = Project::where('id', $project->id)->first();

        if ($verify_project == null) {
            abort('404');
        }

        // $client = ProjectUser::where('user_mail', session()->get('email'))->get();

        // $project_owner = User::where('id', $verify_project->owner_id)->first();

        // $fullName = $project_owner->fullname;

        // dd($fullName);

        $types = ProjectType::all();

        $page = 'admin.clientSpace';
        return view('admin.clientSpace.show', compact('project', 'types', 'page'));
    }
}
