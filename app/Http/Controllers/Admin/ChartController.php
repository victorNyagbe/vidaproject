<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    public function chart(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.charts';
        return view('admin.charts', compact('project', 'page'));
    }

    public function projectChart(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.charts';
        return view('admin.projectBoard.charts', compact('project', 'page'));
    }
}
