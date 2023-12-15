<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
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
        $invitations = Invitation::where('user_id', session()->get('id'))->where('status', 'en_attente')->get();
        return view('admin.dashboard', compact('page', 'invitations'));
    }

}
