<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $page = 'admin.projectBoard.project';
        return view('admin.projectBoard.project.project', compact('page') );
    }
}
