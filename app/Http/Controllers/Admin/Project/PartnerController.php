<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Rapport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    public function client()
    {
        $page = 'admin.projectBoard.client';
        return view('admin.client', compact('page'));
    }

    public function client_store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'profession' => 'required',
            'adresse' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'status' => 'required'
        ], [
            'nom.required' => 'Veuillez renseigner toutes les informations',
            'prenom.required' => 'Veuillez renseigner toutes les informations',
            'profession.required' => 'Veuillez renseigner toutes les informations',
            'adresse.required' => 'Veuillez renseigner toutes les informations',
            'contact.required' => 'Veuillez renseigner toutes les informations',
            'email.required' => 'Veuillez renseigner toutes les informations',
            'status.required' => 'Veuillez renseigner toutes les informations'
        ]);

        UserClient::create([
            'nom' => '$request->nom',
            'prenom' => '$request->prenom',
            'profession' => '$request->profession',
            'adresse' => '$request->adresse',
            'contact' => '$request->contact',
            'email' => '$request->email',
            'status' => '$request->status',
        ]);
    }

    public function collaborateur()
    {
        $page = 'admin.projectBoard.collaborateur';
        return view('admin.projectBoard.collaborateur', compact('page'));
    }

    public function index()
    {
        $rapports = Rapport::all();
        $page = 'admin.projectBoard.rapport';
        return view('admin.projectBoard.rapport.index', compact('rapports', 'page'));
    }

    public function store_rapport(Request $request)
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

        Rapport::create([
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

    public function edit(Rapport $rapport)
    {
        $rapport = Rapport::where('id', $rapport->id)->first();
        $page = 'admin.projectBoard.rapport';
        return view('admin.projectBoard.rapport.edit', compact('rapport', 'page'));
    }

    public function viewPdf()
    {
        $rapports = Rapport::all();
        $pdf = Pdf::loadView('admin.projectBoard.rapport.rapportTemplate', array('rapports' => $rapports))
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function downloadPdf(Rapport $rapport)
    {
        // $rapports = Rapport::all();
        // $pdf = Pdf::loadView('admin.projectBoard.rapport.rapportTemplate', array('rapports' => $rapports))

        $rapports = Rapport::where('id', $rapport->id)->first();
        $pdf = Pdf::loadView('admin.projectBoard.rapport.rapportTemplate', compact('rapports'))
        ->setPaper('a4', 'portrait');
        return $pdf->download('Rapport.pdf');
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
}
