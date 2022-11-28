<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Gallerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function gallery(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $page = 'admin.gallery';
        return view('admin.gallery', compact('project', 'page'));
    }

    // project board

    public function projectGallery(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        if ($project == null) {
            abort('404');
        }

        $galleries = Gallerie::all();
        $page = 'admin.projectBoard.gallery';
        return view('admin.projectBoard.gallery', compact('project', 'galleries','page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|mimes:png,jpg,jpeg,jfif,webp',
            'title' => 'required'
        ], [
            'image.required' => 'Veuillez choisir l\'image',
            'image.file' => 'Le fichier choisi est invalide',
            'image.image' => 'Le fichier choisi est invalide',
            'image.mimes' => 'Veuillez choisir une image valide'
        ]);

        Gallerie::create([
            'image' => request('image')->store('gallerie', 'public'),
            'title' => $request->title
        ]);

        return redirect()->back()->with('success', 'Opération d\'ajout de l\'image réussie');
    }

    public function destroy(Gallerie $gallerie)
    {
        $verify_gallerie = Gallerie::where('id', $gallerie->id)->first();

        if ($verify_gallerie == null) {
            return redirect()->back()->with('error', 'Opération échouée');
        }

        $old_image = $gallerie->image;

        $gallerie->delete();

        if (Storage::disk('public')->exists($old_image)) {
            File::delete('storage/app/public/' . $old_image);
        }

        return redirect()->back()->with('success', 'Opération de suppression réussie!');
    }
}
