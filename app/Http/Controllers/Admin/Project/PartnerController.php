<?php

namespace App\Http\Controllers\Admin\Project;

use App\Events\sendInvitationMailForCollabEvent;
use App\Models\User;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Rapport;
use App\Models\ProjectUser;
use App\Models\ProjectLevel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PartnerController extends Controller
{
    public function client(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.client';
        return view('admin.projectBoard.client', compact('page', 'project'));
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

        // dd($request->lastName);

        // dd($request->firstName);

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

        $page = 'admin.projectBoard.collaborateur';
        return view('admin.projectBoard.collaborateur', compact('page', 'project'));
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
        $rapports = Rapport::all();
        $page = 'admin.projectBoard.rapport';
        return view('admin.projectBoard.rapport.index', compact('project','levels', 'rapports', 'page'));
    }

    public function store_rapport(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'date_debut' => 'required|date|date_format:Y-m-d',
            'date_fin' => 'required|date|date_format:Y-m-d',
            'stade' => 'required',
            'description' => 'required'
        ], [
            'title.required' => 'Veuillez renseigner le titre du projet',
            'date_debut.required' => 'Veuillez renseigner la date de début du projet',
            'date_debut.date' => 'Veuillez renseigner correctement la date de début',
            'date_debut.date_format:Y-m-d' =>'Veuillez respecter le format de date jour/mois/année',
            'date_fin.required' => 'Veuillez renseigner la date de finalisation du projet',
            'date_fin.date' => 'Veuillez renseigner correctement la date de finalisation',
            'date_fin.date_format:Y-m-d' =>'Veuillez respecter le format de date jour/mois/année',
            'stade.required' => 'Veuillez renseigner le stade d\'avancement du projet',
            'description.required' => 'Veuillez saisir le résumé'
        ]);

        // $date_debut = Carbon::parse($request->date_debut)->format('Y-m-d');

        // $date_fin = Carbon::parse($request->date_fin)->format('Y-m-d');

        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        Rapport::create([
            'project_id' => $project->id,
            'title' => $request->title,
            'key' => $request->project_key,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'budget' => $request->montant,
            'stade' => $request->stade,
            'resume' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Opération d\'enregistrement réussie !!');
    }

    public function edit(Rapport $rapport, Project $project)
    {
        $rapport = Rapport::where('id', $rapport->id)->first();
        $project = Project::where('id', $project->id)->first();
        $level = ProjectLevel::where('id', $rapport->stade)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.rapport';
        return view('admin.projectBoard.rapport.edit', compact('project', 'rapport', 'level', 'page'));
    }

    // public function viewPdf()
    // {
    //     $rapports = Rapport::all();
    //     $pdf = Pdf::loadView('admin.projectBoard.rapport.rapportTemplate', array('rapports' => $rapports))
    //     ->setPaper('a4', 'portrait');
    //     return $pdf->stream();
    // }

    // public function downloadPdf(Rapport $rapport)
    // {
    //     // $rapports = Rapport::all();
    //     // $pdf = Pdf::loadView('admin.projectBoard.rapport.rapportTemplate', array('rapports' => $rapports))

    //     $rapport = Rapport::where('id', $rapport->id)->first();
    //     $level = ProjectLevel::where('id', $rapport->stade)->first();
    //     $pdf = Pdf::loadView('admin.projectBoard.rapport.rapportTemplate', compact('rapport', 'level'))
    //     ->setPaper('a4', 'portrait');
    //     return $pdf->download('Rapport.pdf');
    // }

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

    public function sendInvitationForCollab(Request $request, Project $project)
    {

        $request->validate([
            'email' => 'required'
        ], [
            'email.required' => 'Veuillez renseigner le mail du collaborateur'
        ]);

        $collabLink = route('admin.projectBoard.project.showBoard', $project);

        $findIfInvitationHasAlreadySent = ProjectUser::where([
            ['user_mail', '=', $request->email],
            ['project_id', '=', $project->id]
        ])->first();

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

        $data = [
            'name' => $project->nom,
            'collabLink' =>  $collabLink
        ];

        event(new sendInvitationMailForCollabEvent($data));

        ProjectUser::create([
            'user_mail' => $request->email,
            'project_id' => $project->id,
            'status' => 0
        ]);

        return redirect()->back()->with('success', 'Votre demande a été envoyée avec succès');
    }
}
