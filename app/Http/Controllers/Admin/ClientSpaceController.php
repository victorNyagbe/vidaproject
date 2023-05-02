<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientSpaceController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $page = 'admin.clientSpace';
        return view('admin.clientSpace.index', compact('page', 'projects'));
    }

    public function show()
    {
        $page = 'admin.clientSpace';
        return view('admin.clientSpace.show', compact('page'));
    }
}
