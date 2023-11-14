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

        $mails = Mail::where('receiver_id', session()->get('id'))->where('project_id', $project->id)->latest()->get();

        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.inboxMail', compact('project', 'mails'));
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
            'subject' => 'required'
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
                'project_id' => $project->id,
                'subject' => $request->subject,
                'message' => $request->mail_message,
                'subtitle' => Str::substr($request->descriptionText, 0, 20),
                'dateTime' => now(),
                'type' => 'sent'
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

                // foreach ($filesKeeped as $fileKeeped) {

                //     if (is_file($fileKeeped)) {

                //         if (in_array($fileKeeped->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'jfif', 'webp'])) {

                //             Fichier::create([
                //                 'mail_id' => $mail_created->id,
                //                 'file' => $fileKeeped->store('mail_images', 'public'),
                //                 'type_file' => 'image'
                //             ]);

                //         }
                //         elseif(in_array($fileKeeped->getClientOriginalExtension(), ['docx', 'xlsx', 'pptx', 'pdf', 'txt', 'html'])) {

                //             $fileName = $fileKeeped->getClientOriginalName();

                //             Fichier::create([
                //                 'mail_id' => $mail_created->id,
                //                 'file' => $fileKeeped->storeAs('mail_docs', $fileName, 'public'),
                //                 'type_file' => 'document'
                //             ]);

                //         }
                //         elseif(in_array($fileKeeped->getClientOriginalExtension(), ['mp4'])) {

                //             Fichier::create([
                //                 'mail_id' => $mail_created->id,
                //                 'file' => $fileKeeped->store('mail_video', 'public'),
                //                 'type_file' => 'visual'
                //             ]);

                //         }
                //         elseif(in_array($fileKeeped->getClientOriginalExtension(), ['mp3'])) {

                //             Fichier::create([
                //                 'mail_id' => $mail_created->id,
                //                 'file' => $fileKeeped->store('mail_audio', 'public'),
                //                 'type_file' => 'voice'
                //             ]);

                //         } else {

                //             return redirect()->back()->with('error', 'Erreur dans les fichiers sélectionnés.');

                //         }

                //     }

                // }

                foreach ($filesKeeped as $fileKeeped) {

                    if (is_file($fileKeeped)) {

                        $extension = $fileKeeped->getClientOriginalExtension();

                        $fileType = '';

                        if (in_array($extension, ['jpg', 'jpeg', 'png', 'jfif', 'webp', 'gif'])) {

                            $fileType = 'image';

                        } elseif (in_array($extension, ['doc', 'docx', 'xlsx', 'pptx', 'pdf', 'txt', 'html'])) {

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
                'receiver_id' => $receiver->id,
                'project_id' => $project->id,
                'subject' => $request->subject,
                'message' => $request->mail_message,
                'subtitle' => Str::substr($request->descriptionText, 0, 20),
                'dateTime' => now(),
                'type' => 'sent'
            ]);

        }

        return redirect()->route('admin.projectBoard.email.mail', $project)->with('success', 'Votre Mail a été envoyé!');
    }


    public function getSentMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        $mails = Mail::where('sender_id', session()->get('id'))->where('type', 'sent')->where('project_id', $project->id)->latest()->get();

        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.sentMail', compact('project', 'mails'));
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


    //     // return redirect()->route('admin.projectBoard.email.mail', $project)->with('success', 'Votre Mail a été envoyé!');

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

        // $mails = Mail::where(('receiver_id', session()->get('id'))->orWhere('sender_id', session()->get('id')))->where('type', 'trash')->where('project_id', $project->id)->get();

        $mails = Mail::where(function ($query) {
            $query->where('receiver_id', session()->get('id'))
                ->orWhere('sender_id', session()->get('id'));
        })
        ->where('type', 'trash')
        ->where('project_id', $project->id)
        ->get();


        if ($project == null) {
            abort('404');
        }

        return view('admin.projectBoard.email.trashMail', compact('project', 'mails'));
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

        $page = 'admin.projectBoard.email';

        return view('admin.projectBoard.email.show', compact('page', 'project', 'client', 'mail', 'files'));
    }

    public function goToTrash(Mail $mail, Project $project)
    {
        $verify_mail = Mail::where('id', $mail->id)->first();

        if ($verify_mail == null) {
            abort('404');
        }

        $mail->update([
            'type' => 'trash'
        ]);

        return redirect()->back()->with('success', 'Opération de suppression réussie');
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
