<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    public function client(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.client';
        return view('admin.client', compact('page', 'project'));
    }

    // public function collaborateur(Project $project)
    // {
    //     $project = Project::where('id', $project->id)->first();

    //     if ($project == null) {
    //         abort('404');
    //     }

    //     $page = 'admin.collaborateur';
    //     return view('admin.collaborateur', compact('project', 'page'));
    // }

    public function collaborateur()
    {


        $page = 'admin.collaborateur';
        return view('admin.collaborateur', compact('page'));
    }
}
