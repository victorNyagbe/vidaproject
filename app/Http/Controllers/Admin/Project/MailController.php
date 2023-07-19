<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Mail;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function mail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        $client = ProjectUser::where('id', $project->project_client)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.email';

        return view('admin.projectBoard.email.mail', compact('page', 'project', 'client'));
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

        $client = ProjectUser::where('id', $project->project_client)->first();

        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.newMail', compact('project', 'client'));
    }

    public function createMail(Request $request, Project $project)
    {
        $request->validate([
            'mail_message' => 'required',
            'subject' => 'required',
        ], [
            'mail_message.required' => 'vous devez saisir un message',
            'subject.required' => 'vous devez saisir l\'ojet'
        ]);

        $project = Project::where('id', $project->id)->first();

        $receiver = ProjectUser::where('id', $project->project_client)->first();

        if (request('file') == null) {

            Mail::create([
                'sender_id' => session()->get('id'),
                'receiver_id' => $receiver->id,
                'subject' => $request->subject,
                'message' => $request->mail_message,
                'subtitle' => Str::substr($request->descriptionText, 0, 20),
                'dateTime' => now()

            ]);

        }else{

            Mail::create([
                'sender_id' => session()->get('id'),
                'receiver_id' => $receiver->id,
                'subject' => $request->subject,
                'message' => $request->mail_message,
                'subtitle' => Str::substr($request->descriptionText, 0, 20),
                'file' => request('file')->store('mail_files', 'public'),
                'dateTime' => now()

            ]);

        }

        return redirect()->route('admin.projectBoard.email.mail', $project)->with('success', 'Votre Mail a été envoyé!');

    }

    public function getSentMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        // $mails = Mail::where('sender_id', session()->get('id'));

        $mails = Mail::all();

        // $characters = 200;

        // $titre = $mails->subject;

        // for ($i = 0; $i <COUNT($mails); $i++) {

        //     $getTitre = strlen($titre);

        //     dd($getTitre);
        // }

        // $getTitre = strlen($titre);

        // $charactersLeft = $characters - $getTitre;

        // $message = $mails->message;

        // $textToBeReturned = "";

        // if($getTitre == 200) {
        //     $textToBeReturned = $titre . '...';
        // } else if ($getTitre > 200) {
        //     $textToBeReturned = Str::substr($titre, 0, 200). '...';
        // } else {
        //     $getMessage = Str::substr($message, 0, $charactersLeft);

        //     $textToBeReturned = $titre.$getMessage . '...';
        // }

        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.sentMail', compact('project', 'mails'));
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
