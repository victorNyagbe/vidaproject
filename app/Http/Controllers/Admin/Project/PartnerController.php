<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\User;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Rapport;
use App\Models\Invitation;
use App\Models\ProjectUser;
use Illuminate\Support\Str;
use App\Models\ProjectLevel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\ActivationAccountToken;
use App\Events\sendInvitationMailForClientEvent;
use App\Events\sendInvitationMailForCollabEvent;

class PartnerController extends Controller
{
    public function client(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        $client = ProjectUser::where([
            ['project_id', '=', $project->id],
            ['status', '=', 1],
            ['id', '=', $project->project_client]
        ])->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.client';
        return view('admin.projectBoard.client', compact('page', 'project', 'client'));
    }

    public function client_store(Request $request)
    {
        $request->validate([
            'profil' => 'file|image|mimes:png,jpg,jpeg,jfif,webp',
            'lastName' => 'required',
            'firstName' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'status' => 'required'
        ], [
            'profil.file' => 'Le fichier choisi est invalide',
            'profil.image' => 'Le fichier choisi est invalide',
            'profil.mimes' => 'Veuillez choisir une image valide',
            'lastName.required' => 'Veuillez renseigner votre nom',
            'firstName.required' => 'Veuillez renseigner votre prénom',
            'contact.required' => 'Veuillez renseigner votre contact',
            'email.required' => 'Veuillez renseigner votre email',
            'status.required' => 'Veuillez renseigner votre statut sur le projet'
        ]);

        $user = User::create([
            'fullname' => $request->firstName . ' ' . $request->lastName,
            'profile' => request('profil')->store('profil_client', 'public'),
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        ProjectUser::create([
            'user_id' => $user->id,
            'adresse' => $request->adresse,
            'profession' => $request->profession,
            'contact' => $request->contact,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Opération d\'inscription réussie !!');
    }

    public function collaborateur(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $projectUsers = ProjectUser::where([
            ['project_id', '=', $project->id],
            ['status', '=', 1],
            ['id', '!=', $project->project_client]
        ])->get();

        $page = 'admin.projectBoard.collaborateur';
        return view('admin.projectBoard.collaborateur', compact('page', 'project', 'projectUsers'));
    }

    public function collab_store(Request $request)
    {
        $request->validate([
            'profil' => 'file|image|mimes:png,jpg,jpeg,jfif,webp',
            'lastName' => 'required',
            'firstName' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'status' => 'required'
        ], [
            'profil.file' => 'Le fichier choisi est invalide',
            'profil.image' => 'Le fichier choisi est invalide',
            'profil.mimes' => 'Veuillez choisir une image valide',
            'lastName.required' => 'Veuillez renseigner votre nom',
            'firstName.required' => 'Veuillez renseigner votre prénom',
            'contact.required' => 'Veuillez renseigner votre contact',
            'email.required' => 'Veuillez renseigner votre email',
            'status.required' => 'Veuillez renseigner votre statut sur le projet'
        ]);

        $user = User::create([
            'fullname' => $request->firstName . ' ' . $request->lastName,
            'profile' => request('profil')->store('profil_collab', 'public'),
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        ProjectUser::create([
            'user_id' => $user->id,
            'contact' => $request->contact,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Opération d\'inscription réussie !!');
    }

    public function index(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $levels = ProjectLevel::all();
        $rapports = Rapport::where('project_id', $project->id)->get();
        $page = 'admin.projectBoard.rapport';
        return view('admin.projectBoard.rapport.index', compact('project','levels', 'rapports', 'page'));
    }

    public function store_rapport(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'stade' => 'required',
            'description' => 'required'
        ], [
            'title.required' => 'Veuillez renseigner le titre du projet',
            'stade.required' => 'Veuillez renseigner le stade d\'avancement du projet',
            'description.required' => 'Veuillez saisir le résumé'
        ]);

        // $date_debut = Carbon::parse($request->date_debut)->format('Y-m-d');

        // $date_fin = Carbon::parse($request->date_fin)->format('Y-m-d');

        // $project = Project::where('id', $project->id)->first();

        // Utilisation de la clé du projet avec vérification
        $projectKey = Str::random(6);

        // Obtention du projet par ID
        if ($project == null) {
            abort(404);
        }

        // Création du rapport
        Rapport::create([
            'user_id' => session()->get('id'),
            'project_id' => $project->id,
            'title' => $request->title,
            'key' => $projectKey,
            'date_debut' => $project->date_debut,
            'date_fin' => $project->date_fin,
            'budget' => $request->montant,
            'stade' => $request->stade,
            'resume' => $request->description,
        ]);

        // Redirection après la création
        return redirect()->back()->with('success', 'Opération d\'enregistrement réussie !!');
    }

    public function edit(Rapport $rapport, Project $project)
    {
        $rapport = Rapport::where('id', $rapport->id)->first();
        $project = Project::where('id', $project->id)->first();
        $user = User::where('id', $rapport->user_id)->first();
        $level = ProjectLevel::where('id', $rapport->stade)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.rapport';
        return view('admin.projectBoard.rapport.edit', compact('project', 'rapport', 'user', 'level', 'page'));
    }

    // public function viewPdf()
    // {
    //     $rapports = Rapport::all();
    //     $pdf = Pdf::loadView('admin.projectBoard.rapport.rapportTemplate', array('rapports' => $rapports))
    //     ->setPaper('a4', 'portrait');
    //     return $pdf->stream();
    // }

    public function downloadPdf(Rapport $rapport)
    {
        // $rapports = Rapport::all();
        // $pdf = Pdf::loadView('admin.projectBoard.rapport.rapportTemplate', array('rapports' => $rapports))

        $rapport = Rapport::where('id', $rapport->id)->first();
        $project = Project::where('id', $rapport->project_id)->first();
        $user = User::where('id', $rapport->user_id)->first();
        $level = ProjectLevel::where('id', $rapport->stade)->first();
        $pdf = Pdf::loadView('admin.projectBoard.rapport.rapportTemplate', compact('rapport', 'project', 'user', 'level'))
        ->setPaper('a4', 'portrait');
        return $pdf->download($rapport->title . '.pdf');
    }

    public function destroy_rapport(Rapport $rapport)
    {
        $verify_rapport = Rapport::where('id', $rapport->id)->first();

        if ($verify_rapport == null) {
            abort('404');
        }

        $rapport->delete();

        return redirect()->route('admin.projectBoard.rapport.index')->with('success', 'Opération de suppression réussie');
    }

    // public function mailForAdd(Request $request, Project $project){
    //     $typePartner = $request->typePartner;
    //     if($typePartner == "client")
    //     {
    //         $project = Project::where('id', $project->id)->first();
    //         Mail::send('AddByMail.addClient', compact('project'), function ($message) {

    //             $message->from('gomezfelix310@gmail.com', 'Laravel');

    //             $message->to($address = $request->email)->cc(request->email)
    //             ->subject('Demande d\'ajout sur le projet gozem');
    //         });

    //         return redirect()->back()->with('success', 'Votre demande d\'ajout à été envoyé avec succès');
    //     }
    //     else if($typePartner == "collab")
    //     {
    //         $project = Project::where('id', $project->id)->first();
    //         Mail::send('AddByMail.addCollab', compact('project'), function ($message) {

    //             $message->from('gomezfelix310@gmail.com', 'Laravel');

    //             $message->to('gomezfelix310@gmail.com')->cc('gomezfelix310@gmail.com')
    //             ->subject('Demande d\'ajout sur le projet gozem');
    //         });

    //         return redirect()->back()->with('success', 'Votre demande d\'ajout à été envoyé avec succès');
    //     }
    //     else {
    //         abort('404');
    //     }
    // }


    // inviter un collaborateur

    public function sendInvitationForCollab(Request $request, Project $project)
    {

        $request->validate([
            'email' => 'required'
        ], [
            'email.required' => 'Veuillez renseigner le mail du collaborateur'
        ]);

        // $collabLink = route('admin.projectBoard.project.showBoard', $project);

        $project = Project::where('id', $project->id)->first();

        $findIfInvitationHasAlreadySent = ProjectUser::where([
            ['user_mail', '=', $request->email],
            ['project_id', '=', $project->id]
        ])->first();

        // dd(session()->get('email'));

        if ($findIfInvitationHasAlreadySent != null) {
            if ($findIfInvitationHasAlreadySent->status == 0) {
                return redirect()->back()->with('error', 'Une demande du projet a déjà été envoyée à ce mail');
            } else if ($findIfInvitationHasAlreadySent->status == 1) {
                return redirect()->back()->with('error', 'Ce mail est déjà collaborateur sur ce projet');
            } else {
                return redirect()->back()->with('error', 'La demande au projet a été refusée par ce mail');
            }
        }

        if (session()->get('email') == $request->email) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas vous envoyer une demande. Vous êtes le gestionnaire du projet');
        }

        $user = User::where('email', $request->input('email'))->first();

        // Générez un jeton d'invitation unique
        // $invitationToken = Str::random(60);

        // dd($project->id);
        // if($user != null) {
        //     // Ajoutez une nouvelle invitation à la table invitations
        //     Invitation::create([
        //         'user_id' => $user->id,
        //         'email' => $request->input('email'),
        //         'token' => $invitationToken,
        //         'status' => 'en_attente',
        //         'project_id' => $project->id,
        //     ]);

        // } else {
        //     // Ajoutez une nouvelle invitation à la table invitations
        //     Invitation::create([
        //         'email' => $request->input('email'),
        //         'token' => $invitationToken,
        //         'status' => 'en_attente',
        //         'project_id' => $project->id,
        //     ]);
        // }

        $invitationToken = Str::random(60);

        if ($user != null) {
            // Si un utilisateur existe
            $invitationData = [
                'user_id' => $user->id,
                'email' => $request->input('email'),
                'token' => $invitationToken,
                'invite_type' => 'collaborateur',
                'status' => 'en_attente',
            ];

            if ($project->id !== null) {
                $invitationData['project_id'] = $project->id;
                $invitationData['project_name'] = $project->nom;
            }

            Invitation::create($invitationData);
        } else {
            // Si l'utilisateur n'existe pas
            $invitationData = [
                'email' => $request->input('email'),
                'token' => $invitationToken,
                'invite_type' => 'collaborateur',
                'status' => 'en_attente',
            ];

            dd($project->nom);

            if ($project->id !== null) {
                $invitationData['project_id'] = $project->id;
                $invitationData['project_name'] = $project->nom;
            }

            Invitation::create($invitationData);
        }


        // setcookie('invitation_token', $invitationToken, time() + 3600, '/', '', false, false);

        $collabLink = route('invitation.accept', $invitationToken);

        $data = [
            'senderEmail' => session()->get('email'),
            'recipientEmail' => $request->email,
            'name' => $project->nom,
            'collabLink' =>  $collabLink
        ];

        event(new sendInvitationMailForCollabEvent($data));

        $user = User::where('email', $request->input('email'))->first();

        if($user != null) {

            ProjectUser::create([
                'user_id' => $user->id,
                'user_mail' => $request->email,
                'project_id' => $project->id,
                'status' => 0
            ]);

        }else {

            ProjectUser::create([
                'user_mail' => $request->email,
                'project_id' => $project->id,
                'status' => 0
            ]);

            ActivationAccountToken::create([
                'email' => $request->email,
            ]);
        }

        return redirect()->back()->with('success', 'Votre demande a été envoyée avec succès');
    }

    // inviter un client

    public function sendInvitationForClient(Request $request, Project $project)
    {

        $request->validate([
            'email' => 'required'
        ], [
            'email.required' => 'Veuillez renseigner le mail du client'
        ]);

        // $clientLink = route('admin.projectBoard.project.showBoard', $project);

        $findIfInvitationHasAlreadySent = ProjectUser::where([
            ['user_mail', '=', $request->email],
            ['project_id', '=', $project->id]
        ])->first();

        if ($findIfInvitationHasAlreadySent != null) {
            if ($findIfInvitationHasAlreadySent->status == 0) {
                return redirect()->back()->with('error', 'Une demande du projet a déjà été envoyée à ce mail');
            } else if ($findIfInvitationHasAlreadySent->status == 1) {
                return redirect()->back()->with('error', 'Ce mail est déjà client sur ce projet');
            } else {
                return redirect()->back()->with('error', 'La demande au projet a été refusée par ce mail');
            }
        }

        if (session()->get('email') == $request->email) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas vous envoyer une demande. Vous êtes le gestionnaire du projet');
        }

        $user = User::where('email', $request->input('email'))->first();

        $invitationToken = Str::random(60);

        if ($user != null) {
            // Si un utilisateur existe
            $invitationData = [
                'user_id' => $user->id,
                'email' => $request->input('email'),
                'token' => $invitationToken,
                'invite_type' => 'client',
                'status' => 'en_attente',
            ];

            if ($project->id !== null) {
                $invitationData['project_id'] = $project->id;
                $invitationData['project_name'] = $project->nom;
            }

            Invitation::create($invitationData);
        } else {
            // Si l'utilisateur n'existe pas
            $invitationData = [
                'email' => $request->input('email'),
                'token' => $invitationToken,
                'invite_type' => 'client',
                'status' => 'en_attente',
            ];

            if ($project->id !== null) {
                $invitationData['project_id'] = $project->id;
                $invitationData['project_name'] = $project->nom;
            }

            Invitation::create($invitationData);
        }

        $clientLink = route('invitation.accept', $invitationToken);

        $data = [
            'senderEmail' => session()->get('email'),
            'recipientEmail' => $request->email,
            'name' => $project->nom,
            'clientLink' =>  $clientLink
        ];

        event(new sendInvitationMailForClientEvent($data));

        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if($user != null) {

            $client = ProjectUser::create([

                'user_id' => $user->id,
                'user_mail' => $request->email,
                'project_id' => $project->id,
                'status' => 0

            ]);

            if ($project->id == $client->project_id){

                $project->update([
                    'project_client' => $client->id
                ]);

            }

        } else {

            $client = ProjectUser::create([

                'user_mail' => $request->email,
                'project_id' => $project->id,
                'status' => 0

            ]);

            if ($project->id = $client->project_id){

                $project->update([
                    'project_client' => $client->id
                ]);

            }

            ActivationAccountToken::create([
                'email' => $request->email,
            ]);

        }

        return redirect()->back()->with('success', 'Votre demande a été envoyée avec succès');
    }
}
