<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function chat(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.message';
        return view('admin.projectBoard.message.chat', compact('project', 'page'));
    }
}
