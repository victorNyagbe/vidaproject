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
            'subject' => 'required',
            // Ajoutez des validations pour vos fichiers si nécessaire
        ]);

        // dd($request->input('action'));

        $project = Project::where('id', $project->id)->first();
        $receiver = ProjectUser::where('id', $project->project_client)->first();
        $filesToBeUploaded = $request->input('filesToBeUploaded');
        $collection = collect($filesToBeUploaded);
        $jsonString = $collection->get('0');
        $filesArray = json_decode($jsonString, true);

        if ($request->input('action') === 'toSend') {
            $this->processFiles($request, $receiver, $project, $filesArray, 'received', 'sent');
            return redirect()->route('admin.clientSpace.email.mail', $project)->with('success', 'Votre Mail a été envoyé!');
        } elseif ($request->input('action') === 'toDraft') {
            $this->processFiles($request, $receiver, $project, $filesArray, 'null', 'draft');
            return redirect()->route('admin.clientSpace.email.mail', $project)->with('success', 'Brouillon enregistré avec succès!');
        }
    }

    private function processFiles($request, $receiver, $project, $filesArray, $type, $clientMailType)
    {
        $mail_created = Mail::create([
            'sender_id' => session()->get('id'),
            'receiver_id' => $project->user->id,
            'project_id' => $project->id,
            'subject' => $request->subject,
            'message' => $request->descriptionText,
            'subtitle' => Str::substr($request->descriptionText, 0, 20),
            'dateTime' => now(),
            'type' => $type,
            'client_mail_type' => $clientMailType
        ]);

        if ($request->hasFile('files')) {
            $filesSelected = $request->file('files');

            if (is_array($filesSelected)) {
                $filesKeeped = [];

                foreach ($filesArray as $fileArray) {
                    foreach ($filesSelected as $fileSelected) {
                        if ($fileArray == $fileSelected->getClientOriginalName()) {
                            if ($fileSelected->isValid()) {
                                $filesKeeped[] = $fileSelected;
                            }
                        }
                    }
                }

                $this->createFiles($filesKeeped, $mail_created);
            }
        }
    }

    private function createFiles($files, $mail)
    {
        foreach ($files as $file) {
            if (file_exists($file)) {
                $extension = $file->getClientOriginalExtension();
                $fileType = $this->determineFileType($extension);

                if ($fileType) {
                    $fileName = $file->getClientOriginalName();
                    Fichier::create([
                        'mail_id' => $mail->id,
                        'file' => $file->storeAs('mail_' . $fileType, $fileName, 'public'),
                        'type_file' => $fileType,
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Fichier non pris en charge : ' . $file->getClientOriginalName());
                }
            }
        }
    }

    private function determineFileType($extension)
    {
        // Logique pour déterminer le type de fichier à partir de l'extension
        // Vous pouvez adapter cela en fonction de vos besoins
        // Exemple basique :
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'jfif':
            case 'webp':
            case 'gif':
                return 'image';
            case 'doc':
            case 'docx':
            case 'xlsx':
            case 'pptx':
            case 'pdf':
            case 'txt':
            case 'html':
            case 'sql':
                return 'document';
            case 'mp4':
            case 'mov':
            case 'avi':
            case 'wmv':
            case 'avchd':
            case 'WebM':
            case 'flv':
                return 'video';
            case 'mp3':
            case 'mid':
                return 'audio';
            // Ajoutez d'autres cas au besoin
            default:
                return null;
        }
    }



    public function getSentMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        $mails = Mail::where([
            ['sender_id', '=', session()->get('id')],
            ['client_mail_type', '=', 'sent'],
            ['project_id', '=', $project->id]
        ])->latest()->get();


        return view('admin.clientSpace.email.sentMail', compact('project', 'mails'));

    }

    public function getDraftMail(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        $mails = Mail::where([
            ['sender_id', '=', session()->get('id')],
            ['type', '=', 'null'],
            ['client_mail_type', '=', 'draft'],
            ['project_id', '=', $project->id]
        ])->latest()->get();

        if ($project == null) {
            abort('404');
        }

        return view('admin.clientSpace.email.draftMail', compact('project', 'mails'));
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

    public function show_draft(Mail $mail, Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $client = ProjectUser::where('id', $project->project_client)->first();

        $files = Fichier::where('mail_id', $mail->id)->get();



        $mail = Mail::where('id', $mail->id)->first();

        if ($mail == null) {
            abort('404');
        }

        $page = 'admin.clientSpace';

        return view('admin.clientSpace.email.show-draft', compact('page', 'project', 'client', 'mail', 'files'));
    }

    public function updateDraft(Request $request, Project $project, Mail $mail)
    {
        $request->validate([
            'mail_message' => 'required',
            'subject' => 'required',
            // Ajoutez des validations pour vos fichiers si nécessaire
        ]);

        $project = Project::where('id', $project->id)->first();
        $receiver = ProjectUser::where('id', $project->project_client)->first();
        $filesToBeUploaded = $request->input('filesToBeUploaded');
        $collection = collect($filesToBeUploaded);
        $jsonString = $collection->get('0');
        $filesArray = json_decode($jsonString, true);

        if ($request->input('action') === 'toSend') {
            $this->processNewFiles($request, $receiver, $project, $filesArray, 'received', 'sent',  $mail);
            return redirect()->route('admin.clientSpace.email.mail', ['mail' => $mail, 'project' => $project])->with('success', 'Votre Mail a été envoyé!');
        } elseif ($request->input('action') === 'toSaveDraftUpdate') {
            $this->processNewFiles($request, $receiver, $project, $filesArray, 'null', 'draft', $mail);
            return redirect()->route('admin.clientSpace.email.show-draft', ['mail' => $mail, 'project' => $project])->with('success', 'Brouillon mis à jour avec succès!');
        }
    }

    private function processNewFiles($request, $receiver, $project, $filesArray, $type, $clientMailType, $mail = null)
    {
        if ($mail) {
            // Si $mail existe, cela signifie que nous mettons à jour un brouillon existant
            $mail->update([
                'subject' => $request->subject,
                'message' => $request->mail_message,
                'subtitle' => Str::substr($request->mail_message, 0, 20),
                'dateTime' => now(),
                'type' => $type,
                'client_mail_type' => $clientMailType
            ]);

            if ($request->hasFile('files')) {
                // Supprimer les fichiers qui ne sont pas inclus dans la nouvelle mise à jour
                $this->deleteUnselectedFiles($mail, $filesArray);
            }

        } else {
            // Rediriger vers une page 404 ou afficher un message d'erreur
            return redirect()->route('admin.clientSpace.email.mail', $project)->with('error', 'Votre mail est introuvable!');
        }

        if ($request->hasFile('files')) {
            $filesSelected = $request->file('files');

            if (is_array($filesSelected)) {
                $filesKeeped = [];

                foreach ($filesArray as $fileArray) {
                    foreach ($filesSelected as $fileSelected) {
                        if ($fileArray == $fileSelected->getClientOriginalName()) {
                            if ($fileSelected->isValid()) {
                                $filesKeeped[] = $fileSelected;
                            }
                        }
                    }
                }

                $this->createNewFiles($filesKeeped, $mail);
            }
        }
    }

    private function deleteUnselectedFiles($mail, $filesArray)
    {
        // Récupérer tous les fichiers associés à ce mail
        $existingFiles = Fichier::where('mail_id', $mail->id)->get();

        // Vérifier chaque fichier existant
        foreach ($existingFiles as $existingFile) {
            // Vérifier si le fichier existe dans la nouvelle mise à jour
            if (!in_array($existingFile->file, $filesArray)) {
                // Supprimer le fichier s'il n'est pas présent dans la nouvelle liste
                $existingFile->delete();
            }
        }
    }

    private function createNewFiles($files, $mail)
    {
        foreach ($files as $file) {
            if (file_exists($file)) {
                $extension = $file->getClientOriginalExtension();
                $fileType = $this->determineFileType($extension);

                if ($fileType) {
                    $fileName = $file->getClientOriginalName();
                    Fichier::create([
                        'mail_id' => $mail->id,
                        'file' => $file->storeAs('mail_' . $fileType, $fileName, 'public'),
                        'type_file' => $fileType,
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Fichier non pris en charge : ' . $file->getClientOriginalName());
                }
            }
        }
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

        $mail->update([
            'client_mail_type' => 'trash_def'
        ]);

        return redirect()->back()->with('success', 'Opération de suppression réussie');
    }
}
