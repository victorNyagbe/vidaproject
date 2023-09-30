<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Mail;
use App\Models\Fichier;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            'subject.required' => 'vous devez saisir l\'objet'
        ]);

        $project = Project::where('id', $project->id)->first();

        $receiver = ProjectUser::where('id', $project->project_client)->first();

        $filesToBeUploaded = $request->input('filesToBeUploaded');

        $collection = collect($filesToBeUploaded);

        $jsonString = $collection->get('0');

        $filesArray = json_decode($jsonString, true);

        if ($request->hasFile('files')) {

            $mail_created = Mail::create([
                'sender_id' => session()->get('id'),
                'receiver_id' => $receiver->id,
                'subject' => $request->subject,
                'message' => $request->mail_message,
                'subtitle' => Str::substr($request->descriptionText, 0, 20),
                'dateTime' => now()
            ]);

            $filesSelected = $request->file('files');

            if(is_array($filesSelected)) {

                $filesKeeped = [];

                foreach ($filesArray as $fileArray) {

                    foreach ($filesSelected as $fileSelected) {

                        if ($fileArray == $fileSelected->getClientOriginalName()) {

                            if($fileSelected->isValid()) {
                                $filesKeeped[] = $fileSelected;
                            }

                        }

                    }

                }

                foreach ($filesKeeped as $fileKeeped) {

                    if (is_file($fileKeeped)) {

                        if (in_array($fileKeeped->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'jfif', 'webp'])) {

                            Fichier::create([
                                'mail_id' => $mail_created->id,
                                'file' => $fileKeeped->store('mail_images', 'public'),
                                'type_file' => 'image'
                            ]);

                        }
                        elseif(in_array($fileKeeped->getClientOriginalExtension(), ['docx', 'xlsx', 'pptx', 'pdf', 'txt', 'html'])) {

                            Fichier::create([
                                'mail_id' => $mail_created->id,
                                'file' => $fileKeeped->store('mail_docs', 'public'),
                                'type_file' => 'document'
                            ]);

                        }
                        elseif(in_array($fileKeeped->getClientOriginalExtension(), ['mp4'])) {

                            Fichier::create([
                                'mail_id' => $mail_created->id,
                                'file' => $fileKeeped->store('mail_video', 'public'),
                                'type_file' => 'visual'
                            ]);

                        }
                        elseif(in_array($fileKeeped->getClientOriginalExtension(), ['mp3'])) {

                            Fichier::create([
                                'mail_id' => $mail_created->id,
                                'file' => $fileKeeped->store('mail_audio', 'public'),
                                'type_file' => 'voice'
                            ]);

                        } else {

                            return redirect()->back()->with('error', 'Erreur dans les fichiers sélectionnés.');

                        }

                    }

                }

            }

        } else {

            Mail::create([
                'sender_id' => session()->get('id'),
                'receiver_id' => $receiver->id,
                'subject' => $request->subject,
                'message' => $request->mail_message,
                'subtitle' => Str::substr($request->descriptionText, 0, 20),
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

    // public function createDraftMail(Request $request, Project $project)
    // {
    //     d
    // }

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

    public function show(Mail $mail, Project $project)
    {
        // $project = Project::where('id', $project->id)->first();

        $client = ProjectUser::where('id', $project->project_client)->first();

        if ($project == null) {
            abort('404');
        }

        $mail = Mail::where('id', $mail->id)->first();

        if ($mail == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.email';

        return view('admin.projectBoard.email.show', compact('page', 'project', 'client', 'mail'));
    }

    public function destroy(Mail $mail, Project $project)
    {
        $verify_mail = Mail::where('id', $mail->id)->first();

        if ($verify_mail == null) {
            abort('404');
        }

        $old_file = $mail->file;

        $mail->delete();

        if (Storage::disk('public')->exists($old_file)) {
            File::delete('storage/app/public/' . $old_file);
        }

        return redirect()->back()->with('success', 'Opération de suppression réussie');
    }
}
