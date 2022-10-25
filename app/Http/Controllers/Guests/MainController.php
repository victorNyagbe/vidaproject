<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function welcome()
    {
        return view('guests.welcome');
    }

    public function login()
    {
        return view('guests.login');
    }

    public function dashboard()
    {
        $page = 'guests.dashboard';

        return view('guests.dashboard', compact('page'));
    }


    // Partie partner (inviteLogin)

    public function inviteLogin()
    {
        return view('partners.inviteLogin');
    }
}
