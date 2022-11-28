<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function collaborateur()
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.collaborateur';
        return view('admin.collaborateur', compact('project', 'page'));
    }
}
