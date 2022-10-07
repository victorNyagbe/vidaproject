<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function rapport()
    {
        $page = 'admin.projectBoard.rapport';
        return view('admin.projectBoard.rapport', compact('page'));
    }
}
