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
