<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $page = 'admin.project';
        return view('admin.project.project', compact('page') );
    }

    public function show()
    {
        $page = 'admin.project.showBoard';
        return view('admin.project.showBoard', compact('page'));
    }
}
