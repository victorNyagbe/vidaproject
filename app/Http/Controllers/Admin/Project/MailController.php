<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function mail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.email';

        return view('admin.projectBoard.email.mail', compact('page', 'project'));
    }

    public function getInbox(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.inboxMail', compact('project'));
    }

    public function getNewMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.newMail', compact('project'));
    }

    public function getSentMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.sentMail', compact('project'));
    }

    public function getDraftMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.draftMail', compact('project'));
    }

    public function getTrashMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.trashMail', compact('project'));
    }
}
