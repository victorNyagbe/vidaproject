<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use App\Models\ProjectStatus;
use App\Http\Controllers\Controller;
use App\Models\ProjectTypePivot;
use App\Models\ProjectUser;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('accessProject');
    }

    public function createProjectLogin()
    {
        $types = ProjectType::all();
        return view('admin.createProjectLogin', compact('types'));
    }

    public function store_project_login(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'project_type' => 'required'
        ], [
            'project_name.required' => 'Veuillez renseigner le nom du projet',
            'project_type.required' => 'Veuillez choisir le type du projet'
        ]);

        Project::create([
            'nom' => $request->project_name,
            'type' => $request->project_type
        ]);

        return redirect()->route('admin.home')->with('success', 'Le projet a été ajouté avec succès');
    }

    public function index()
    {
        $projects = Project::where([
            'owner_id' => session()->get('id')
        ])->get();

        $getProjectsCollab = ProjectUser::where([
            ['user_mail', '=', session()->get('email')],
            ['status', '<>', 2]
        ])->get('project_id');

        $collabProjectArray = [];

        if ($getProjectsCollab->count() > 0) {
            foreach ($getProjectsCollab as $getProjectCollab) {
                $collabProject = Project::where('id', $getProjectCollab->project_id)->first();
                $collabProjectArray[] = $collabProject;
            }
            $projectCollabs = collect($collabProjectArray);
        } else {
            $projectCollabs = collect([]);
        }

        $types = ProjectType::all();
        $page = 'admin.project';
        return view('admin.project.project', compact('projects', 'types', 'page', 'projectCollabs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'file|image|mimes:png,jpg,jpeg,jfif,webp',
            'project_name' => 'required',
            'project_type' => 'required',
            // 'date_debut' => 'date|date_format:Y-m-d|after:yesterday',
            // 'date_fin' => 'date|date_format:Y-m-d|after:yesterday'
        ], [
            'logo.file' => 'Le fichier choisi est invalide',
            'logo.image' => 'Le fichier choisi est invalide',
            'logo.mimes' => 'Veuillez choisir une image valide',
            'project_name.required' => 'Veuillez renseigner le nom du projet',
            'project_type.required' => 'Veuillez choisir le type du projet',
            // 'date_debut.date' => 'Veuillez renseigner correctement la date de début',
            // 'date_debut.date_format:Y-m-d' =>'Veuillez respecter le format de date jour/mois/année',
            // 'date_debut.after' => 'Erreur de renseignement de la date de début',
            // 'date_fin.date' => 'Veuillez renseigner correctement la date de finalisation',
            // 'date_fin.date_format:Y-m-d' =>'Veuillez respecter le format de date jour/mois/année',
            // 'date_fin.after' => 'Erreur de renseignement de la date de finalisation'

        ]);

        $project = Project::create([
            'owner_id' => session()->get('id'),
            'logo' => request('logo')->store('logo_projects', 'public'),
            'nom' => $request->project_name,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_debut,
            'description' => $request->description
        ]);

        foreach ($request->project_type as $project_type) {
            ProjectTypePivot::create([
                'project_id' =>  $project->id,
                'project_type_id' => $project_type
            ]);
        }

        return redirect()->route('admin.project.project')->with('success', 'Le projet a été ajouté avec succès');
    }

    // public function update_index(Project $project)
    // {
    //     $verify_project = Project::where('id', $project->id)->first();
    //     $page = 'admin.project';
    //     return view('admin.project.projectUpdate', compact('project','page'));
    // }

    public function edit(Project $project)
    {
        $statuses = ProjectStatus::all();
        $verify_project = Project::where('id', $project->id)->first();

        if ($verify_project == null) {
            abort('404');
        }

        $types = ProjectType::all();

        $page = 'admin.project';
        return view('admin.project.edit', compact('project', 'statuses', 'types', 'page'));
    }

    public function destroy_edit(Project $project)
    {
        $verify_project = Project::where('id', $project->id)->first();

        if ($verify_project == null) {
            return redirect()->back()->with('error', 'Opération échouée');
        }

        $old_logo = $project->logo;

        $project->delete();

        if (Storage::disk('public')->exists($old_logo)) {
            File::delete('storage/app/public/' . $old_logo);
        }

        return redirect()->route('admin.project.project')->with('success', 'Opération de suppression réussie!');
    }


    public function update(Request $request, Project $project)
    {
        $verify_project = Project::where('id', $project->id)->first();

        if ($verify_project == null) {
            return redirect()->back()->with('error', 'Opération échoué');
        }

        $request->validate([
            'logo' => 'file|image|mimes:png,jpg,jpeg,jfif,webp',
            'project_name' => 'required',
            'project_type' => 'required',
            'date_debut' => 'date|date_format:Y-m-d|after:yesterday',
            'date_fin' => 'date|date_format:Y-m-d|after:yesterday'
        ], [
            'logo.file' => 'Le fichier choisi est invalide',
            'logo.image' => 'Le fichier choisi est invalide',
            'logo.mimes' => 'Veuillez choisir une image valide',
            'project_name.required' => 'Veuillez renseigner le nom du projet',
            'project_type.required' => 'Veuillez choisir le type du projet',
            'date_debut.date' => 'Veuillez renseigner correctement la date de début',
            'date_debut.date_format:Y-m-d' =>'Veuillez respecter le format de date jour/mois/année',
            'date_debut.after' => 'Erreur de renseignement de la date de début',
            'date_fin.date' => 'Veuillez renseigner correctement la date de finalisation',
            'date_fin.date_format:Y-m-d' =>'Veuillez respecter le format de date jour/mois/année',
            'date_fin.after' => 'Erreur de renseignement de la date de finalisation'
        ]);

        if (request('logo')) {
            if ($request->hasFile('logo')) {
                if (in_array($request->file('logo')->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'jfif', 'webp'])) {

                    $old_logo= $project->logo;

                    $project->update([
                        'logo' => request('logo')->store('logo_projects', 'public')
                    ]);

                    if (Storage::disk('public')->exists($old_logo)) {
                        File::delete('storage/app/public/' . $old_logo);
                    }

                } else {
                    return redirect()->back()->with('error', 'Erreur! Fichier image logo invalide');
                }
            } else {
                return redirect()->back()->with('error', 'Erreur! Fichier choisi invalide');
            }
        }

        $project->update([
            'logo' => request('logo')->store('logo_projects', 'public'),
            'nom' => $request->project_name,
            'type' => $request->project_type,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'description' => $request->description,
            'status' => $request->statut
        ]);

        return redirect()->back()->with('success', 'Opération de modification réussie!');

    }

    public function destroy(Project $project)
    {
        $verify_project = Project::where('id', $project->id)->first();

        if ($verify_project == null) {
            return redirect()->back()->with('error', 'Opération échouée');
        }

        $old_logo = $project->logo;

        $project->delete();

        if (Storage::disk('public')->exists($old_logo)) {
            File::delete('storage/app/public/' . $old_logo);
        }

        return redirect()->back()->with('success', 'Opération de suppression réussie!');
    }


    public function show(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.projectBoard.project.showBoard';

        return $this->accessToProjectDetailPolicy($project, $page);
    }

    public function accessToProjectDetailPolicy(Project $project, $page)
    {
        $ifOwnerProject = Project::where([
            ['owner_id', '=', session()->get('id')],
            ['id', '=', $project->id]
        ])->first();

        $ifUserIsProjectCollab = ProjectUser::where([
            ['user_id', '=', session()->get('id')],
            ['project_id', '=', $project->id]
        ])->first();

        if ($ifOwnerProject == null && $ifUserIsProjectCollab == null) {
            return redirect()->route('admin.project.project')->with('error', 'Vous n\'avez pas l\'autorisation d\'accéder au panel');
        }

        if ($ifUserIsProjectCollab == null) {
            session()->put('accessLevel', 'Collab');
        }

        if ($ifOwnerProject != null) {
            session()->put('accessLevel', 'Owner');
        }

        return view('admin.projectBoard.project.showBoard', compact('page', 'project'));
    }
}
