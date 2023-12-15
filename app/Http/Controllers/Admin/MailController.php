<?php

namespace App\Http\Controllers\Admin;

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

        $page = 'admin.clientSpace';

        return view('admin.clientSpace.email.mail', compact('page', 'project', 'client'));

    }

    public function getInbox(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        $mails = Mail::where('receiver_id', $project->project_client)->where('project_id', $project->id)->where('client_mail_type', 'received')->latest()->get();

        if ($project == null) {
            abort('404');
        }

        return view('admin.clientSpace.email.inboxMail', compact('project', 'mails'));

    }

    public function getNewMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        return view('admin.clientSpace.email.newMail', compact('project'));
    }

    public function createMail(Request $request, Project $project)
    {
        $request->validate([
            'mail_message' => 'required',
            'subject' => 'required'
        ], [
            'mail_message.required' => 'vous devez saisir un message',
            'subject.required' => 'vous devez saisir l\'objet'
        ]);

        $project = Project::where('id', $project->id)->first();

        $filesToBeUploaded = $request->input('filesToBeUploaded');

        $collection = collect($filesToBeUploaded);

        $jsonString = $collection->get('0');

        $filesArray = json_decode($jsonString, true);

        if ($request->hasFile('files')) {

            $mail_created = Mail::create([
                'sender_id' => session()->get('id'),
                'receiver_id' => $project->user->id,
                'project_id' => $project->id,
                'subject' => $request->subject,
                'message' => $request->mail_message,
                'subtitle' => Str::substr($request->descriptionText, 0, 20),
                'dateTime' => now(),
                'type' => 'received',
                'client_mail_type' => 'sent'
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

                        $extension = $fileKeeped->getClientOriginalExtension();

                        $fileType = '';

                        if (in_array($extension, ['jpg', 'jpeg', 'png', 'jfif', 'webp', 'gif'])) {

                            $fileType = 'image';

                        } elseif (in_array($extension, ['doc', 'docx', 'xlsx', 'pptx', 'pdf', 'txt', 'html', 'sql'])) {

                            $fileType = 'document';

                        } elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv', 'avchd', 'WebM', 'flv'])) {

                            $fileType = 'video';

                        } elseif (in_array($extension, ['mp3', 'mid'])) {

                            $fileType = 'audio';

                        } else {

                            return redirect()->back()->with('error', 'Fichier non pris en charge : ' . $fileKeeped->getClientOriginalName());
                        }

                        $fileName = $fileKeeped->getClientOriginalName();

                        Fichier::create([
                            'mail_id' => $mail_created->id,
                            'file' => $fileKeeped->storeAs('mail_' . $fileType, $fileName, 'public'),
                            'type_file' => $fileType,
                        ]);
                    }
                }

            }

        } else {

            Mail::create([
                'sender_id' => session()->get('id'),
                'receiver_id' => $project->user->id,
                'project_id' => $project->id,
                'subject' => $request->subject,
                'message' => $request->mail_message,
                'subtitle' => Str::substr($request->descriptionText, 0, 20),
                'dateTime' => now(),
                'type' => 'received',
                'client_mail_type' => 'sent'
            ]);

        }

        return redirect()->route('admin.clientSpace.email.mail', $project)->with('success', 'Votre Mail a été envoyé!');
    }


    public function getSentMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        $mails = Mail::where('sender_id', session()->get('id'))->where('client_mail_type', 'sent')->where('project_id', $project->id)->latest()->get();

        return view('admin.clientSpace.email.sentMail', compact('project', 'mails'));

    }


    public function createDraftMail(Request $request, $project)
    {
        // Validez et traitez les données du formulaire
        $validatedData = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
            // Ajoutez d'autres règles de validation si nécessaire
        ]);

        // Créez un nouvel enregistrement de courrier électronique en brouillon
        $mail = new Mail([
            'to' => $validatedData['to'],
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
            // Affectez d'autres champs si nécessaire
        ]);

        // Enregistrez le courrier électronique en brouillon dans la base de données
        $mail->save();

        return response()->json(['message' => 'Brouillon enregistré avec succès']);
    }


    // public function createDraftMail(Request $request, Project $project)
    // {
    //     $request->validate([
    //         'mail_message' => 'required',
    //         'subject' => 'required'
    //     ], [
    //         'mail_message.required' => 'vous devez saisir un message',
    //         'subject.required' => 'vous devez saisir l\'objet'
    //     ]);

    //     $project = Project::where('id', $project->id)->first();

    //     $receiver = ProjectUser::where('id', $project->project_client)->first();

    //     if ($project == null) {
    //         abort('404');
    //     }

    //     // $recup = $request->subject;

    //     dd("heloooo brouillon");

    //     Mail::create([
    //         'sender_id' => session()->get('id'),
    //         'receiver_id' => $receiver->id,
    //         'subject' => $request->subject,
    //         'message' => $request->mail_message,
    //         'subtitle' => Str::substr($request->descriptionText, 0, 20),
    //         'dateTime' => now()
    //     ]);

    //     return response()->json(['message' => 'Brouillon enregistré avec succès']);


    //     // return redirect()->route('admin.clientSpace.email.mail', $project)->with('success', 'Votre Mail a été envoyé!');

    // }

    public function getDraftMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        return view('admin.clientSpace.email.draftMail', compact('project'));
    }

    public function getTrashMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort(404);
        }

        $mails = Mail::where(function ($query) use ($project) {
                $query->where('receiver_id', $project->project_client)
                    ->orWhere('sender_id', session()->get('id'));
            })
            ->where('client_mail_type', 'trash')
            ->where('project_id', $project->id)
            ->get();

        return view('admin.clientSpace.email.trashMail', compact('project', 'mails'));
    }


    public function show(Mail $mail, Project $project)
    {
        // $project = Project::where('id', $project->id)->first();

        $client = ProjectUser::where('id', $project->project_client)->first();

        $files = Fichier::where('mail_id', $mail->id)->get();

        if ($project == null) {
            abort('404');
        }

        $mail = Mail::where('id', $mail->id)->first();

        if ($mail == null) {
            abort('404');
        }

        $page = 'admin.clientSpace';

        return view('admin.clientSpace.email.show', compact('page', 'project', 'client', 'mail', 'files'));
    }

    public function goToTrash(Mail $mail, Project $project)
    {
        $verify_mail = Mail::where('id', $mail->id)->first();

        if ($verify_mail == null) {
            abort('404');
        }

        $mail->update([
            'client_mail_type' => 'trash'
        ]);

        return redirect()->back()->with('success', 'Message transféré dans la corbeille');
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
