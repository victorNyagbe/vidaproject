<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $page = 'admin.home';
        return view('admin.home', compact('page'));
    }

    public function dashboard()
    {
        $page = 'admin.dashboard';
        return view('admin.dashboard', compact('page'));
    }

}
