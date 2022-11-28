<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function calendar(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.calendar';
        return view('admin.projectBoard.calendar', compact('project', 'page'));
    }
}
